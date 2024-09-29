@extends('backend.master')
@section('content')
    <section class="content-main">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('succ'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('succ') }}</li>
                </ul>
            </div>
        @endif


        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">

                    <form action="{{ route('config.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" placeholder="Site Name" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Email</label>
                                    <input type="text" placeholder="Site Email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Number</label>
                                    <input type="text" placeholder="Site Number" class="form-control" name="number">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Address</label>
                                    <input type="text" placeholder="Site Address" class="form-control" name="address">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Fav Icon</label>
                                    <input type="file" class="form-control" name="fav">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Site URL</label>
                                    <input type="text" placeholder="https://google.com" class="form-control"
                                        name="url">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label"></label>
                                    <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">+
                                        Configuration</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Number</th>
                                <th scope="col"> Fav </th>
                                <th scope="col" class="text-end"> Logo </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($request)
                                <tr>
                                    <td><b>{{ $request->name }}</b></td>
                                    <td><b>{{ $request->email }}</b></td>
                                    <td><b>{{ $request->address }}</b></td>
                                    <td><b>{{ $request->number }}</b></td>
                                    <td>
                                        <img style="width: 50px;" src="{{ asset('files/config/' . $request->fav) }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <img style="width: 50px;" src="{{ asset('files/config/' . $request->logo) }}"
                                            alt="">
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> <!-- table-responsive //end -->
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </section> <!-- content-main end// -->
@endsection
