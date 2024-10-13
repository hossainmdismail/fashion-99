<div class="product-card">
    <div class="pc__img-wrapper">
        <a href="{{ route('product.view', $product->slugs) }}">
            @if ($product->images)
                @foreach ($product->images as $key => $image)
                    <img loading="lazy" src="{{ asset('files/product/' . $image->image) }}" width="330" height="400"
                        alt="{{ $product->name }}" class="pc__img">
                @endforeach
            @endif
            @if ($product->attributes && $product->attributes->first())
                @foreach ($product->attributes->take(2) as $key => $image)
                    <img loading="lazy" src="{{ asset('files/product/' . $image->image) }}" width="330" height="400"
                        alt="{{ $product->name }}" class="pc__img pc__img-second">
                @endforeach
            @endif
        </a>
        <div class="anim_appear-bottom position-absolute bottom-0 start-0 w-100 d-none d-sm-flex align-items-center">
            <button
                class="btn btn-primary flex-grow-1 fs-base ps-3 ps-xxl-4 pe-0 border-0 text-uppercase fw-medium js-add-cart js-open-aside"
                data-aside="cartDrawer" style="font-size: 12px !important" title="Add To Cart">Add To Cart</button>
            <button
                class="btn btn-primary flex-grow-1 fs-base ps-0 pe-3 pe-xxl-4 border-0 text-uppercase fw-medium js-quick-view"
                data-bs-toggle="modal" style="font-size: 12px !important" data-bs-target="#quickView"
                title="Quick view">Order
                Now</button>
        </div>

    </div>

    <div class="pc__info position-relative">
        <p class="pc__category third-color">JEAN</p>
        <h6 class="pc__title"><a href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a></h6>
        <div class="product-card__price d-flex">
            <span class="money price">{{ __('messages.currency') }}{{ number_format($product->getFinalPrice()) }}</span>
            <span class="money price-old">{{ __('messages.currency') }}{{ number_format($product->price, 0) }}</span>
        </div>
    </div>
</div>

{{-- <div class="product-cart-wrap mb-30">
    <div class="product-img-action-wrap">
        <div class="product-badges product-badges-position product-badges-mrg gap-1">
            @if ($product->stock() == 0)
                <span class="hot">
                    Stock out
                </span>
            @else
                @if ($product->featured == 1)
                    <span class="sale">
                        Featured
                    </span>
                @elseif ($product->popular == 1)
                    <span class="new">
                        Popular
                    </span>
                @endif
                @if ($product->shipping_fee == 1)
                    <span class="best">
                        Shipping free
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="product-content-wrap">
        <div class="product-category">
            <a href="#">{{ $product->category ? $product->category->category_name : 'Random' }}</a>
        </div>
        <h2><a href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a>
        </h2>


        <div class="d-flex gap-2 align-items-center">
            <div class="product-rate d-inline-block">
                <div class="product-rating" style="width:{{ $product->getRating() }}%">
                </div>
            </div>
            <span>({{ count($product->comments) }})</span>
        </div>
        <div class="product-price">
            <span>৳ {{ number_format($product->getFinalPrice()) }}</span>
            <span class="old-price">৳ {{ number_format($product->price, 0) }}</span>
        </div>

        <div class="product-action-1 show">
            <a href="{{ route('product.view', $product->slugs) }}" aria-label="Order now" class="action-btn hover-up"
                href="shop-cart.html"><i class="fi fi-rr-shopping-cart"></i></a>
        </div>
    </div>
</div> --}}
