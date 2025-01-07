@extends('themes.default.layout.app')
@section('style')
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
@endsection
@section('content')
    @php
        // Get the rating in percentage (e.g., 70, 80)
        $ratingPercentage = $product->getRating(); // Example: 70%

        // Convert percentage to a 5-star rating
        $starRating = ($ratingPercentage / 100) * 5; // e.g., 3.5 stars for 70%

        // Calculate full stars, half star, and empty stars
        $fullStars = floor($starRating); // Number of full stars (e.g., 3 full stars for 70%)
        $halfStar = $starRating - $fullStars >= 0.5 ? 1 : 0; // 1 if half star, otherwise 0
        $emptyStars = 5 - ($fullStars + $halfStar); // Remaining empty stars
    @endphp
    <div class="py-2 py-md-5">
    </div>

    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($product->uniqueAttributes() as $key => $image)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto"
                                                src="{{ asset('files/product/' . $image->image) }}" width="674"
                                                height="674" alt="">
                                            <a data-fancybox="gallery" href="{{ asset('files/product/' . $image->image) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                    @if ($product->images)
                                        @foreach ($product->images as $key => $image)
                                            <div class="swiper-slide product-single__image-item">
                                                <img loading="lazy" class="h-auto"
                                                    src="{{ asset('files/product/' . $image->image) }}" width="674"
                                                    height="674" alt="">
                                                <a data-fancybox="gallery"
                                                    href="{{ asset('files/product/' . $image->image) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_zoom" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($product->uniqueAttributes() as $key => $image)
                                        <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                class="h-auto" src="{{ asset('files/product/' . $image->image) }}"
                                                width="104" height="104" alt="Product Image"></div>
                                    @endforeach
                                    @if ($product->images)
                                        @foreach ($product->images as $key => $image)
                                            <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                    class="h-auto" src="{{ asset('files/product/' . $image->image) }}"
                                                    width="104" height="104" alt="Product Image"></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Opps!</strong> Your form is not submitted successfully
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('succ'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thank you! </strong>{{ session('succ') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="{{ route('index') }}"
                                class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="{{ route('shop') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">Shop</a>
                        </div><!-- /.breadcrumb -->
                    </div>
                    <h1 class="product-single__name">{{ $product->name }}</h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <!-- Full stars -->
                            @for ($i = 0; $i < $fullStars; $i++)
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" /> <!-- Empty star -->
                                </svg>
                            @endfor

                            <!-- Half star -->
                            @if ($halfStar)
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star_half" /> <!-- Empty star -->
                                </svg>
                            @endif

                            <!-- Empty stars -->
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <svg class="star-rating__star-icon" width="10" fill="#ccc" viewBox="0 0 12 12"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">{{ count($product->comments) }}
                            reviews</span>
                    </div>
                    <div class="product-single__price">
                        <span class="current-price">{{ $product->getFinalPrice() }} Tk</span>
                        @if ($product->s_price != 0)
                            <span class="money price-old">{{ $product->price }}
                            </span>
                            @if ($product->sp_type != 'Fixed')
                                <span class="save-price  font-md color3 ml-15">
                                    {{ $product->sp_type == 'Fixed' ? '' : $product->s_price . '% Off' }}</span>
                            @endif
                        @endif
                    </div>
                    <div class="product-single__short-desc">
                        <p class="font-bd">{!! $product->short_description !!}</p>
                        {{-- <ul>
                            @if ($product->services)
                                @foreach ($product->services as $service)
                                    <li class="mb-10"><i class="fa fa-bullseye mr-5"></i>
                                        {{ $service->service ? $service->service->message : null }}</li>
                                @endforeach
                            @endif
                        </ul> --}}
                    </div>
                    <div class="product-single__short-desc">
                        <img src="{{ asset('review/table.png') }}" loading="lazy" alt="">
                    </div>
                    <form name="addtocart-form">
                        @csrf
                        <div class="product-single__swatches">
                            <!-- Colors -->
                            <div class="product-swatch color-swatches d-none">
                                <label>Color</label>
                                <div class="swatch-list">
                                    @foreach ($availableColors as $index => $color)
                                        <input type="radio" name="color" id="color-{{ $color['id'] }}"
                                            value="{{ $color['id'] }}" data-color-id="{{ $color['id'] }}"
                                            {{ $index == 0 ? 'checked' : '' }}> <!-- Auto-select the first color -->
                                        <label
                                            class="swatch swatch-color js-swatch {{ $index == 0 ? 'color-active' : '' }}"
                                            for="color-{{ $color['id'] }}"
                                            style="background-color: {{ $color['code'] }};">
                                            <img src="{{ asset('files/product/' . $color['image']) }}"
                                                style="border-radius: .6rem;" alt="{{ $color['name'] }}">
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sizes (this will be updated based on the selected color) -->
                            <div class="product-swatch text-swatches">
                                <label>Sizes</label>
                                <div class="swatch-list" id="sizeOptions">
                                    <!-- Sizes for the selected color will be injected here -->
                                </div>
                            </div>

                            <div class="product-swatch text-swatches product-single__addtocart">
                                <label>Quantity</label>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="1" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__reduce" onclick="updateQuantity(-1)">-</div>
                                    <div class="qty-control__increase" onclick="updateQuantity(1)">+</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="product-single__addtocart">


                            <button type="submit" name="btn" value="1" class="btn btn-primary btn-addtocart"
                                data-aside="cartDrawer">
                                Buy Now
                                <div class="spinner-border add-to-cart-loader" role="status" style="display:none;">
                                    <span class="sr-only"></span>
                                </div>
                            </button>
                            <button type="submit" name="btn" value="2" class="btn btn-primary btn-addtocart"
                                data-aside="cartDrawer">
                                Add to Cart
                                <div class="spinner-border add-to-cart-loader" role="status" style="display:none;">
                                    <span class="sr-only"></span>
                                </div>
                            </button>
                        </div>

                        <div class="product-single__addtocart">

                            <a href="https://m.me/euphoriaknit" target="_blank"
                                class="btn btn-primary messanger btn-custom w-100 text-uppercase font-bd"
                                type="submit">মেসেঞ্জারে
                                অর্ডার করুন</a>
                            <a href="https://wa.me/+8801811994026" target="_blank"
                                class="btn btn-primary whatsapp btn-custom w-100 text-uppercase font-bd"
                                type="submit">হোয়াটসঅ্যাপে
                                অর্ডার করুন</a>
                        </div>
                    </form>
                    <div class="product-single__addtolinks">
                        <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16"
                                height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg><span>Add to Wishlist</span></a>
                        <share-button class="share-button">
                            <button
                                class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_sharing" />
                                </svg>
                                <span>Share</span>
                            </button>
                            <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                <div id="Article-share-template__main"
                                    class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                    <div class="field grow mr-4">
                                        <label class="field__label sr-only" for="url">Link</label>
                                        <input type="text" class="field__input w-full" id="url"
                                            value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                            placeholder="Link" onclick="this.select();" readonly="">
                                    </div>
                                    <button class="share-button__copy no-js-hidden">
                                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13"
                                            fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            focusable="false" viewBox="0 0 11 13">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <span class="sr-only">Copy link</span>
                                    </button>
                                </div>
                            </details>
                        </share-button>
                        <script src="{{ asset('themes/default') }}/js/details-disclosure.js" defer="defer"></script>
                        <script src="{{ asset('themes/default') }}/js/share.js" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>{{ $product->sku }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Category</label>
                            <span>{{ $product->category ? $product->category->category_name : 'Unknown' }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span>{{ $product->seo_tags }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            ({{ count($product->comments) }})</a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            {!! $product->additional_info !!}
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            @forelse ($product->comments->take(5) as $comment)
                                <div class="product-single__reviews-item">
                                    <div class="customer-avatar">
                                        <img loading="lazy" src="{{ asset('avatr.webp') }}" alt="Rating avatar">
                                    </div>
                                    <div class="customer-review">
                                        <div class="customer-name">
                                            <h6>{{ $comment->name }}</h6>
                                        </div>
                                        <div class="reviews-group d-flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $comment->rating)
                                                    <!-- Filled Star -->
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" /> <!-- Empty star icon -->
                                                    </svg>
                                                @else
                                                    <svg class="star-rating__star-icon" width="10" fill="#ccc"
                                                        viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="review-date">{{ $product->created_at->format('M Y') }}</div>
                                        <div class="review-text">
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form" action="{{ route('comment.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <h5>Be the first to review “{{ $product->name }}”</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>

                                <!-- Rating -->
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                    </span>
                                    <input type="hidden" id="form-input-rating" value="" name="rating">
                                </div>
                                <!-- Review -->
                                <div class="mb-4">
                                    <textarea id="form-input-review" class="form-control form-control_gray @error('comment') is-invalid @enderror"
                                        placeholder="Your Review" cols="16" rows="8" name="comment" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Name -->
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Name *</label>
                                    <input id="form-input-name"
                                        class="form-control form-control-md form-control_gray @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email address</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray"
                                        name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="form-label-fixed mb-4">
                                    <label for="number-form" class="form-label">Number *</label>
                                    <input id="number-form"
                                        class="form-control form-control-md form-control_gray @error('number') is-invalid @enderror"
                                        name="number" value="{{ old('number') }}" required>
                                    @error('number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Checkbox -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input form-check-input_fill" type="checkbox" name="comment"
                                        id="remember_checkbox">
                                    <label class="form-check-label" for="remember_checkbox">
                                        Save my name, email, and website in this browser for the next time I comment.
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
                "autoplay": false,
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "effect": "none",
                "loop": true,
                "pagination": {
                  "el": "#related_products .products-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "navigation": {
                  "nextEl": "#related_products .products-carousel__next",
                  "prevEl": "#related_products .products-carousel__prev"
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 2,
                    "slidesPerGroup": 2,
                    "spaceBetween": 14
                  },
                  "768": {
                    "slidesPerView": 3,
                    "slidesPerGroup": 3,
                    "spaceBetween": 24
                  },
                  "992": {
                    "slidesPerView": 4,
                    "slidesPerGroup": 4,
                    "spaceBetween": 30
                  }
                }
              }'>
                    <div class="swiper-wrapper">
                        @foreach ($related as $product)
                            <div class="swiper-slide product-card">
                                @include('themes.default.component.product', ['products' => $product])
                            </div>
                        @endforeach

                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>
@endsection
@section('script')
    <script>
        var availableColors = @json($availableColors);

        function updateSizes(colorId) {
            var selectedColor = availableColors.find(color => color.id == colorId);
            var sizeOptions = document.getElementById('sizeOptions');
            sizeOptions.innerHTML = '';

            if (selectedColor && selectedColor.sizes.length > 0) {
                selectedColor.sizes.forEach(function(size, index) {
                    var disabled = size.stock > 0 ? '' : 'disabled';
                    var checked = index == 0 ? 'checked' : ''; // Select the first size by default
                    var outOfStockClass = size.stock > 0 ? '' :
                        'out-of-stock'; // Add a class for out-of-stock items

                    sizeOptions.innerHTML += `
                        <input type="radio" name="inventory_id" id="size-${size.size_id}" value="${size.inventory_id}" ${checked} ${disabled}>
                        <label class="swatch js-swatch ${outOfStockClass}" for="size-${size.size_id}">
                            ${size.size_name}
                        </label>
                        `;
                });
            } else {
                sizeOptions.innerHTML = '<p>No sizes available for this color.</p>';
            }
        }

        function activateColor(colorId) {
            document.querySelectorAll('.swatch-color').forEach(function(label) {
                label.classList.remove('color-active');
            });

            var selectedLabel = document.querySelector(`label[for="color-${colorId}"]`);
            if (selectedLabel) {
                selectedLabel.classList.add('color-active');
            }
        }

        document.querySelectorAll('input[name="color"]').forEach(function(colorInput) {
            colorInput.addEventListener('change', function() {
                activateColor(this.value); // Apply 'color-active' to the selected color
                updateSizes(this.value); // Update sizes based on selected color
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var firstColorId = document.querySelector('input[name="color"]:checked').value;
            updateSizes(firstColorId);
        });

        function updateQuantity(amount) {
            var currentQuantity = parseInt(document.querySelector('input[name="quantity"]').value);
            var newQuantity = currentQuantity + amount;
            if (newQuantity > 0) {
                document.querySelector('input[name="quantity"]').value = newQuantity;
            }
        }
        $('form[name="addtocart-form"]').on('submit', function(e) {
            e.preventDefault();

            $('.add-to-cart-loader').show();

            // Capture the clicked button's value
            const btnValue = $('button[type="submit"][name="btn"]:focus').val();

            let formData = {
                _token: $('input[name="_token"]').val(),
                color: $('input[name="color"]:checked').val(),
                inventory_id: $('input[name="inventory_id"]:checked').val(),
                quantity: $('input[name="quantity"]').val(),
                btn: btnValue, // Include the button value in the formData
            };

            $.ajax({
                url: '{{ route('addtocart') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Load cart data
                    loadCartData();

                    if (btnValue === '1') {
                        // Redirect to checkout for "Buy Now"
                        window.location.href = '{{ route('checkout') }}';
                    } else if (btnValue === '2') {
                        // Handle "Add to Cart"
                        $('.alert-message').text('Product added to cart successfully!');
                        $('.js-open-aside[data-aside="cartDrawer"]').trigger('click');

                        // Trigger Meta Pixel Add to Cart event
                        fbq('track', 'AddToCart', {
                            content_ids: [formData.inventory_id], // Pass inventory ID
                            content_type: 'product',
                            value: response.price, // Ensure the backend returns the price
                            currency: 'BDT',
                            quantity: formData.quantity, // Pass the quantity
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding product to cart:', error);
                    alert('There was an error adding the product to the cart.');
                },
                complete: function() {
                    $('.add-to-cart-loader').hide();
                },
            });
        });
    </script>
@endsection
