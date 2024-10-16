@extends('themes.default.layout.app')

@section('content')
    <div class="py-0 py-md-5"></div>
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="about-us container">
            <div class="mw-930">
                <h2 class="page-title">ABOUT {{ $configData->name }}</h2>
            </div>
            <div class="about-us__content pb-5 mb-5">
                <p class="mb-5">
                    <img loading="lazy" class="w-100 h-auto d-block" src="{{ asset('themes/default/aboutcover.png') }}"
                        width="1410" height="550" alt="">
                </p>
                <div class="mw-930">
                    <h3 class="mb-4">OUR STORY</h3>
                    <p class="fs-6 fw-medium mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                        officia deserunt mollit anim id est laborum.</p>
                    <p class="mb-4">Saw wherein fruitful good days image them, midst, waters upon, saw. Seas lights
                        seasons. Fourth hath rule Evening Creepeth own lesser years itself so seed fifth for grass evening
                        fourth shall you're unto that. Had. Female replenish for yielding so saw all one to yielding grass
                        you'll air sea it, open waters subdue, hath. Brought second Made. Be. Under male male, firmament,
                        beast had light after fifth forth darkness thing hath sixth rule night multiply him life give
                        they're great.</p>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="mb-3">Our Mission</h5>
                            <p class="mb-3">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Our Vision</h5>
                            <p class="mb-3">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</p>
                        </div>
                    </div>
                </div>
                <div class="mw-930 d-lg-flex align-items-lg-center">
                    <div class="image-wrapper col-lg-6">
                        <img class="h-auto" loading="lazy" src="{{ asset('themes/default/brandlogo.png') }}" width="450"
                            height="500" alt="">
                    </div>
                    <div class="content-wrapper col-lg-6 px-lg-4">
                        <h5 class="mb-3">The Company</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet sapien dignissim a elementum.
                            Sociis metus, hendrerit mauris id in. Quis sit sit ultrices tincidunt euismod luctus diam.
                            Turpis sodales orci etiam phasellus lacus id leo. Amet turpis nunc, nulla massa est viverra
                            interdum. Praesent auctor nulla morbi non posuere mattis. Arcu eu id maecenas cras.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="service-promotion horizontal container mw-930 pt-0 mb-md-4 pb-md-4 mb-xl-5">
            <div class="row">
                <div class="col-md-4 text-center mb-5 mb-md-0">
                    <div class="service-promotion__icon mb-4">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_shipping" />
                        </svg>
                    </div>
                    <h3 class="service-promotion__title fs-6 text-uppercase">Fast Delivery</h3>
                    <p class="service-promotion__content text-secondary">Delivery for all orders over 60 Tk</p>
                </div><!-- /.col-md-4 text-center-->

                <div class="col-md-4 text-center mb-5 mb-md-0">
                    <div class="service-promotion__icon mb-4">
                        <svg width="53" height="52" viewBox="0 0 53 52" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_headphone" />
                        </svg>
                    </div>
                    <h3 class="service-promotion__title fs-6 text-uppercase">24/7 Customer Support</h3>
                    <p class="service-promotion__content text-secondary">Friendly 24/7 customer support</p>
                </div><!-- /.col-md-4 text-center-->

                <div class="col-md-4 text-center mb-4 pb-1 mb-md-0">
                    <div class="service-promotion__icon mb-4">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_shield" />
                        </svg>
                    </div>
                    <h3 class="service-promotion__title fs-6 text-uppercase">Money Back Guarantee</h3>
                    <p class="service-promotion__content text-secondary">We return money within 30 days</p>
                </div><!-- /.col-md-4 text-center-->
            </div><!-- /.row -->
        </section>
    </main>
@endsection
