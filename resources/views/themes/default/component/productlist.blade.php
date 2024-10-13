@foreach ($products as $product)
    <div class="product-card-wrapper">
        @include('themes.default.component.product', ['product' => $product])
    </div>
@endforeach
