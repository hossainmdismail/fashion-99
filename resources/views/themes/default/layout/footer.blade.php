<footer class="footer footer_type_2 dark">
    {{-- <div class="footer-top container">
        <div class="block-newsletter dark">
            <h3 class="block__title">Get 10% Off</h3>
            <p>Be the first to get the latest news about trends, promotions, and much more!</p>
            <form action="https://uomo-html.flexkitux.com/Demo2/index.html" class="block-newsletter__form">
                <input class="form-control" type="email" name="email" placeholder="Your email address">
                <button class="btn btn-secondary fw-medium" type="submit">JOIN</button>
            </form>
        </div>
    </div> --}}

    <div class="footer-middle container">
        <div class="row row-cols-lg-5 row-cols-2">
            <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
                <div class="logo">
                    @if ($configData)
                        <a href="index.html"><img src="{{ asset('files/config/' . $configData->logo) }}" alt="Uomo"
                                class="logo__image" loading="lazy"></a>
                    @endif
                </div><!-- /.logo -->
                <p class="footer-address">
                    @if ($configData)
                        {{ $configData->address }}
                    @endif
                </p>

                <p class="m-0">
                    <strong class="fw-medium">
                        @if ($configData)
                            {{ $configData->email }}
                        @endif
                    </strong>
                </p>
                <p>
                    <strong class="fw-medium">
                        @if ($configData)
                            {{ $configData->number }}
                        @endif
                    </strong>
                </p>

                <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
                    <li>
                        <a href="https://www.facebook.com/@euphoriaknit" target="_blank"
                            class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_facebook" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Company</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('index') }}" class="menu-link menu-link_us-s">About
                            Us</a></li>
                    <li class="sub-menu__item"><a href="{{ route('privacy') }}"
                            class="menu-link menu-link_us-s">Privacy</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('shop') }}" class="menu-link menu-link_us-s">Shop</a>
                    </li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Help</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('index') }}" class="menu-link menu-link_us-s">Home</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('contact') }}"
                            class="menu-link menu-link_us-s">Customer Service</a></li>
                    <li class="sub-menu__item"><a href="{{ route('privacy') }}" class="menu-link menu-link_us-s">Terms &
                            Conditions</a></li>
                </ul>
            </div>

            <div class="footer-column mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Opening Time</h6>
                <ul class="list-unstyled">
                    <li><span class="menu-link">Mon - Fri: 8AM - 9PM</span></li>
                    <li><span class="menu-link">Sat: 9AM - 8PM</span></li>
                    <li><span class="menu-link">Sun: Closed</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-md-flex align-items-center">
            <span class="footer-copyright me-auto">©2024 {{ $configData->name }}</span>
            <div class="footer-settings d-md-flex align-items-center">
                <select id="footerSettingsLanguage" class="form-select form-select-sm bg-transparent border-0"
                    aria-label="Default select example" name="store-language">
                    <option class="footer-select__option" selected>Bangla</option>
                </select>

                <select id="footerSettingsCurrency" class="form-select form-select-sm bg-transparent border-0"
                    aria-label="Default select example" name="store-language">
                    <option class="footer-select__option" selected>BDT</option>
                </select>
            </div>
        </div>
    </div>
</footer>

<!-- Mobile Fixed Footer -->
{{-- <footer class="footer-mobile container w-100 px-5 d-md-none bg-body">
    <div class="row text-center">
        <div class="col-4">
            <a href="{{ route('index') }}" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_home" />
                </svg>
                <span>Home</span>
            </a>
        </div><!-- /.col-3 -->

        <div class="col-4">
            <a href="{{ route('shop') }}" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_hanger" />
                </svg>
                <span>Shop</span>
            </a>
        </div><!-- /.col-3 -->

        <div class="col-4">
            <a class="footer-mobile__link d-flex flex-column align-items-center js-open-aside" data-aside="cartDrawer">
                <div class="position-relative">
                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.2236 12.5257C19.6384 9.40452 19.3458 7.84393 18.2349 6.92196C17.124 6 15.5362 6 12.3606 6H11.6394C8.46386 6 6.87608 6 5.76518 6.92196C4.65428 7.84393 4.36167 9.40452 3.77645 12.5257C2.95353 16.9146 2.54207 19.1091 3.74169 20.5545C4.94131 22 7.17402 22 11.6394 22H12.3606C16.826 22 19.0587 22 20.2584 20.5545C20.9543 19.7159 21.108 18.6252 20.9537 17"
                            stroke="#000000" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6" stroke="#000000"
                            stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="wishlist-amount d-block position-absolute js-cart-items-count"
                        id="total-cart-item">0</span>
                </div>
                <span>Cart</span>
            </a>
        </div>
    </div><!-- /.row -->
</footer> --}}
