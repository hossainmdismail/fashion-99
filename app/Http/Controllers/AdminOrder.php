<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Config;
use League\Csv\Writer;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Enan\PathaoCourier\Facades\PathaoCourier;
use Enan\PathaoCourier\Requests\PathaoUserSuccessRateRequest;
use Illuminate\Support\Facades\Auth;

class AdminOrder extends Controller
{
    public function order(Request $request)
    {
        // Start the query, joining users table
        $query = Order::query()->join('users', 'users.id', '=', 'orders.user_id');
        $perPage = 20;

        // Search filter for order_id, user name, or user number
        if (!empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('orders.order_id', 'like', '%' . $request->search . '%')
                    ->orWhere('users.name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.number', 'like', '%' . $request->search . '%');
            });
        }

        if (!empty($request->perPage)) {
            $perPage = $request->perPage;
        }
        // Filter by date
        if (!empty($request->date)) {
            $query->whereDate('orders.created_at', $request->date);
        }

        // Filter by status
        if ($request->status !== null && $request->status !== '') {
            $query->where('orders.order_status', $request->status);
        }

        // Select fields from both orders and users tables, and paginate
        $orders = $query->select('orders.*', 'users.name as user_name', 'users.number as user_phone')
            ->orderBy('orders.id', 'DESC')
            ->paginate($perPage)
            ->withQueryString();

        return view('backend.order.index', compact('orders'));
    }

    public function orderView($id)
    {
        // dd(Auth::guard('admin')->user()->role == 'superAdmin');
        $config = Config::first();
        $order = Order::find($id);
        $order->notification = 0;

        if ($order->employee_id == null && Auth::guard('admin')->user()->role == 'employee') {
            $order->employee_id = Auth::guard('admin')->user()->id;
        }
        $order->save();

        if (Auth::guard('admin')->user()->role == 'employee') {
            return view('backend.order.employee', [
                'order'  => $order,
                'config' => $config,
            ]);
        } else {
            return view('backend.order.view', [
                'order'  => $order,
                'config' => $config,
            ]);
        }
    }

    public function orderEdit($id)
    {
        $order = Order::findOrFail($id);
        // $pathaoCities = PathaoCourier::GET_AREAS();

        return response()->json([
            'html' => view('backend.order.edit', [
                'order' => $order,
                // 'cities' => $pathaoCities,
            ])->render()
        ]);
    }

    public function orderViewModify(Request $request)
    {
        $request->validate([
            'btn'       => 'required',
            'id'        => 'required',
            'status'    => 'required'
        ]);

        $order = Order::find($request->id);
        $config = Config::first();
        $image = '';
        if ($config) {
            $image = asset('files/config/' . $config->logo);
        }
        $order->order_status    = $request->status;
        $order->admin_message   = $request->notes;
        $order->save();
        return back()->with('succ', 'updated');
    }

    public function csvDownload(Request $request)
    {

        $ids = $request->status;

        if (!is_array($ids)) {
            return back()->with('error', 'Invalid input for order IDs');
        }

        $orderIds = array_map('intval', $ids);

        $model = Order::whereIn('id', $ids)->get();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Invoice', 'Name', 'Address', 'Phone', 'Amount', 'Note']);

        foreach ($model as $order) {
            $csv->insertOne([$order->order_id, $order->user ? $order->user->name : '', $order->user ? $order->user->address : '', $order->user ? $order->user->number : '', $order->price, $order->admin_message]);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return Response::make($csv->output(), 200, $headers);
    }

    public function payment(Request $request)
    {
        $request->validate([
            'order_id'       => 'required',
            'type'           => 'required',
            'price'          => 'required|integer',
        ]);


        $order = Order::find($request->order_id);
        if (!$order) {
            return back();
        }
        if ($request->payment_status != null) {
            $order->payment_status = $request->payment_status;
            $order->save();
        }


        $payment = new OrderPayment();
        $payment->order_id          = $request->order_id;
        $payment->payment_type      = $request->type;
        $payment->price             = $request->price;
        $payment->transaction_id    = $request->transaction_id;
        $payment->save();
        return back()->with('succ', 'Payment added');
    }

    public function orderHistory($user_id)
    {

        // dd($pataho);
        $pathao = [];

        //get the user
        $user = User::find($user_id);

        //get pathao information
        if ($user && $user->number) {
            $request = new PathaoUserSuccessRateRequest([
                'phone' => $user->number
            ]);
            $patahoData = PathaoCourier::GET_USER_SUCCESS_RATE($request);
            $pathao = $patahoData;
        }

        // dd($pathao);


        $data = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();

        $totalCancelledOrders = Order::where('user_id', $user_id)
            ->whereIn('order_status', ['cancel', 'damage', 'return'])
            ->count();

        $totalConfirmedOrders = Order::where('user_id', $user_id)
            ->whereIn('order_status', ['processing', 'shipping', 'delieverd', 'pending'])
            ->count();

        return view('backend.order.history', [
            'datas' => $data,
            'purchase' => $data->sum('price'),
            'green' => $totalConfirmedOrders,
            'red' => $totalCancelledOrders,
            'pathao' => $pathao
        ]);
    }

    public function xlsxDownload(Request $request)
    {
        $ids = $request->checkValue;

        // Check if `checkValue` is provided and is a non-empty string
        if (empty($ids) || !is_string($ids)) {
            return back()->with('error', 'Invalid input for order IDs');
        }

        // Convert the comma-separated string into an array of integers
        $orderIds = array_map('intval', explode(',', $ids));

        // Validate the array
        if (empty($orderIds) || !is_array($orderIds)) {
            return back()->with('error', 'Invalid input for order IDs');
        }

        $orders = Order::whereIn('id', $orderIds)->get();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Your Name')
            ->setTitle('Orders Export')
            ->setSubject('Orders Export')
            ->setDescription('Export of order data.');

        // Add headers
        $sheet->setCellValue('A1', 'Invoice')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Address')
            ->setCellValue('D1', 'Phone')
            ->setCellValue('E1', 'Amount')
            ->setCellValue('F1', 'Note');

        // Add data rows
        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order->order_id)
                ->setCellValue('B' . $row, $order->user ? $order->user->name : '')
                ->setCellValue('C' . $row, $order->user ? $order->user->address : '')
                ->setCellValue('D' . $row, $order->user ? $order->user->number : '')
                ->setCellValue('E' . $row, $order->price)
                ->setCellValue('F' . $row, $order->admin_message);
            $row++;
        }

        // Write an .xlsx file
        $writer = new Xlsx($spreadsheet);

        // Create a temporary file in the system's temporary directory
        $fileName = 'order-list.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Save to file
        $writer->save($temp_file);

        // Return the file as a download response
        return response()->download($temp_file, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])->deleteFileAfterSend(true);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'updateStatus' => 'required|string',
            'checkValue' => 'required|string',
        ]);

        $orderIds = explode(',', $request->checkValue);
        $newStatus = $request->updateStatus;
        $updatedOrders = Order::whereIn('id', $orderIds)->update(['order_status' => $newStatus]);

        if ($updatedOrders > 0) {
            return back()->with('succ', "{$updatedOrders} orders have been updated to '{$newStatus}' status.");
        } else {
            return back()->with('err', 'No orders were updated. Please check the selected orders.');
        }
    }
}
