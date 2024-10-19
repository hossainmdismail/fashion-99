<div class="cart-drawer-item d-flex position-relative">
    <div class="position-relative">
        <a>
            <img loading="lazy" class="cart-drawer-item__img" src="{{ asset('files/product/' . $product['image']) }}"
                alt="">
        </a>
    </div>
    <div class="cart-drawer-item__info flex-grow-1">
        <h6 class="cart-drawer-item__title fw-normal"><a>{{ $product['name'] }}</a></h6>
        <p class="cart-drawer-item__option text-secondary">Color: {{ $product['color'] }}</p>
        <p class="cart-drawer-item__option text-secondary">Size: {{ $product['size'] }}</p>
        <div class="d-flex align-items-center justify-content-between mt-1">
            <div class="qty-control position-relative">
                <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1"
                    class="qty-control__number border-0 text-center">
                <div class="qty-control__reduce text-start">Q</div>
                {{-- <div class="qty-control__increase text-end">+</div> --}}
            </div>
            <span class="cart-drawer-item__price money price">{{ $product['totalPrice'] }}
                {{ __('messages.currency') }}</span>
        </div>
    </div>

    <button class="btn-close-xs position-absolute top-0 end-0 cart-item-remove"
        data-cartremove="{{ $product['id'] }}"></button>

    <div class="spinner-border add-to-cart-remove-loader" data-cartremove="{{ $product['id'] }} role="status"
        style="display:none;">
        <span class="sr-only"></span>
    </div>
</div>
