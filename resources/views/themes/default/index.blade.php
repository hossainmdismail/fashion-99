@extends('themes.default.layout.app')
@php
    $product = 0;
@endphp
@section('content')
    <section class="swiper-container js-swiper-slider slideshow type2 full-width"
        data-settings='{"autoplay": {"delay": 5000},"slidesPerView": 1,"effect": "fade","loop": true,"pagination": {"el": ".slideshow-pagination", "type": "bullets", "clickable": true}}'>
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-bg">
                            <img loading="lazy" src="{{ asset('files/banner/' . $banner->banner_image) }}" width="1903"
                                height="896" alt="Pattern" class="slideshow-bg__img object-fit-cover"
                                style="object-position: 80% center;">
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6
                                class="text_dash text-shadow-white text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                {{ $banner->category ? $banner->category->category_name : 'unkown' }}</h6>
                            <h2
                                class="text-uppercase text-shadow-white h1 fw-bold mb-0 animate animate_fade animate_btt animate_delay-4">
                                {{ $banner->banner_title }}</h2>
                            <p
                                class="fs-6 mb-4 pb-2 text-uppercase text-shadow-white animate animate_fade animate_btt animate_delay-5">
                                {{ $banner->banner_description }}</p>
                            <a href="{{ route('front.category', $banner->category ? $banner->category->slugs : '') }}"
                                class="btn border-0 fs-base text-uppercase fw-medium animate animate_fade animate_btt animate_delay-7">
                                <span class="text_dash_half">Discover Now</span>
                            </a>
                        </div>
                    </div>
                </div><!-- /.slideshow-item -->
            @endforeach
        </div><!-- /.slideshow-wrapper js-swiper-slider -->
        <div class="slideshow-pagination position-left-center type2"></div>
        <a href="#section-grid-banner"
            class="slideshow-scroll d-none d-xxl-block position-absolute end-0 bottom-3 text_dash text-uppercase fw-medium">Scroll</a>
    </section>

    <section class="category-carousel container py-4">
        <div class="position-relative">
            <div class="swiper-container js-swiper-slider"
                data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "effect": "none",
              "loop": true,
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
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 5,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <a href="{{ route('front.category', $category->slugs) }}">
                                <img loading="lazy" class="w-100 h-auto mb-3"
                                    src="{{ asset('files/category/' . $category->category_image) }}" width="258"
                                    height="278" alt="">
                            </a>
                            <div class="text-center">
                                <a href="{{ route('front.category', $category->slugs) }}"
                                    class="menu-link menu-link_us-s text-uppercase">{{ $category->category_name }}</a>
                                <p class="mb-0 text-secondary">{{ $category->getTotalProduct() }} Products</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="products-carousel container py-3 py-md-5">
        <h2 class="section-title text-uppercase fw-bold text-center mb-1 mb-md-3 pb-xl-2 mb-xl-4">Best Selling</h2>
        <div class="row">
            @foreach ($populars as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('themes.default.component.product', ['products' => $product])
                </div>
            @endforeach
        </div>
    </section><!-- /.products-grid -->

    <section class="products-carousel container py-3 py-md-5">
        <h2 class="section-title text-uppercase fw-bold text-center mb-1 mb-md-3 pb-xl-2 mb-xl-4">Latest</h2>
        <div class="row">
            @foreach ($latests as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('themes.default.component.product', ['products' => $product])
                </div>
            @endforeach
        </div>
    </section><!-- /.products-grid -->

    <section class="products-carousel container py-3 py-md-5">
        <h2 class="section-title text-uppercase fw-bold text-center mb-1 mb-md-3 pb-xl-2 mb-xl-4">Recommended</h2>
        <div class="row">
            @foreach ($featureds as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('themes.default.component.product', ['products' => $product])
                </div>
            @endforeach
        </div>
    </section><!-- /.products-grid -->
    <section class="brands-carousel container py-5">
        <h2 class="d-none">Brands</h2>
        <div class="position-relative">
            <div class="swiper-container js-swiper-slider"
                data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 7,
              "slidesPerGroup": 7,
              "effect": "none",
              "loop": true,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 7,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand1.png" width="120"
                            height="20" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand2.png" width="87"
                            height="20" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand3.png" width="132"
                            height="22" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand4.png" width="72"
                            height="21" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand5.png" width="123"
                            height="31" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand6.png" width="137"
                            height="22" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img loading="lazy" src="{{ asset('themes/default/brands') }}/brand7.png" width="94"
                            height="21" alt="">
                    </div>
                </div><!-- /.swiper-wrapper -->
            </div><!-- /.swiper-container js-swiper-slider -->
        </div><!-- /.position-relative -->

    </section><!-- /.products-carousel container -->
@endsection
