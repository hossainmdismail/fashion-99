@extends('backend.master')
@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Shipping List </h2>
            {{-- <p>Here Your All Catego.</p> --}}
        </div>
        <div>
            {{-- <input type="text" placeholder="Search order ID" class="form-control bg-white"> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Shipping Form</h5>
                </div>
                <div class="card-body">
                    @if (session('succ'))
                        <div class="alert alert-success" role="alert">
                           {{ session('succ') }}
                        </div>
                    @endif
                    <form action="{{ route('shipping.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="" placeholder="Shipping name">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="" placeholder="0.00">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">+ Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Shipping List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Shipping Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $shipping)
                                    <tr>
                                        <td><b>{{ $shipping->name }}</b></td>
                                        <td><b>{{ $shipping->price }}</b></td>
                                        <td class="text-end">
                                            <a href="{{ route('shipping.edit', $shipping->id) }}" class="btn btn-md rounded font-sm">Edit</a>

                                            {{-- <a href="{{ route('shipping.destroy', $shipping->id) }}" class="btn btn-md bg-warning rounded font-sm">Delete</a> --}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table-responsive //end -->
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">16</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
            </ul>
        </nav>
    </div> --}}
</section> <!-- content-main end// -->
@endsection
