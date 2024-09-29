@extends('backend.master')
@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Category List </h2>
            {{-- <p>Here Your All Catego.</p> --}}
        </div>
        <div>
            <input type="text" placeholder="Search order ID" class="form-control bg-white">
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">

                <div class="col-lg-2 col-6 col-md-3">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Category Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Seo Title</th>
                            <th scope="col">Seo Tag</th>
                            <th scope="col" class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td><b>{{ $category->category_name }}</b></td>
                            <td>
                                <img style="width: 50px; height: 50px;" src="{{ asset('files/category/'. $category->category_image) }}" alt="">
                            </td>
                            <td><b>{{ $category->seo_title }}</b></td>
                            <td><b>{{ $category->seo_tags }}</b></td>
                            <form action="{{ route('category.destroy',$category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <td class="text-end">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-md rounded font-sm">Edit</a>
                                    @if (Auth::guard('admin')->user()->role == 'superAdmin')
                                        <button type="submit" class="btn btn-md bg-warning rounded font-sm">Delete</button>
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
