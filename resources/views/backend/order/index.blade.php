@extends('backend.master')
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
    function getStatusLabel($status)
    {
        switch ($status) {
            case 'pending':
                return 'Pending';
            case 'processing':
                return 'Processing';
            case 'shipping':
                return 'Shipping';
            case 'return':
                return 'Pending Payment';
            case 'cancel':
                return 'Cancelled';
            case 'damage':
                return 'On Hold';
            case 'delieverd':
                return 'Complete';
            default:
                return 'Unknown';
        }
    }

@endphp
@section('content')
    <div class="content-main">
        <div class="card mb-4">
            {{-- @csrf --}}
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-md-4">
                        <form action="{{ route('csv.download') }}" method="POST">
                            @csrf
                            <input type="hidden" id="csvValue" class="csvValue" name="checkValue">
                            <button type="submit" style="height: fit-content;inline-size: max-content;"
                                class="btn btn-primary">Download CSV</button>
                        </form>
                    </div>

                    <form action="" class="col-md-8 d-flex flex-column flex-md-row gap-2">
                        <select class="form-select" name="status">
                            <option value="" selected>Status</option>
                            <option value="pending"
                                {{ request()->has('status') && request('status') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="processing"
                                {{ request()->has('status') && request('status') == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="shipping"
                                {{ request()->has('status') && request('status') == 'shipping' ? 'selected' : '' }}>
                                Shipping
                            </option>
                            <option value="return"
                                {{ request()->has('status') && request('status') == 'return' ? 'selected' : '' }}>
                                Pending Payment
                            </option>
                            <option value="cancel"
                                {{ request()->has('status') && request('status') == 'cancel' ? 'selected' : '' }}>
                                Cancel
                            </option>
                            <option value="damage"
                                {{ request()->has('status') && request('status') == 'damage' ? 'selected' : '' }}>
                                On Hold
                            </option>
                            <option value="delieverd"
                                {{ request()->has('status') && request('status') == 'delieverd' ? 'selected' : '' }}>
                                Complete
                            </option>
                        </select>
                        <select class="form-select" name="perPage">
                            @foreach ([20, 30, 50, 100, 200] as $option)
                                <option value="{{ $option }}" {{ request('perPage') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        <input type="date" name="date" class="form-control"
                            value="{{ old('date', request('date')) }}">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.order') }}" type="submit" class="btn btn-secondary">Clear</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (session('succ'))
            <div class="alert alert-success" role="alert">
                {{ session('succ') }}
            </div>
        @endif
        @if (session('err'))
            <div class="alert alert-success" role="alert">
                {{ session('err') }}
            </div>
        @endif
        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">
                    <form action="{{ route('change.order.status') }}" method="POST" class="col-md-6 d-flex gap-3">
                        @csrf
                        <div class="w-100">
                            <select class="form-select btn-custom" name="updateStatus" id="statusSelect" required>
                                <option value="" selected>Update Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipping">Shipping</option>
                                <option value="return">Pending Payment</option>
                                <option value="cancel">Cancel</option>
                                <option value="damage">On Hold</option>
                                <option value="delieverd">Complete</option>
                            </select>
                        </div>
                        <input type="hidden" id="csvValue" class="csvValue" name="checkValue">

                        <button type="submit" style="height: fit-content" class="btn btn-primary" name="btn"
                            value="update">Update</button>
                    </form>
                    <form action="" class="col-md-6 d-flex gap-3">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Search by name and id">

                        <button type="submit" style="height: fit-content" class="btn btn-primary">Search</button>

                    </form>
                </div>
            </header>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkAll" title="Select All" />
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Total</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr @if ($order->notification == 1) style="background: #6de9ed2b;" @endif>
                                    <td>
                                        <input class="form-check-input status-checkbox" name="status[]" type="checkbox"
                                            value="{{ $order->id }}" />
                                    </td>
                                    <td>
                                        <b>{{ $order->user ? $order->user->name : 'Unknown' }}</b><br>
                                        <span style="font-size: 10px; font-weight: 800;">#{{ $order->order_id }}</span>
                                    </td>
                                    <td>
                                        {{ $order->user ? $order->user->number : 'Null' }}<br>
                                        @if ($order->user)
                                            <span
                                                class="badge rounded-pill alert-{{ $order->user->is_blocked == 1 ? 'danger' : '' }}">
                                                {{ $order->user->is_blocked == 1 ? 'Blocked' : '' }}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($order->price, 0) }} Tk</td>
                                    <td>
                                        @if ($order->employee)
                                            <span
                                                class="badge rounded-pill alert-secondary">{{ $order->employee->name }}</span>
                                        @else
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
                                                    aria-valuenow="{{ $orderHealth }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $orderHealth }}%
                                                </div>
                                            </div>
                                        @endif

                                        <br>

                                    </td>
                                    <td><span
                                            class="badge rounded-pill alert-{{ getStatusColor($order->order_status) }}">{{ getStatusLabel($order->order_status) }}</span>
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
                {{ $orders->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('input[name="status[]"]');
            checkAll.addEventListener('click', function() {
                console.log(checkboxes);

                checkboxes.forEach((checkbox) => {
                    checkbox.checked = checkAll.checked;
                });
            });
        });
    </script> --}}
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.status-checkbox');
            const csvValueInputs = document.querySelectorAll('.csvValue');

            const updateCsvValue = () => {
                const selectedValues = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value)
                    .join(',');

                csvValueInputs.forEach(input => {
                    input.value = selectedValues;
                });

                console.log(selectedValues);
            };

            checkAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                });
                updateCsvValue();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCsvValue);
            });
        });
    </script>
@endsection
