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

@extends('backend.master')

@section('style')
    <style>
        .waterColor {
            font-size: 12px;
            font-weight: 400;
            line-height: 14px;
            margin-bottom: 5px;
            color: #00000078;
        }

        @media print {
            .printDisable {
                display: none !important;
            }

            .printEnable {
                display: block !important;
            }
        }

        .printEnable {
            display: none;
        }
    </style>
@endsection



@section('content')


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add.payment') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="">Payment Status</label>
                            <select class="form-control" name="payment_status" id="">
                                <option value="">Select Status</option>
                                <option value="due">Due</option>
                                <option value="paid">Paid</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Payment method</label>
                            <select class="form-control" name="type" id="">
                                <option value="">Select method</option>
                                <option value="Cash">Cash</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Transaction ID</label>
                            <input class="form-control" type="text" name="transaction_id"
                                placeholder="Transaction number">
                        </div>
                        <div class="mb-3">
                            <label for="">Amount</label>
                            <input class="form-control" type="number" name="price" placeholder="0.00">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">+ Add payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- image modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" width="100%" style="border-radius: 5px" alt="Full Size" class="img-fluid">
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        @if (session('succ'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('succ') }}</li>
                </ul>
            </div>
        @endif
        @if (session('err'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('err') }}</li>
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $key => $error)
                        <li>{{ $key . '.' . $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form class="content-main" action="{{ route('admin.order.modify') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $order->id }}">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Order detail</h2>
                <p>Details for Order ID: {{ $order->order_id }}</p>
            </div>
            <div>
                <a href="{{ route('admin.order.history', $order->user_id) }}" type="submit" class="btn btn-secondary"
                    name="btn" value="1">History</a>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add payment
                </button>
                <a class="btn btn-danger" href="{{ route('admin.order') }}">Back</a>
            </div>
        </div>
        <div class="card" id="xx">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                        <span>
                            <i class="material-icons md-calendar_today"></i>
                            <b>{{ $order->created_at->format('D, M j, Y, g:iA') }}</b>
                        </span> <br>
                        <small class="text-muted">Order ID: {{ $order->order_id }}</small>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <select name="status" class="form-select d-inline-block mb-lg-0 mb-15 mw-200">
                            <option value="">Change {{ $order->order_status }}</option>-
                            {{-- <option value="pending">Pending</option> --}}
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="shipping" {{ $order->order_status == 'shipping' ? 'selected' : '' }}>Shipping
                            </option>
                            <option value="return" {{ $order->order_status == 'return' ? 'selected' : '' }}>Return
                            </option>
                            <option value="cancel" {{ $order->order_status == 'cancel' ? 'selected' : '' }}>cancel
                            </option>
                            <option value="damage" {{ $order->order_status == 'damage' ? 'selected' : '' }}>Damage
                            </option>
                            <option value="delieverd" {{ $order->order_status == 'delieverd' ? 'selected' : '' }}>
                                Delieverd
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="btn" value="1">Save</button>
                        <a class="btn btn-secondary print ms-2" name="btn" value="2" id="printButton"><i
                                class="icon material-icons md-print"></i></a>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <div class="row">
                    <div class="col-7" id="sk_print">
                        {{-- logos --}}
                        <div class="row printEnable" style="margin-bottom: 30px">
                            @if ($config)
                                <div style="text-align: center" class="col-12 waterColor">
                                    <h2>{{ $configData->name }}</h2>
                                    <p>{{ $configData->address }}</p>
                                    <p><span>Mobile:{{ $configData->number }}</span> | <span>{{ $configData->url }}</span>
                                    </p>
                                </div>
                            @endif
                            <div class="col-12" style="margin-top: 30px">
                                <h4 style="text-align: center" class="text-right">INVOICE</h4>
                            </div>
                        </div>
                        {{-- information --}}
                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-7">
                                <article class="icontext align-items-start">
                                    <div class="text">
                                        <b style="font-weight: 600">Invoice No : {{ $order->order_id }}</b> <br>
                                        <p class="mb-1 mt-2">
                                            {{ $order->user ? $order->user->name : 'Null' }} <br>
                                            {{ $order->user ? $order->user->number : 'Null' }}<br>
                                            {{ $order->user ? $order->user->email : 'email' }} <br>
                                            {{ $order->user ? $order->user->address : 'Null' }} <br>
                                            <span style="font-size: 14px;font-style: italic" class="printDisable mt-3">
                                                {{ $order->client_message }}
                                            </span>
                                        </p>
                                        {{-- <a href="#">View profile</a> --}}
                                    </div>
                                </article>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-4 " style="text-align: right">
                                {{ $order->created_at->format('D M y') }}
                            </div>

                        </div> <!-- col// -->
                        {{-- table --}}
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="40%">Product</th>
                                            <th width="20%">Unit Price</th>
                                            <th width="20%">Quantity</th>
                                            <th width="20%" class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order->products as $product)
                                            <tr style="border-bottom: 1px solid #bfbfbf">
                                                <td>
                                                    <a class="itemside" href="#">
                                                        <div class="left printDisable">
                                                            <img src="{{ asset('files/product/' . $product->product->image) }}"
                                                                width="40" height="40" class="img-xs"
                                                                alt="Item" data-bs-toggle="modal"
                                                                data-bs-target="#imageModal"
                                                                onclick="showImage(this.src)">
                                                        </div>
                                                        <div class="info">
                                                            @if ($product->product)
                                                                {{ $product->product->product->name }}
                                                                <br>
                                                                <span
                                                                    style="font-size: 11px;color:gray">{{ $product->product->color ? $product->product->color->name : 'Unknown' }}/{{ $product->product->size ? $product->product->size->name : 'Unknown' }}</span>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>৳ {{ $product->price }} </td>
                                                <td>{{ $product->qnt }} </td>
                                                <td class="text-end">৳ {{ $product->price * $product->qnt }} </td>
                                            </tr>
                                        @empty
                                            No Data Found
                                        @endforelse
                                        <tr>
                                            <td colspan="4">
                                                <article class="float-end">
                                                    <dl class="dlist">
                                                        <dt>Subtotal:</dt>
                                                        <dd>৳ {{ $product->price * $product->qnt }}</dd>
                                                    </dl>
                                                    <dl class="dlist">
                                                        <dt>Shipping cost:</dt>
                                                        <dd>৳ {{ $order->shipping_charge }}</dd>
                                                    </dl>
                                                    <dl class="dlist">
                                                        <dt>Grand total:</dt>
                                                        <dd> <b class="h6">৳ {{ $order->price }}</b> </dd>
                                                    </dl>
                                                    @if ($order->payment)
                                                        <dl class="dlist">
                                                            <dt>Paid:</dt>
                                                            <dd class="text-success">
                                                                ৳ {{ $order->totalPayment() }}
                                                            </dd>
                                                        </dl>
                                                        <dl class="dlist">
                                                            <dt>Due:</dt>
                                                            <dd> <b class="h5">৳
                                                                    {{ number_format($order->price - $order->totalPayment()) }}</b>
                                                            </dd>
                                                        </dl>
                                                    @endif
                                                </article>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- table-responsive// -->
                            {{-- <a class="btn btn-primary" href="page-orders-tracking.html">View Order Tracking</a> --}}
                        </div> <!-- col// -->
                    </div>
                    <div class="col-1"></div>
                    <div class="col-4">
                        <div class="row">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-local_shipping"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">Order info</h6>
                                    <p class="mb-1">
                                        Pay method: Cash on delivery <br>
                                    <div class="d-flex gap-2">
                                        Status: <span style="width: fit-content;font-size: 12px"
                                            class="badge badge-sm rounded-pill alert-{{ getStatusColor($order->order_status) }} text-success">
                                            {{ $order->order_status }} </span>
                                    </div>
                                    </p>
                                    {{-- <a href="#">Download info</a> --}}
                                </div>
                            </article>
                        </div> <!-- col// -->
                        <div class="row">
                            <div class="box shadow-sm bg-light">
                                <h6 class="mb-15">Payment info</h6>
                                <p
                                    class="badge rounded-pill alert-{{ $order->payment_status == 'cancel' ? 'danger' : 'success' }}">
                                    {{ $order->payment_status }}</p>
                                @if ($order->payment)
                                    @foreach ($order->payment as $value)
                                        <hr>
                                        <p>
                                            {{ $value->payment_type }} : {{ $value->transaction_id }} <br>
                                            Paid : <span style="font-weight: 800;"> ৳ {{ $value->price }}</span> <br>
                                            <span
                                                style="font-size: 12px">{{ $value->created_at->format('D M d - g:i A') }}</span>
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                            <div class="h-25 pt-4">
                                <div class="mb-3">
                                    <label>Admin Message</label>
                                    <textarea class="form-control" name="notes" id="notes" placeholder="Type some note">{{ $order->admin_message }}</textarea>
                                </div>
                            </div>
                        </div> <!-- col// -->
                    </div> <!-- card-body end// -->
                </div>
            </div> <!-- card end// -->
    </form> <!-- content-main end// -->
@endsection


@section('script')
    <script>
        let printButton = document.getElementById('printButton');
        let invoiceBody = document.getElementById('sk_print').innerHTML;
        let printDisable = document.getElementsByClassName('printDisable');
        let printEnable = document.getElementsByClassName('printEnable');

        printButton.addEventListener("click", function(x) {
            // Hide elements with the class 'printDisable' for screen view
            for (let i = 0; i < printDisable.length; i++) {
                printDisable[i].style.display = 'none';
            }

            // Show elements with the class 'printEnable' for screen view
            for (let i = 0; i < printEnable.length; i++) {
                printEnable[i].style.display = 'block';
            }

            // Save the original document's HTML
            var originalContents = document.body.innerHTML;

            // Replace the body's HTML with the div's HTML
            document.body.innerHTML = invoiceBody;

            // Print the div's contents
            window.print();

            // Restore the original document's HTML
            document.body.innerHTML = originalContents;

            // Optionally reattach event listeners if necessary
            // Alternatively, reload the page to reattach event listeners
            window.location.reload();
        });

        function showImage(src) {
            document.getElementById('modalImage').src = src;
        }
    </script>
@endsection
