  <!-- Cart Drawer -->
  <div class="aside aside_right overflow-hidden cart-drawer" id="cartDrawer">
      <div class="aside-header d-flex align-items-center">
          <h3 class="text-uppercase fs-6 mb-0">SHOPPING BAG ( <span class="cart-amount js-cart-items-count">1</span> )
          </h3>
          <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
      </div><!-- /.aside-header -->

      <div class="aside-content cart-drawer-items-list">
          <div class="cart-drawer-item d-flex position-relative">
              <div class="position-relative">
                  <a href="product1_simple.html">
                      {{-- <img loading="lazy" class="cart-drawer-item__img" src="{{ asset('themes/default') }}/images/cart-item-1.jpg" alt=""> --}}
                  </a>
              </div>
              <div class="cart-drawer-item__info flex-grow-1">
                  <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Zessi Dresses</a></h6>
                  <p class="cart-drawer-item__option text-secondary">Color: Yellow</p>
                  <p class="cart-drawer-item__option text-secondary">Size: L</p>
                  <div class="d-flex align-items-center justify-content-between mt-1">
                      <div class="qty-control position-relative">
                          <input type="number" name="quantity" value="1" min="1"
                              class="qty-control__number border-0 text-center">
                          <div class="qty-control__reduce text-start">-</div>
                          <div class="qty-control__increase text-end">+</div>
                      </div><!-- .qty-control -->
                      <span class="cart-drawer-item__price money price">$99</span>
                  </div>
              </div>

              <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
          </div><!-- /.cart-drawer-item d-flex -->

          <hr class="cart-drawer-divider">

          <div class="cart-drawer-item d-flex position-relative">
              <div class="position-relative">
                  <a href="product1_simple.html">
                      {{-- <img loading="lazy" class="cart-drawer-item__img" src="../images/cart-item-2.jpg" alt=""> --}}
                  </a>
              </div>
              <div class="cart-drawer-item__info flex-grow-1">
                  <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Kirby T-Shirt</a></h6>
                  <p class="cart-drawer-item__option text-secondary">Color: Black</p>
                  <p class="cart-drawer-item__option text-secondary">Size: XS</p>
                  <div class="d-flex align-items-center justify-content-between mt-1">
                      <div class="qty-control position-relative">
                          <input type="number" name="quantity" value="4" min="1"
                              class="qty-control__number border-0 text-center">
                          <div class="qty-control__reduce text-start">-</div>
                          <div class="qty-control__increase text-end">+</div>
                      </div><!-- .qty-control -->
                      <span class="cart-drawer-item__price money price">$89</span>
                  </div>
              </div>

              <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
          </div><!-- /.cart-drawer-item d-flex -->

          <hr class="cart-drawer-divider">

          <div class="cart-drawer-item d-flex position-relative">
              <div class="position-relative">
                  <a href="product1_simple.html">
                      {{-- <img loading="lazy" class="cart-drawer-item__img" src="../images/cart-item-3.jpg" alt=""> --}}
                  </a>
              </div>
              <div class="cart-drawer-item__info flex-grow-1">
                  <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                  <p class="cart-drawer-item__option text-secondary">Color: Green</p>
                  <p class="cart-drawer-item__option text-secondary">Size: L</p>
                  <div class="d-flex align-items-center justify-content-between mt-1">
                      <div class="qty-control position-relative">
                          <input type="number" name="quantity" value="3" min="1"
                              class="qty-control__number border-0 text-center">
                          <div class="qty-control__reduce text-start">-</div>
                          <div class="qty-control__increase text-end">+</div>
                      </div><!-- .qty-control -->
                      <span class="cart-drawer-item__price money price">$129</span>
                  </div>
              </div>

              <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
          </div><!-- /.cart-drawer-item d-flex -->

      </div><!-- /.aside-content -->

      <div class="cart-drawer-actions position-absolute start-0 bottom-0 w-100">
          <hr class="cart-drawer-divider">
          <div class="d-flex justify-content-between">
              <h6 class="fs-base fw-medium">SUBTOTAL:</h6>
              <span class="cart-subtotal fw-medium">$176.00</span>
          </div><!-- /.d-flex justify-content-between -->
          <a href="shop_cart.html" class="btn btn-light mt-3 d-block">View Cart</a>
          <a href="shop_checkout.html" class="btn btn-primary mt-3 d-block">Checkout</a>
      </div><!-- /.aside-content -->
  </div><!-- /.aside -->

  <!-- Sitemap -->
  <div class="modal fade" id="siteMap" tabindex="-1">
      <div class="modal-dialog modal-fullscreen">
          <div class="sitemap d-flex">
              <div class="w-50 d-none d-lg-block">
                  <img loading="lazy" src="../images/nav-bg.jpg" alt="Site map" class="sitemap__bg">
              </div><!-- /.sitemap__bg w-50 d-none d-lg-block -->
              <div class="sitemap__links w-50 flex-grow-1">
                  <div class="modal-content">
                      <div class="modal-header">
                          <ul class="nav nav-pills" id="pills-tab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link active rounded-1 text-uppercase" id="pills-item-1-tab"
                                      data-bs-toggle="pill" href="#pills-item-1" role="tab"
                                      aria-controls="pills-item-1" aria-selected="true">WOMEN</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link rounded-1 text-uppercase" id="pills-item-2-tab"
                                      data-bs-toggle="pill" href="#pills-item-2" role="tab"
                                      aria-controls="pills-item-2" aria-selected="false">MEN</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link rounded-1 text-uppercase" id="pills-item-3-tab"
                                      data-bs-toggle="pill" href="#pills-item-3" role="tab"
                                      aria-controls="pills-item-3" aria-selected="false">KIDS</a>
                              </li>
                          </ul>
                          <button type="button" class="btn-close-lg" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                          <div class="tab-content col-12" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-item-1" role="tabpanel"
                                  aria-labelledby="pills-item-1-tab">
                                  <div class="row">
                                      <ul class="nav nav-tabs list-unstyled col-5 d-block" id="myTab"
                                          role="tablist">
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline active" id="tab-item-1-tab"
                                                  data-bs-toggle="tab" href="#tab-item-1" role="tab"
                                                  aria-controls="tab-item-1" aria-selected="true"><span
                                                      class="rline-content">WOMEN</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" id="tab-item-2-tab"
                                                  data-bs-toggle="tab" href="#tab-item-2" role="tab"
                                                  aria-controls="tab-item-2" aria-selected="false"><span
                                                      class="rline-content">MAN</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" id="tab-item-3-tab"
                                                  data-bs-toggle="tab" href="#tab-item-3" role="tab"
                                                  aria-controls="tab-item-3" aria-selected="false"><span
                                                      class="rline-content">KIDS</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">HOME</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">COLLECTION</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline text-red" href="#">SALE UP TO
                                                  50% OFF</a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">NEW</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">SHOES</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">ACCESSORIES</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">JOIN LIFE</span></a>
                                          </li>
                                          <li class="nav-item position-relative" role="presentation">
                                              <a class="nav-link nav-link_rline" href="#"><span
                                                      class="rline-content">#UOMOSTYLE</span></a>
                                          </li>
                                      </ul>

                                      <div class="tab-content col-7" id="myTabContent">
                                          <div class="tab-pane fade show active" id="tab-item-1" role="tabpanel"
                                              aria-labelledby="tab-item-1-tab">
                                              <ul class="sub-menu list-unstyled">
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">New</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Best
                                                          Sellers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Collaborations®</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Sets</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Denim</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jackets &
                                                          Coats</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Overshirts</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Sweatshirts
                                                          and Hoodies</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">T-shirts &
                                                          Tops</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shirts &
                                                          Blouses</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shorts and
                                                          Bermudas</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="shop3.html"
                                                          class="menu-link menu-link_us-s">Accessories</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Bags</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="about.html" class="menu-link menu-link_us-s">Gift
                                                          Card</a>
                                                  </li>
                                              </ul><!-- /.sub-menu -->
                                          </div>
                                          <div class="tab-pane fade" id="tab-item-2" role="tabpanel"
                                              aria-labelledby="tab-item-2-tab">
                                              <ul class="sub-menu list-unstyled">
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Best
                                                          Sellers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">New</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Sets</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Denim</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Collaborations®</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jackets &
                                                          Coats</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Overshirts</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Sweatshirts
                                                          and Hoodies</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="about.html" class="menu-link menu-link_us-s">Gift
                                                          Card</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shirts &
                                                          Blouses</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">T-shirts &
                                                          Tops</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shorts and
                                                          Bermudas</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="shop3.html"
                                                          class="menu-link menu-link_us-s">Accessories</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Bags</a>
                                                  </li>
                                              </ul><!-- /.sub-menu -->
                                          </div>
                                          <div class="tab-pane fade" id="tab-item-3" role="tabpanel"
                                              aria-labelledby="tab-item-3-tab">
                                              <ul class="sub-menu list-unstyled">
                                                  <li class="sub-menu__item">
                                                      <a href="about.html" class="menu-link menu-link_us-s">Gift
                                                          Card</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Collaborations®</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Sets</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Denim</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">New</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Best
                                                          Sellers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#"
                                                          class="menu-link menu-link_us-s">Overshirts</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jackets &
                                                          Coats</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shorts and
                                                          Bermudas</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="shop3.html"
                                                          class="menu-link menu-link_us-s">Accessories</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                                                  </li>
                                                  <li class="sub-menu__item">
                                                      <a href="#" class="menu-link menu-link_us-s">Bags</a>
                                                  </li>
                                              </ul><!-- /.sub-menu -->
                                          </div>
                                      </div>
                                  </div><!-- /.row -->
                              </div>
                              <div class="tab-pane fade" id="pills-item-2" role="tabpanel"
                                  aria-labelledby="pills-item-2-tab">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                      incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                      exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                      irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                      pariatur.</p>
                                  Elementum lectus a porta commodo suspendisse arcu, aliquam lectus faucibus.
                              </div>
                              <div class="tab-pane fade" id="pills-item-3" role="tabpanel"
                                  aria-labelledby="pills-item-3-tab">
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                      doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                      veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                                      voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                                      magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                  laboriosam, nisi ut aliquid ex ea commodi consequatur?
                              </div>
                          </div>
                      </div><!-- /.modal-body -->
                  </div><!-- /.modal-content -->
              </div><!-- /.sitemap__links w-50 flex-grow-1 -->
          </div>
      </div><!-- /.modal-dialog modal-fullscreen -->
  </div><!-- /.sitemap position-fixed w-100 -->
