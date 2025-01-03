@extends('backend.master')
@php
    use Carbon\Carbon;
    $todayDate = Carbon::now()->format('d M'); // Format as 'YYYY-MM-DD'
@endphp
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Dashboard </h2>
                <p>Welcome <strong>{{ Auth::guard('admin')->user()->name }}</p>
            </div>
            <div>
                <a href="{{ route('sitemap') }}" class="btn btn-primary"><i
                        class="text-muted material-icons md-post_add"></i>Site Map</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Total Sales</h6>
                            <span>{{ number_format($total_price) }} Tk</span>
                            <span class="text-sm">
                                Shipping fees are not included
                            </span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i
                                class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Orders</h6> <span>{{ $order }}</span>
                            <span class="text-sm">
                                Excluding orders in transit
                            </span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light"><i
                                class="text-warning material-icons md-qr_code"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Products</h6> <span>{{ $total_product }}</span>
                            <span class="text-sm">
                                In {{ $total_cat }} Categories
                            </span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i
                                class="text-info material-icons md-shopping_basket"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Campaign</h6> <span>{{ $camp }}</span>
                            <span class="text-sm">
                                Based in your local time.
                            </span>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Sale statistics</h5>
                        <canvas id="myChart" height="120px"></canvas>
                    </article>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Pending Order</h5>
                            <span class="badge  text-dark">{{ $todayDate }}</span>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--[if BLOCK]><![endif]-->
                                        @foreach ($order_pending as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.order.view', $order->id) }}">
                                                        {{ $order->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="text-dark"
                                                        style="font-weight: 700">{{ number_format($order->price) }}
                                                        Tk</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> <!-- content-main end// -->
@endsection

@section('script')
    <script>
        /*Sale statistics Chart*/
        if ($('#myChart').length) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {!! json_encode($chart['labels']) !!},
                    datasets: [{
                            label: 'Delivered',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(4, 209, 130, 0.2)',
                            borderColor: 'rgb(4, 209, 130)',
                            data: {!! json_encode($chart['datasets']['delivered']) !!}
                        },
                        {
                            label: 'Damage',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(44, 120, 220, 0.2)',
                            borderColor: 'rgba(44, 120, 220)',
                            data: {!! json_encode($chart['datasets']['damage']) !!}
                        },
                        {
                            label: 'Cancel',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(380, 200, 230, 0.2)',
                            borderColor: 'rgb(380, 200, 230)',
                            data: {!! json_encode($chart['datasets']['cancel']) !!}
                        }

                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        }
                    }
                }
            });
        } //End if
    </script>
@endsection
