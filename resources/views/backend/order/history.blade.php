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
@section('content')
    <div class="container">
        <div class="content-main">
            {{-- <div class="content-header"> --}}
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            {{-- <span class="icon icon-sm rounded-circle bg-primary-light"> --}}
                            <svg style="margin-right: 10px" width="45px" height="45px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 6V18" stroke="#4F5D77" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                    stroke="#4F5D77" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                    stroke="#4F5D77" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            {{-- </span> --}}
                            <div class="text">
                                <h6 class="mb-1 card-title">Purchase</h6>
                                <span>{{ number_format($purchase) }} Tk</span>
                                <span class="text-sm">
                                    Total purchase
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <svg style="margin-right: 10px" width="45px" height="45px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                    d="M20.5 7V13C20.5 16.7712 20.5 18.6569 19.3284 19.8284C18.1569 21 16.2712 21 12.5 21H11.5C7.72876 21 5.84315 21 4.67157 19.8284C3.5 18.6569 3.5 16.7712 3.5 13V7"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M2 5C2 4.05719 2 3.58579 2.29289 3.29289C2.58579 3 3.05719 3 4 3H20C20.9428 3 21.4142 3 21.7071 3.29289C22 3.58579 22 4.05719 22 5C22 5.94281 22 6.41421 21.7071 6.70711C21.4142 7 20.9428 7 20 7H4C3.05719 7 2.58579 7 2.29289 6.70711C2 6.41421 2 5.94281 2 5Z"
                                    stroke="#1C274C" stroke-width="1.5" />
                                <path d="M9.5 13.4L10.9286 15L14.5 11" stroke="#1C274C" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text">
                                <h6 class="mb-1 card-title">Orders</h6> <span>{{ count($datas) }}</span>
                                <span class="text-sm">
                                    Total orders
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <svg style="margin-right: 10px" width="45px" height="45px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                    stroke="#046963" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5"
                                    d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                    stroke="#1C274C" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                    stroke="#1C274C" stroke-width="1.5" />
                                <path opacity="0.5" d="M11 9H8" stroke="#1C274C" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path
                                    d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                    stroke="#046963" stroke-width="1.5" />
                            </svg>
                            <div class="text">
                                <h6 class="mb-1 card-title">Delivered</h6> <span>{{ $green }}</span>
                                <span class="text-sm">
                                    Delivered/Process/Pending
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <svg style="margin-right: 10px" width="45px" height="45px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                    d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                    stroke="#1C274C" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                    stroke="#1C274C" stroke-width="1.5" />
                                <path
                                    d="M2.26121 3.09184L2.50997 2.38429H2.50997L2.26121 3.09184ZM2.24876 2.29246C1.85799 2.15507 1.42984 2.36048 1.29246 2.75124C1.15507 3.14201 1.36048 3.57016 1.75124 3.70754L2.24876 2.29246ZM4.58584 4.32298L5.20507 3.89983V3.89983L4.58584 4.32298ZM5.88772 14.5862L5.34345 15.1022H5.34345L5.88772 14.5862ZM20.6578 9.88275L21.3923 10.0342L21.3933 10.0296L20.6578 9.88275ZM20.158 12.3075L20.8926 12.4589L20.158 12.3075ZM20.7345 6.69708L20.1401 7.15439L20.7345 6.69708ZM19.1336 15.0504L18.6598 14.469L19.1336 15.0504ZM5.70808 9.76V7.03836H4.20808V9.76H5.70808ZM2.50997 2.38429L2.24876 2.29246L1.75124 3.70754L2.01245 3.79938L2.50997 2.38429ZM10.9375 16.25H16.2404V14.75H10.9375V16.25ZM5.70808 7.03836C5.70808 6.3312 5.7091 5.7411 5.65719 5.26157C5.60346 4.76519 5.48705 4.31247 5.20507 3.89983L3.96661 4.74613C4.05687 4.87822 4.12657 5.05964 4.1659 5.42299C4.20706 5.8032 4.20808 6.29841 4.20808 7.03836H5.70808ZM2.01245 3.79938C2.68006 4.0341 3.11881 4.18965 3.44166 4.34806C3.74488 4.49684 3.87855 4.61727 3.96661 4.74613L5.20507 3.89983C4.92089 3.48397 4.54304 3.21763 4.10241 3.00143C3.68139 2.79485 3.14395 2.60719 2.50997 2.38429L2.01245 3.79938ZM4.20808 9.76C4.20808 11.2125 4.22171 12.2599 4.35876 13.0601C4.50508 13.9144 4.79722 14.5261 5.34345 15.1022L6.43198 14.0702C6.11182 13.7325 5.93913 13.4018 5.83723 12.8069C5.72607 12.1578 5.70808 11.249 5.70808 9.76H4.20808ZM10.9375 14.75C9.52069 14.75 8.53763 14.7482 7.79696 14.6432C7.08215 14.5418 6.70452 14.3576 6.43198 14.0702L5.34345 15.1022C5.93731 15.7286 6.69012 16.0013 7.58636 16.1283C8.45674 16.2518 9.56535 16.25 10.9375 16.25V14.75ZM4.95808 6.87H17.0888V5.37H4.95808V6.87ZM19.9232 9.73135L19.4235 12.1561L20.8926 12.4589L21.3923 10.0342L19.9232 9.73135ZM17.0888 6.87C17.9452 6.87 18.6989 6.871 19.2937 6.93749C19.5893 6.97053 19.8105 7.01643 19.9659 7.07105C20.1273 7.12776 20.153 7.17127 20.1401 7.15439L21.329 6.23978C21.094 5.93436 20.7636 5.76145 20.4632 5.65587C20.1567 5.54818 19.8101 5.48587 19.4604 5.44678C18.7646 5.369 17.9174 5.37 17.0888 5.37V6.87ZM21.3933 10.0296C21.5625 9.18167 21.7062 8.47024 21.7414 7.90038C21.7775 7.31418 21.7108 6.73617 21.329 6.23978L20.1401 7.15439C20.2021 7.23508 20.2706 7.38037 20.2442 7.80797C20.2168 8.25191 20.1002 8.84478 19.9223 9.73595L21.3933 10.0296ZM16.2404 16.25C17.0021 16.25 17.6413 16.2513 18.1566 16.1882C18.6923 16.1227 19.1809 15.9794 19.6074 15.6318L18.6598 14.469C18.5346 14.571 18.3571 14.6525 17.9744 14.6994C17.5712 14.7487 17.0397 14.75 16.2404 14.75V16.25ZM19.4235 12.1561C19.2621 12.9389 19.1535 13.4593 19.0238 13.8442C18.9007 14.2095 18.785 14.367 18.6598 14.469L19.6074 15.6318C20.0339 15.2842 20.2729 14.8346 20.4453 14.3232C20.6111 13.8312 20.7388 13.2049 20.8926 12.4589L19.4235 12.1561Z"
                                    fill="#A00000" />
                                <path opacity="0.5" d="M11.5 12.5L14.5 9.5M14.5 12.5L11.5 9.5" stroke="#1C274C"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <div class="text">
                                <h6 class="mb-1 card-title">Canceled</h6> <span>{{ $red }}</span>
                                <span class="text-sm">
                                    Cancel/Damage/Return
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4">
                    @if ($pathao && isset($pathao['data']['customer']))
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <img src="{{ asset('backend/assets/imgs/pathao.png') }}" width="65"
                                    style="margin-right: 1rem" alt="">
                                <div class="text">
                                    <h6 class="mb-1 card-title text-secondary">Total Delivery :
                                        {{ $pathao['data']['customer']['total_delivery'] }}</h6>
                                    <h6 class="mb-1 card-titl text-success">Success :
                                        {{ $pathao['data']['customer']['successful_delivery'] }}</h6>
                                    <h6 class="mb-1 card-title text-secondary">Fraud Count :
                                        {{ $pathao['data']['fraud_count'] }}</h6>
                                </div>
                            </article>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $pathao['data']['success_rate'] }}%;"
                                    aria-valuenow="{{ $pathao['data']['success_rate'] }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $pathao['data']['success_rate'] }}%
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- </div> --}}
            <div class="card" id="xx">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col" class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $order)
                                    <tr @if ($order->notification == 1) style="background: #6de9ed2b;" @endif>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            <b>
                                                <a href="{{ route('admin.order.view', $order->id) }}"
                                                    style="font-size: 12px; font-size: 10px; font-weight: 800;">#{{ $order->order_id }}</a>
                                            </b>
                                        </td>
                                        <td>{{ $order->price }} Tk</td>
                                        <td><span
                                                class="badge rounded-pill alert-{{ getStatusColor($order->order_status) }}">{{ $order->order_status }}</span>
                                        </td>
                                        <td>
                                            {{ $order->created_at->format('d-M-y') }}
                                            <br>
                                            <span
                                                style="font-size: 11px;background: #cbcbcb4f;padding: 2px 7px 2px 7px;border-radius: 10px;color:#00000091">{{ $order->created_at->format('g:i A') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.order.view', $order->id) }}"
                                                class="btn btn-md rounded font-sm">Check</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
