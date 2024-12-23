<?php

namespace App\Http\Controllers\Admin;

use Photo;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function dashboard()
    {
        $order = Order::count();

        $pendingOrder = Order::where('order_status', 'pending')->orderBy('id', 'DESC')->take(10)->get();

        $totalProduct = Product::count();
        $totalSale = Order::where('order_status', 'delieverd')->sum('price');
        $cat = ProductCategory::all()->count();
        $camp = Campaign::all()->count();
        return view('backend.home.home', [
            'total_product' => $totalProduct,
            'total_price'   => $totalSale,
            'order_pending' => $pendingOrder,
            'total_cat'     => $cat,
            'order'         => $order,
            'camp'          => $camp,
            'chart'         => $this->chart()
        ]);
    }
    function admin_login()
    {
        return view('backend.include.admin_login');
    }


    function adminlogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember'); // Check if remember me is checked

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }
    }

    //Admin Link
    function admin_register()
    {
        $super_admin = Admin::count();

        if ($super_admin == 0 && !Auth::guard('admin')->check()) {
            return view('backend.include.admin_register', compact('super_admin'));
        } else {
            return redirect('/');
        }
    }
    //Admin Store
    function admin_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'number' => 'required|max:11',
            'password' => 'required|min:8',
        ]);
        //Pure File //Path Name // Prefix for name // size alternative
        Photo::upload($request->profile, 'files/profile', 'adminProfile');

        Admin::insert([
            'name' => $request->name,
            'profile' => Photo::$name,
            'email' => $request->email,
            'number' => $request->number,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
        $credentials =  $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()
                ->route('dashboard')
                ->with('Welcome! Your account has been successfully created!');
        }
    }

    // create admin for role
    function create_admin()
    {
        $super_admin = Admin::count();
        return view('backend.admin.create_admin', compact('super_admin'));
    }
    function create_role_admin(Request $request)
    {
        Photo::upload($request->profile, 'files/profile', $request->name);

        Admin::insert([
            'name' => $request->name,
            'profile' => Photo::$name,
            'email' => $request->email,
            'number' => $request->number,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
        return back();
    }

    function admin_logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function chart()
    {
        // Get data for the last 30 days grouped by day and status
        $dailyData = Order::selectRaw('DATE(created_at) as date, order_status, COUNT(*) as total')
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('date', 'order_status')
            ->orderBy('date')
            ->get();

        // Initialize arrays
        $labels = [];
        $dataByDate = [];

        // Prepare the structure to store data
        foreach ($dailyData as $data) {
            $dateLabel = Carbon::parse($data->date)->format('Y-m-d');

            // Add date to labels if it's not already there
            if (!in_array($dateLabel, $labels)) {
                $labels[] = $dateLabel;
            }

            // Initialize the array if not already set
            if (!isset($dataByDate[$dateLabel])) {
                $dataByDate[$dateLabel] = [
                    'delivered' => 0,
                    'damage' => 0,
                    'cancel' => 0,
                ];
            }

            // Assign the counts to the correct status
            switch ($data->order_status) {
                case 'delieverd':
                    $dataByDate[$dateLabel]['delivered'] = $data->total;
                    break;
                case 'damage':
                    $dataByDate[$dateLabel]['damage'] = $data->total;
                    break;
                case 'cancel':
                    $dataByDate[$dateLabel]['cancel'] = $data->total;
                    break;
            }
        }

        // Now we need to build the data arrays for each status
        $deliveredData = [];
        $damageData = [];
        $cancelData = [];

        foreach ($labels as $date) {
            $deliveredData[] = $dataByDate[$date]['delivered'];
            $damageData[] = $dataByDate[$date]['damage'];
            $cancelData[] = $dataByDate[$date]['cancel'];
        }

        // Prepare the final chart data
        $chartData = [
            'labels' => $labels,
            'datasets' => [
                'delivered' => $deliveredData,
                'damage' => $damageData,
                'cancel' => $cancelData,
            ],
        ];
        return $chartData;
    }
}
