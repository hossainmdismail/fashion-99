<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Config;
use League\Csv\Writer;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        ]);
    }

    public function xlsxDownload(Request $request)
    {
        $ids = $request->status;

        if (!is_array($ids)) {
            return back()->with('error', 'Invalid input for order IDs');
        }

        $orderIds = array_map('intval', $ids);
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
}
