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

    public $search = '';
    public $status = '';
    public $date = '';
    public $check = [];
    public $perPage = 100; // Default items per page
    public $perPageOptions = [10, 20, 40, 90]; // Pagination options
    public $selectAll = false;

    public function updatedPerPage($value)
    {
        $this->perPage = (int) $value;
        $this->resetPage(); // Reset to the first page when the perPage value changes
    }

    // Function to update status of selected rows
    public function updateStatus($newStatus)
    {
        // Validate the input status (optional)
        if (!in_array($newStatus, ['pending', 'processing', 'shipping', 'return', 'cancel', 'damage', 'delieverd'])) {
            session()->flash('error', 'Invalid status provided.');
            return;
        }
        if (empty($this->check)) {
            session()->flash('error', 'No orders selected.');
            return;
        }
        // Update the status for the selected rows
        ModelsOrder::whereIn('id', $this->check)->update(['order_status' => $newStatus]);

        // Clear selections
        $this->check = [];

        // Flash a success message
        session()->flash('success', 'Status updated successfully.');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'status', 'date'])) {
            $this->resetSelection();
        }
    }

    private function resetSelection()
    {
        $this->selectAll = false;
        $this->check = [];
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $currentPageIds = ModelsOrder::query()
                ->where(function ($query) {
                    $query->where('order_id', 'like', '%' . $this->search . '%');
                })
                ->when($this->date, function ($query) {
                    $query->whereDate('created_at', $this->date);
                })
                ->when($this->status != '', function ($query) {
                    $query->where('order_status', $this->status);
                })
                ->orderBy('id', 'DESC')
                ->paginate($this->perPage)
                ->pluck('id')
                ->toArray();

            $this->check = $currentPageIds;
        } else {
            $this->check = [];
        }
    }


    public function render()
    {
        $query = ModelsOrder::query()
            ->where(function ($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->when($this->status != '', function ($query) {
                $query->where('order_status', $this->status);
            });

        $orders = $query->orderBy('id', 'DESC')->paginate($this->perPage);

        $this->check = array_intersect($this->check, $orders->pluck('id')->toArray());


        return view('livewire.backend.order', [
            'orders' => $orders,
            'perPageOptions' => $this->perPageOptions,
        ]);
    }
}
