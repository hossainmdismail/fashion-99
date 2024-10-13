<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Photo;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function dashboard()
    {
        $product = Product::all();
        $cat = ProductCategory::all()->count();
        $order = Order::all()->count();
        $camp = Campaign::all()->count();
        return view('backend.home.home', [
            'total_product' => $product->count(),
            'total_price'   => $product->sum('price'),
            'total_cat'     => $cat,
            'order'         => $order,
            'camp'          => $camp,
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
}
