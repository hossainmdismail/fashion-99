@extends('backend.master')
@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Banner List </h2>
            <p>Here Your All Catego.</p>
        </div>
        <div>
            <input type="text" placeholder="Search order ID" class="form-control bg-white">
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-2 col-6 col-md-3">
                    <a href="{{ route('banner.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Banner Category</th>
                            <th scope="col">Image</th>
                            <th scope="col">Banner Title</th>
                            <th scope="col">Link</th>
                            <th scope="col" class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $key => $request)
                        <tr>
                            <td><b>{{ $request->category?$request->category->category_name:'Unknown' }}</b></td>
                            <td>
                                <img style="width: 50px;" src="{{ asset('files/banner/'. $request->banner_image) }}" alt="">
                            </td>
                            <td><b>{{ $request->banner_title }}</b></td>
                            <td><b>{{ $request->link }}</b></td>
                            <form action="{{ route('banner.destroy',$request->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <td class="text-end">
                                    <a href="{{ route('banner.edit', $request->id) }}" class="btn btn-md rounded font-sm">Edit</a>
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
