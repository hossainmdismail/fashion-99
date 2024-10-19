@extends('backend.master')
@section('content')
    <section class="content-main">
        <div class="content-header">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div>
                <h2 class="content-title card-title">Coupon List </h2>

            </div>
            <div>
                <input type="text" placeholder="Search couponID" class="form-control bg-white">
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">

                    <div class="col-lg-2 col-6 col-md-3">
                        <a href="{{ route('coupon.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Type</th>
                                <th scope="col">Code</th>
                                <th scope="col">Value</th>
                                <th scope="col" class="text-end"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ number_format($coupon->value, 0) }} {{ $coupon->type == 'percent' ? '%' : 'Tk' }}</td>

                                    <form action="{{ route('coupon.destroy', $coupon->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <td class="text-end">
                                            <a href="{{ route('coupon.edit', $coupon->id) }}"
                                                class="btn btn-md rounded font-sm">Edit</a>
                                            @if (Auth::guard('admin')->user()->role == 'superAdmin')
                                                <button type="submit"
                                                    class="btn btn-md bg-warning rounded font-sm">Delete</button>
                                            @endif
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- table-responsive //end -->
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->

    </section> <!-- content-main end// -->
@endsection
