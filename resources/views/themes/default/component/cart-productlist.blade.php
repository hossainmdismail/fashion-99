@foreach ($products as $key => $product)
    @include('themes.default.component.cart-product', ['product' => $product])
    <hr class="cart-drawer-divider">
@endforeach
