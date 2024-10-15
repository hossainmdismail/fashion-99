<div class="cart-drawer-item d-flex position-relative">
    <div class="position-relative">
        <a href="product1_simple.html">
            {{-- <img loading="lazy" class="cart-drawer-item__img" src="../images/cart-item-1.jpg" alt=""> --}}
        </a>
    </div>
    <div class="cart-drawer-item__info flex-grow-1">
        <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">{{ $product['name'] }}</a></h6>
        <p class="cart-drawer-item__option text-secondary">Color: {{ $product['color'] }}</p>
        <p class="cart-drawer-item__option text-secondary">Size: {{ $product['size'] }}</p>
        <div class="d-flex align-items-center justify-content-between mt-1">
            <div class="qty-control position-relative">
                <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1"
                    class="qty-control__number border-0 text-center">
                <div class="qty-control__reduce text-start">-</div>
                <div class="qty-control__increase text-end">+</div>
            </div><!-- .qty-control -->
            <span class="cart-drawer-item__price money price">{{ $product['totalPrice'] }} Tk</span>
        </div>
    </div>

    <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
</div><!-- /.cart-drawer-item d-flex -->
