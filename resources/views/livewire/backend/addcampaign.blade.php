<form wire:submit.prevent="save">
    <div class="table-responsive">
        <div class="mb-3">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Search product">
        </div>
        <table class="table table-hover mb-3">
            <thead>
                <tr>
                    <th scope="col">Mark</th>
                    <th scope="col">Product Name</th>
                    {{-- <th scope="col">Category Name</th> --}}
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requests as $key => $request)
                    <tr>
                        <td>
                            <input class="form-check-input" type="checkbox" value="{{ $request->id }}" wire:model="check">
                        </td>
                        <td><b>{{ $request->name }}</b></td>
                        {{-- <td><b>{{ $request->category ? $request->category->category_name : 'Unknow' }}</b></td> --}}
                        <td>
                            @if ($request->images != null)
                                @foreach ($request->images as $img)
                                    <img class="rounded" style="width: 30px; height: 30px;"
                                        src="{{ asset('files/product/' . $img->image) }}" alt="">
                                @endforeach
                            @endif
                        </td>
                        <td><b> <span>৳</span> {{ $request->price }} </b></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">+ Add</button>
        </div>
    </div> <!-- table-responsive //end -->
</form>
