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
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h4>Edit Category</h4>

                    <a href="{{ route('category.index') }}" class="btn btn-primary">List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Category Name</label>
                                    <input type="text" placeholder="Entire Name" class="form-control @error('name') is-invalid @enderror" name="category_name" value="{{ $category->category_name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" name="category_image">
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Category Icon</label>
                                    <input type="file" class="form-control" name="category_icon">
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">SEO Titile</label>
                                    <input type="text" placeholder="Entire Email" class="form-control"  name="seo_title" value="{{ $category->seo_title }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">SEO Description</label>
                                    <textarea class="form-control" name="seo_description" id="" cols="30" rows="10">{{ $category->seo_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">SEO Tags</label>
                                    <input type="text" placeholder="Entire Tags" class="form-control"  name="seo_tags" value="{{ $category->seo_tags }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label"></label>
                                    <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">+ Update Category</button>
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
