<?php

namespace App\Livewire\Backend;

use App\Models\Order as ModelsOrder;
use Livewire\Component;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;

    public $search  = '';
    public $status  = '';
    public $date    = '';
    public $check   = [];


    // public function checkRender()
    // {
    //     // Check if $this->check is an array of order IDs
    //     if (!is_array($this->check)) {
    //         // Handle the case where $this->check is not an array
    //         return back()->with('error', 'Invalid input for order IDs');
    //     }

    //     // Convert the order IDs to integers
    //     $orderIds = array_map('intval', $this->check);

    //     // Find orders based on the array of IDs
    //     $model = ModelsOrder::whereIn('id', $orderIds)->get();

    //     // Create a CSV file and add the header
    //     $csv = Writer::createFromFileObject(new \SplTempFileObject());
    //     $csv->insertOne(['Order ID', 'Name', 'Number', 'Date']);

    //     // Add order data to the CSV
    //     foreach ($model as $order) {
    //         $csv->insertOne([$order->order_id, $order->name, $order->price, $order->created_at]);
    //     }

    //     // Set the HTTP headers for CSV download
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="orders.csv"',
    //         'Pragma' => 'no-cache',
    //         'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
    //         'Expires' => '0',
    //     ];

    //     info('Headers:', $headers);

    //     // Return the CSV file as a response
    //     $return = Response::make($csv->output(), 200, $headers);
    //     dd($return);
    // }


    public function render()
    {
        $query = ModelsOrder::query()
            ->where(function ($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', '>=', $this->date);
            });

        if ($this->status != '') {
            $query->where('order_status', $this->status);
        }

        // if ($this->category !== '') {
        //     $query->where('category_id', $this->category); // Adjust 'category_id' with your actual column name
        // }

        $order = $query->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.backend.order', [
            'orders' => $order
        ]);
    }
}
