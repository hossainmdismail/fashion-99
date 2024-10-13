@extends('backend.master')
@section('style')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <!-- Att add -->
    <div class="modal fade show" id="attr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attributes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('attributes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <div class="modal-body row">
                        <div class="row">
                            <div class="mb-4 col-12">
                                <label for="product_name" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Color</label>
                                <select name="color_id" class="form-select @error('color_id') is-invalid @enderror"
                                    id="">
                                    <option value="">Select Color</option>
                                    @forelse ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            @if (old('color_id') == $color->id) selected @endif>
                                            {{ $color->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Size</label>
                                <select name="size_id" id=""
                                    class="form-select @error('size_id') is-invalid @enderror">
                                    <option value="">Select Size</option>
                                    @forelse ($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            @if (old('size_id') == $size->id) selected @endif>
                                            {{ $size->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <hr>
                            <div class="mb-4 col-md-6">
                                <label for="qnt" class="form-label">Quantity</label>
                                <input type="number" placeholder="0"
                                    class="form-control @error('qnt') is-invalid @enderror" name="qnt"
                                    value="{{ old('qnt') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update -->
    <div class="modal fade show" id="editForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Attributes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editFormFirst" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <div class="modal-body row">
                        <div class="row">
                            <div class="mb-4 col-12">
                                <label for="product_name" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Color</label>
                                <select name="color_id" class="form-select @error('color_id') is-invalid @enderror"
                                    id="">
                                    <option value="">Select Color</option>
                                    @forelse ($colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="product_name" class="form-label">Size</label>
                                <select name="size_id" id=""
                                    class="form-select @error('size_id') is-invalid @enderror">
                                    <option value="">Select Size</option>
                                    @forelse ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <hr>
                            <div class="mb-4 col-md-6">
                                <label for="avlqnt" class="form-label">Available Quantity</label>
                                <input type="number" placeholder="0"
                                    class="form-control @error('avlqnt') is-invalid @enderror" name="avlqnt"
                                    value="{{ old('avlqnt') }}">
                            </div>
                            {{-- <div class="mb-4 col-md-6">
                                <label for="qnt" class="form-label">Add Quantity</label>
                                <input type="number" placeholder="0"
                                    class="form-control @error('qnt') is-invalid @enderror" name="qnt"
                                    value="{{ old('qnt') }}">
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            <form action="{{ route('product.update', $request->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="content-header">
                        <h5 class="content-title">{{ $request->name }}</h5>
                        <div>
                            <a href="{{ route('product.index') }}" name="btn"
                                class="btn btn-md rounded font-sm hover-up">Back</a>
                            <button type="submit" name="btn" value="deactive"
                                class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                            <button type="submit" name="btn" value="active"
                                class="btn btn-md rounded font-sm hover-up">Update</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        {{-- Left --}}
                        <div class="col-md-6">
                            {{-- Basic --}}
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h4>Basic</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Select A Category</label>
                                                    <select class="form-select" name="category_id">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if ($request->category) {{ $request->category->id == $category->id ? 'selected' : '' }} @endif>
                                                                {{ $category->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Product Name</label>
                                                    <input type="text" placeholder="Entire Name" class="form-control"
                                                        name="product_name" value="{{ $request->name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="sku" class="form-label">SKU</label>
                                                    <input type="text" placeholder="Stock-keeping unit"
                                                        class="form-control" name="sku" value="{{ $request->sku }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Short Description</label>
                                                    <textarea class="form-control" name="short_description" id="" cols="30" rows="10"
                                                        placeholder="Short details"> {{ $request->short_description }}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">Description</label>
                                                    <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10"
                                                        placeholder="Short details">{{ $request->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name"
                                                        class="form-label @error('description') text-danger @enderror">Additional
                                                        Information
                                                    </label>
                                                    <textarea id="additional_info" class="form-control" name="additional_info" cols="30" rows="10"
                                                        placeholder="Additional information">{{ $request->additional_info }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- card end// -->
                            </div>

                            {{-- Pricing --}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Price</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="mb-4 col-md-6">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" placeholder="Entire Name"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    name="price" value="{{ number_format($request->price, 0) }}">
                                            </div>
                                            <div class="mb-4 col-md-6">
                                                <label for="stock_price" class="form-label">Stock
                                                    Price</label>
                                                <input type="number" placeholder="Entire Name"
                                                    class="form-control @error('stock_price') is-invalid @enderror"
                                                    name="stock_price"
                                                    value="{{ number_format($request->stock_price, 0) }}">
                                            </div>
                                            <div class="mb-4 col-md-6">
                                                <label for="s_price" class="form-label">Discount
                                                    Price</label>
                                                <input type="number" placeholder="Entire Name"
                                                    class="form-control @error('s_price') is-invalid @enderror"
                                                    name="s_price" value="{{ $request->s_price }}">
                                            </div>
                                            <div class="mb-4 col-md-6">
                                                <label for="product_name" class="form-label">Type</label>
                                                <select name="sp_type" id=""
                                                    class="form-control @error('sp_type') is-invalid @enderror">
                                                    <option value="">Discount Type</option>
                                                    <option value="Fixed"
                                                        @if ($request->sp_type == 'Fixed') selected @endif>Fixed</option>
                                                    <option value="Percent"
                                                        @if ($request->sp_type == 'Percent') selected @endif>Percentage
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="checkFeatured">Feature
                                                    {{ $request->featured }}</label>
                                                <input class="form-check-input" name="featured" type="checkbox"
                                                    id="checkFeatured" {{ $request->featured == 1 ? 'checked' : '' }}>
                                            </div>
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="checkPopular">Popular</label>
                                                <input class="form-check-input" name="popular" type="checkbox"
                                                    id="checkPopular" {{ $request->popular == 1 ? 'checked' : '' }}>
                                            </div>
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="shipping_fee">Shipping free</label>
                                                <input class="form-check-input" name="shipping_fee" type="checkbox"
                                                    id="shipping_fee" {{ $request->shipping_fee == 1 ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SEO --}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>SEO Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">SEO Titile</label>
                                                    <input type="text" placeholder="Entire Email" class="form-control"
                                                        name="seo_title" value="{{ $request->seo_title }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">SEO Tags</label>
                                                    <input type="text" placeholder="Entire Tags"
                                                        value="{{ $request->seo_tags }}" class="form-control"
                                                        name="seo_tags">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label for="product_name" class="form-label">SEO Description</label>
                                                    <textarea class="form-control" name="seo_description" id="" cols="30" rows="10">{{ $request->seo_description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Inventory</h4>
                                    <button class="btn btn-md btn-primary font-sm" data-bs-toggle="modal"
                                        data-bs-target="#attr" type="button">Add Inventroy</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                {{-- <th scope="col">Category Name</th> --}}
                                                <th scope="col">Image</th>
                                                <th scope="col">SKU</th>
                                                {{-- <th scope="col">Price</th> --}}
                                                <th scope="col">Stock</th>
                                                <th scope="col">Status</th>
                                                {{-- <th scope="col">Discount</th> --}}
                                                <th scope="col"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($request->attributes as $attr)
                                                <tr>
                                                    <td>
                                                        <img class="rounded" style="width: 30px; height: 30px;"
                                                            src="{{ asset('files/product/' . $attr->image) }}"
                                                            alt="">
                                                    </td>
                                                    <td>{{ $attr->color ? $attr->color->name : 'Null' }} /
                                                        {{ $attr->size ? $attr->size->name : 'Null' }}</td>
                                                    {{-- <td><b> <span>৳</span> {{ $attr->price }} </b></td> --}}
                                                    <td>
                                                        <span class="badge bg-info text-dark">{{ $attr->qnt }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $request->status == 'active' ? 'success' : 'warning' }}">{{ $request->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a data-bs-val="{{ route('attributes.edit', $attr->id) }}"
                                                            data-bs-peram="{{ $attr->id }}"
                                                            class="badge p-1 editAttr">
                                                            <?xml version="1.0" encoding="UTF-8"?>
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline"
                                                                viewBox="0 0 24 24" width="16" height="16">
                                                                <path
                                                                    d="M18.656.93,6.464,13.122A4.966,4.966,0,0,0,5,16.657V18a1,1,0,0,0,1,1H7.343a4.966,4.966,0,0,0,3.535-1.464L23.07,5.344a3.125,3.125,0,0,0,0-4.414A3.194,3.194,0,0,0,18.656.93Zm3,3L9.464,16.122A3.02,3.02,0,0,1,7.343,17H7v-.343a3.02,3.02,0,0,1,.878-2.121L20.07,2.344a1.148,1.148,0,0,1,1.586,0A1.123,1.123,0,0,1,21.656,3.93Z" />
                                                                <path
                                                                    d="M23,8.979a1,1,0,0,0-1,1V15H18a3,3,0,0,0-3,3v4H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2h9.042a1,1,0,0,0,0-2H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H16.343a4.968,4.968,0,0,0,3.536-1.464l2.656-2.658A4.968,4.968,0,0,0,24,16.343V9.979A1,1,0,0,0,23,8.979ZM18.465,21.122a2.975,2.975,0,0,1-1.465.8V18a1,1,0,0,1,1-1h3.925a3.016,3.016,0,0,1-.8,1.464Z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            <tr>
                                                <td>

                                                </td>
                                                <td></td>
                                                <td>
                                                    <p class="font-weight-bold">Total Qnt</p>
                                                </td>
                                                <td>
                                                    <p class="font-weight-bold">{{ $request->stock() }}</p>
                                                </td>
                                                <td>
                                                </td>

                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @livewire('backend.product-image', ['product_id' => $request->id])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        // Additional Info editor without image and video upload
        ClassicEditor
            .create(document.querySelector('#additional_info'), {
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link',
                        'blockQuote', 'insertTable', 'numberedList', 'bulletedList',
                        'outdent', 'indent', 'alignment', '|', 'removeFormat'
                    ]
                }
            })
            .catch(error => {
                console.error('There was an error initializing the additional_info editor:', error);
            });


        $('.editAttr').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-bs-val');
            var form = $('#editForm');

            var peram = $(this).attr('data-bs-peram');

            var url = "{{ route('attributes.update', ':peram') }}";
            url = url.replace(':peram', peram);
            console.log(url);

            // Send AJAX request
            $.ajax({
                url: id,
                type: 'GET',
                success: function(response) {
                    // Example: Assigning values to form inputs by name
                    form.find('input[name="sku"]').val(response.sku);
                    //form.find('input[name="price"]').val(typeof response.price === 'string' ? response
                    //    .price.replace(/\.00$/, '') : response.price);
                    //form.find('input[name="stock_price"]').val(typeof response.stock_price ===
                    //    'string' ? response.stock_price.replace(/\.00$/, '') : response.stock_price);
                    //form.find('input[name="s_price"]').val(typeof response.s_price === 'string' ?
                    //    response.s_price.replace(/\.00$/, '') : response.s_price);
                    form.find('input[name="avlqnt"]').val(response.qnt);

                    form.find('select[name="color_id"]').val(response.color_id);
                    form.find('select[name="size_id"]').val(response.size_id);
                    form.find('select[name="sp_type"]').val(response.sp_type);
                    // Handle success response

                    $('#editFormFirst').attr('action', url);
                    // console.log();

                    form.modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error response
                }
            });

        });
    </script>
@endsection
