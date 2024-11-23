@php
    function getStatusColor($status)
    {
        switch ($status) {
            case 'pending':
                return 'warning';
            case 'processing':
                return 'info';
            case 'shipping':
                return 'primary';
            case 'return':
                return 'secondary';
            case 'cancel':
                return 'danger';
            case 'damage':
                return 'dark';
            case 'delieverd':
                return 'success';
            default:
                return 'secondary';
        }
    }
@endphp

<form action="{{ route('csv.download') }}" method="POST" class="content-main">
    @csrf
    <div class="content-header">
        <div>
            <input type="date" wire:model.live="date" class="form-control">
        </div>
        <div>
            <input type="text" wire:model.live="search" placeholder="Search order ID" class="form-control bg-white">
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <div class="dropdown mb-3">
                        <button class="btn btn-custom dropdown-toggle" type="button" id="statusDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Update Status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('pending')">Pending</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('processing')">Processing</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('shipping')">Shipping</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('return')">Return</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('cancel')">Cancel</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" wire:click.prevent="updateStatus('damage')">On
                                    hold</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    wire:click.prevent="updateStatus('delieverd')">Complete</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select" wire:model.live="status">
                        <option value="">Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipping">Shipping</option>
                        <option value="return">Return</option>
                        <option value="cancel">Cancel</option>
                        <option value="damage">On hold</option>
                        <option value="delieverd">Complete</option>
                    </select>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select" wire:model.live="perPage">
                        @foreach ([100, 300, 40, 20] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <button type="submit" class="btn btn-primary">Download XLSX</button>
                </div>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" id="checkAll" type="checkbox"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Total</th>
                            <th scope="col">Health</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr @if ($order->notification == 1) style="background: #6de9ed2b;" @endif>
                                <td>
                                    <input class="form-check-input" name="status[]" type="checkbox"
                                        value="{{ $order->id }}" wire:model="check">
                                </td>
                                <td>
                                    <b>{{ $order->user ? $order->user->name : 'Unknown' }}</b><br>
                                    <span style="font-size: 10px; font-weight: 800;">#{{ $order->order_id }}</span>
                                </td>
                                <td>
                                    {{ $order->user ? $order->user->number : 'Null' }}<br>
                                    {{ $order->user ? $order->user->email : 'Null' }}
                                </td>
                                <td>{{ $order->price }} Tk</td>
                                <td>
                                    @php
                                        $orderHealth = $order->health($order->user_id);
                                        $progressBarColor =
                                            $orderHealth >= 80
                                                ? 'bg-success'
                                                : ($orderHealth >= 50
                                                    ? 'bg-warning'
                                                    : 'bg-danger');
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar {{ $progressBarColor }}" role="progressbar"
                                            style="width: {{ $orderHealth }}%; font-size:10px;"
                                            aria-valuenow="{{ $orderHealth }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $orderHealth }}%
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge rounded-pill alert-{{ getStatusColor($order->order_status) }}">{{ $order->order_status == 'delieverd' ? 'Complete' : $order->order_status }}</span>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d-M-y') }}<br>
                                    <span
                                        style="font-size: 11px; background: #cbcbcb4f; padding: 2px 7px; border-radius: 10px; color:#00000091">{{ $order->created_at->format('g:i A') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.order.view', $order->id) }}"
                                        class="btn btn-md rounded font-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            {{ $orders->links('livewire::bootstrap') }}
        </nav>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('input[name="status[]"]');
        checkAll.addEventListener('click', function() {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = checkAll.checked;
            });
        });
    });
</script>

{{-- @php
    function getStatusColor($status)
    {
        switch ($status) {
            case 'pending':
                return 'warning';
            case 'processing':
                return 'info';
            case 'shipping':
                return 'primary';
            case 'return':
                return 'secondary';
            case 'cancel':
                return 'danger';
            case 'damage':
                return 'dark';
            case 'delieverd':
                return 'success';
            default:
                return 'secondary';
        }
    }
@endphp
<form action="{{ route('csv.download') }}" method="POST" class="content-main">
    @csrf
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order List </h2>
            <p>Lorem ipsum dolor sit amet.</p>
        </div>
        <div>
            <input type="text" wire:model.live="search" placeholder="Search order ID" class="form-control bg-white">
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="date" wire:model.live="date" class="form-control">
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select" wire:model.live="status">
                        <option value="">Status</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipping" {{ $status == 'shipping' ? 'selected' : '' }}>Shipping</option>
                        <option value="return" {{ $status == 'return' ? 'selected' : '' }}>Return</option>
                        <option value="cancel" {{ $status == 'cancel' ? 'selected' : '' }}>cancel</option>
                        <option value="damage" {{ $status == 'damage' ? 'selected' : '' }}>Damage</option>
                        <option value="delieverd" {{ $status == 'delieverd' ? 'selected' : '' }}>Complete</option>
                    </select>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <button type="submit" class="btn btn-primary">xlsx <svg style="margin-left: 6px" width="16px"
                            height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.5"
                                d="M3 15C3 17.8284 3 19.2426 3.87868 20.1213C4.75736 21 6.17157 21 9 21H15C17.8284 21 19.2426 21 20.1213 20.1213C21 19.2426 21 17.8284 21 15"
                                stroke="#F8F9FA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" stroke="#F8F9FA" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg></button>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" id="checkAll" type="checkbox"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Total</th>
                            <th scope="col">Health</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr @if ($order->notification == 1) style="background: #6de9ed2b;" @endif>
                                <td>
                                    <input class="form-check-input" name="status[]" type="checkbox"
                                        value="{{ $order->id }}" wire:model="check">
                                </td>
                                <td><b>
                                        {{ $order->user ? $order->user->name : 'Unknown' }} <br>
                                        <span
                                            style="font-size: 12px; font-size: 10px; font-weight: 800;">#{{ $order->order_id }}</span>
                                    </b></td>
                                <td>
                                    {{ $order->user ? $order->user->number : 'Null' }}
                                    <br>
                                    {{ $order->user ? $order->user->email : 'Null' }}


                                </td>
                                <td>{{ $order->price }} Tk</td>
                                <td>
                                    @php
                                        // Calculate the health percentage for each order
                                        $orderHealth = $order->health($order->user_id);

                                        // Determine the color based on the health percentage
                                        if ($orderHealth >= 80) {
                                            $progressBarColor = 'bg-success'; // Green for 80% and above
                                        } elseif ($orderHealth >= 50) {
                                            $progressBarColor = 'bg-warning'; // Yellow for 50% to 79%
                                        } else {
                                            $progressBarColor = 'bg-danger'; // Red for below 50%
                                        }
                                    @endphp

                                    <!-- Display the progress bar for each order -->
                                    <div class="progress">
                                        <div class="progress-bar {{ $progressBarColor }}" role="progressbar"
                                            style="width: {{ $orderHealth }}%; font-size:10px;font:status-bar"
                                            aria-valuenow="{{ $orderHealth }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $orderHealth }}%
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge rounded-pill alert-{{ getStatusColor($order->order_status) }}">{{ $order->order_status == 'delieverd' ? 'Complete' : $order->order_status }}</span>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d-M-y') }}
                                    <br>
                                    <span
                                        style="font-size: 11px;background: #cbcbcb4f;padding: 2px 7px 2px 7px;border-radius: 10px;color:#00000091">{{ $order->created_at->format('g:i A') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.order.view', $order->id) }}"
                                        class="btn btn-md rounded font-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->
    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            {{ $orders->links('livewire::bootstrap') }}
        </nav>
    </div>
</form> <!-- content-main end// -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('input[name="status[]"]');

        checkAll.addEventListener('click', function() {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = checkAll.checked;
            });
        });
    });
</script> --}}
