@foreach ($products as $key => $product)
    <tr>
        @include('themes.default.component.checkout-item', ['product' => $product])
    </tr>
@endforeach
