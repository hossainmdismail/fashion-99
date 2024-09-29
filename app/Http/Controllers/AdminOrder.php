<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use App\Models\OrderPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use Illuminate\Http\Request;

class AdminOrder extends Controller
{
    public function order()
    {
        return view('backend.order.index');
    }

    public function orderView($id)
    {
        $config = Config::first();
        $order = Order::find($id);
        $order->notification = 0;
        $order->save();

        // dd($order->products);
        return view('backend.order.view', [
            'order'  => $order,
            'config' => $config,
        ]);
    }

    public function orderViewModify(Request $request)
    {
        //dd($request->all());
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

        // if ($request->btn == 1 && $request->status != null && $order) {
        //     $order->order_status    = $request->status;
        //     $order->admin_message   = $request->notes;
        //     $order->save();
        //     return back()->with('succ', 'updated');
        // } elseif ($request->btn == 2 && $order) {
        //     $data = [
        //         'data' => $order,
        //         'logo' => $image,
        //     ];
        //     $pdf = Pdf::loadView('pdf.invoice', $data);
        //     return $pdf->download('invoice.pdf');
        // }
        // return back();
    }

    public function csvDownload(Request $request)
    {

        $ids = $request->status;

        // Check if $this->check is an array of order IDs
        if (!is_array($ids)) {
            // Handle the case where $this->check is not an array
            return back()->with('error', 'Invalid input for order IDs');
        }

        // Convert the order IDs to integers
        $orderIds = array_map('intval', $ids);

        // Find orders based on the array of IDs
        $model = Order::whereIn('id', $ids)->get();

        // Create a CSV file and add the header
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Order ID', 'Name', 'Number', 'Price', 'Date']);

        // Add order data to the CSV
        foreach ($model as $order) {
            $csv->insertOne([$order->order_id, $order->name, $order->number, $order->price, $order->created_at->format('D M y')]);
        }

        // Set the HTTP headers for CSV download
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
}
