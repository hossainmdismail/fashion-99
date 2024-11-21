@extends('themes.default.layout.app')
@section('style')
    <style>
        .swatch_active {
            border: 2px solid #000;
            /* Example styling for active state */
        }
    </style>
@endsection
@section('content')
    <div class="py-0 py-md-5"></div>

    <main>
        <section class="full-width_padding">
            <div class="full-width_border border-2" style="border-color: #f5e6e0;">
                <div class="shop-banner position-relative ">
                    <div class="background-img" style="background-color: #f5e6e0;">
                        <img loading="lazy" src="{{ asset('themes/default/shop_banner_2.png') }}" width="1759" height="420"
                            alt="Pattern" class="slideshow-bg__img object-fit-cover">
                    </div>

                    <div class="shop-banner__content container position-absolute start-50 top-50 translate-middle">
                        <h2 class="h1 text-uppercase text-center fw-bold ">Shop</h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="mb-4 pb-lg-3"></div>

        <section class="shop-main container d-flex">
            <div class="shop-list flex-grow-1 mb-3 mb-md-4">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{ route('index') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a class="menu-link menu-link_us-s text-uppercase fw-medium">Shop</a>
                    </div><!-- /.breadcrumb -->

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                            aria-label="Sort Items" name="sort" id="sort-products">
                            <option value="0" selected>Sorting</option>
                            <option value="3">A-Z</option>
                            <option value="4">Z-A</option>
                            <option value="5">low to high</option>
                            <option value="6">high to low</option>
                        </select>

                        {{-- <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div> --}}

                        {{-- <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">View</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                                data-cols="4">4</button>
                        </div><!-- /.col-size --> --}}

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10"
                                    viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div><!-- /.col-size d-flex align-items-center ms-auto ms-md-3 -->

                    </div><!-- /.shop-acs -->
                </div>
                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card-wrapper">
                            @include('themes.default.component.product', ['product' => $product])
                        </div>
                    @endforeach
                </div>
                <nav class="shop-pages d-flex justify-content-between mt-3" aria-label="Page navigation">
                    {{ $products->links('pagination::bootstrap-4') }}
                </nav>
            </div>

            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="accordion" id="brand-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                                aria-controls="accordion-filter-brand">
                                Search
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="search-field multi-select accordion-body px-0 pb-0">
                                <select class="d-none" multiple name="total-numbers-list">
                                    <option value="1">Adidas</option>
                                    <option value="2">Balmain</option>
                                    <option value="3">Balenciaga</option>
                                    <option value="4">Burberry</option>
                                    <option value="5">Kenzo</option>
                                    <option value="5">Givenchy</option>
                                    <option value="5">Zara</option>
                                </select>
                                <div class="search-field__input-wrapper mb-3">
                                    <input type="text" name="search_text" id="search-products"
                                        class="search-field__input form-control form-control-sm border-light border-2"
                                        placeholder="SEARCH">
                                </div>
                            </div>


                        </div>
                    </div><!-- /.accordion-item -->

                    <div class="accordion" id="categories-list">
                        <div class="accordion-item mb-4 pb-3">
                            <h5 class="accordion-header" id="accordion-heading-11">
                                <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                                    aria-controls="accordion-filter-1">
                                    Product Categories
                                    <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                            <path
                                                d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                        </g>
                                    </svg>
                                </button>
                            </h5>
                            <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                                aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                                <div class="accordion-body px-0 pb-0 pt-3">
                                    <ul class="list list-inline mb-0">
                                        @foreach ($categories as $category)
                                            <li class="list-item">
                                                <a href="{{ route('front.category', $category->slugs) }}"
                                                    class="menu-link py-1 js-category-filter"
                                                    data-category="{{ $category->id }}">{{ $category->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div><!-- /.accordion-item -->
                    </div><!-- /.accordion-item -->
                </div>
            </div>
        </section><!-- /.shop-main container -->
    </main>
@endsection

@section('script')
    <script>
        var fetchProductsUrl = "{{ route('shop') }}";

        // Global AJAX setup to include CSRF token in all requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let searchTimeout;

        function fetchProducts() {
            let sortValue = $('#sort-products').val();
            let searchText = $('#search-products').val();

            $.ajax({
                url: fetchProductsUrl,
                method: 'GET',
                data: {
                    sort: sortValue,
                    search: searchText
                },
                success: function(response) {
                    console.log('succ');

                    $('#loading').addClass('d-none');

                    if (response.html) {
                        $('#products-grid').html(response.html);
                        $('#message').html('<p style="color: green;">Products loaded successfully!</p>');
                    } else {
                        $('#message').html('<p style="color: red;">No products found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loading').addClass('d-none');
                    console.log('Error details:', xhr.responseText);
                    $('#message').html('<p style="color: red;">An error occurred: ' + xhr.responseText +
                        '</p>');
                }
            });
        }

        $(document).ready(function() {
            $('#sort-products').on('change', fetchProducts);
            $('#search-products').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(fetchProducts, 500); // 500ms delay
            });

        });
    </script>
@endsection
