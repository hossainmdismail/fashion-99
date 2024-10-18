<div class="product-card mb-3 mb-md-4">
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
            <a href="{{ route('product.view', $product->slugs) }}"
                class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart"
                title="Add To Cart">Order Now</a>
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
