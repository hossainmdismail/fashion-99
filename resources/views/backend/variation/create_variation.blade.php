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
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Add New Service</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('variation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Service Logo</label>
                                        <input type="file" placeholder="Entire Name" class="form-control" name="logo">
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Service Message</label>
                                        <textarea type="text" placeholder="Entire Name" class="form-control" name="variation_name"> </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label"></label>
                                        <button type="submit"
                                            class="btn btn-light rounded font-sm mr-5 text-body hover-up">+ Add
                                            Service</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </section>
@endsection
