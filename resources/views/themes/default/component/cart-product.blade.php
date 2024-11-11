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
        <p class="cart-drawer-item__option text-secondary">Qnt: {{ $product['quantity'] }}</p>

    </div>

    <button class="btn-close-xs position-absolute top-0 end-0 cart-item-remove"
        data-cartremove="{{ $product['id'] }}"></button>

    <div class="spinner-border add-to-cart-remove-loader" data-cartremove="{{ $product['id'] }} role="status"
        style="display:none;">
        <span class="sr-only"></span>
    </div>
</div>
