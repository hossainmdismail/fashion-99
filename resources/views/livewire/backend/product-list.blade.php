<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Product List </h2>
            {{-- <p>Here Your All Catego.</p> --}}
        </div>
        <div>
            <a class="btn btn-sm btn-primary" href="{{ route('product.create') }}">Add Product</a>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="text" placeholder="Search..." class="form-control" wire:model.live="search">
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select wire:model.live="category" class="form-select">
                        <option value="">Category</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select wire:model.live="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="deactive">Draft</option>
                    </select>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            {{-- <th scope="col">Category Name</th> --}}
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Status</th>
                            <th scope="col">Market Status</th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $key => $request)
                            <tr>
                                <td>
                                    {{ $request->name }}
                                </td>
                                {{-- <td><b>{{ $request->category ? $request->category->category_name : 'Unknow' }}</b></td> --}}
                                <td>
                                    @if ($request->images)
                                        @foreach ($request->images as $key => $image)
                                            <img class="rounded" style="width: 30px; height: 30px;"
                                                src="{{ asset('files/product/' . $image->image) }}" alt="">
                                        @endforeach
                                    @endif
                                    @if ($request->attributes != null)
                                        @foreach ($request->attributes as $img)
                                            <img class="rounded" style="width: 30px; height: 30px;"
                                                src="{{ asset('files/product/' . $img->image) }}" alt="">
                                        @endforeach
                                    @endif

                                </td>
                                <td style="font-size: 16px">
                                    {{ number_format($request->getFinalPrice()) }}
                                    <del style="font-size: 12px; color:brown">{{ number_format($request->price) }}</del>
                                    <span style="font-size: 12px">( {{ $request->s_price }}
                                        {{ $request->sp_type == 'Fixed' ? '' : '%' }} off)</span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $request->stock() }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $request->status == 'active' ? 'success' : 'warning' }}">{{ $request->status }}</span>
                                </td>

                                <td>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Feature</label>
                                        <input class="form-check-input" wire:click="featured({{ $request->id }})"
                                            type="checkbox" id="flexSwitchCheckDefault"
                                            {{ $request->featured == 1 ? 'checked' : '' }}>
                                    </div><br>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Popular</label>
                                        <input class="form-check-input" wire:click="popular({{ $request->id }})"
                                            type="checkbox" id="flexSwitchCheckDefault"
                                            {{ $request->popular == 1 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $request->id) }}" class="badge p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path fill="black"
                                                d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20c4.182 0 7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4C7.818 4 4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12"
                                                opacity=".5" />
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.5 0a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->
    <div class="pagination-area mt-15 mb-50">
        {{ $requests->links('livewire::bootstrap') }}
    </div>
</section>
