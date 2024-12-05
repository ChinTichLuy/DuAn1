<div class="container">
    <div class="header-left col-lg-2 w-auto pl-0">
        <button class="mobile-menu-toggler text-primary mr-2" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="logo">
            <img src="{{ asset('theme/client/images/logo.png') }}" width="111" height="44" alt="Porto Logo">
        </a>
    </div>
    <!-- End .header-left -->
    <div class="header-right w-lg-max">
        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
            <form action="#" method="get">
                <div class="header-search-wrapper">
                    <input type="search" class="form-control" name="q" id="q" placeholder="Search..."
                        required>
                    <div class="select-custom">
                        <select id="cat" name="cat">
                            <option value="">All Categories</option>
                            <option value="4">Fashion</option>
                            <option value="12">- Women</option>
                            <option value="13">- Men</option>
                            <option value="66">- Jewellery</option>
                            <option value="67">- Kids Fashion</option>
                            <option value="5">Electronics</option>
                            <option value="21">- Smart TVs</option>
                            <option value="22">- Cameras</option>
                            <option value="63">- Games</option>
                            <option value="7">Home &amp; Garden</option>
                            <option value="11">Motors</option>
                            <option value="31">- Cars and Trucks</option>
                            <option value="32">- Motorcycles &amp; Powersports</option>
                            <option value="33">- Parts &amp; Accessories</option>
                            <option value="34">- Boats</option>
                            <option value="57">- Auto Tools &amp; Supplies</option>
                        </select>
                    </div>
                    <!-- End .select-custom -->
                    <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                </div>
                <!-- End .header-search-wrapper -->
            </form>
        </div>
        <!-- End .header-search -->
        <div class="header-contact d-none d-lg-flex pl-4 pr-4">
            <img alt="phone" src="{{ asset('theme/client/images/phone.png') }}" width="30" height="30"
                class="pb-1">
            <h6>
                <span>Call us now</span>
                <a href="tel:#" class="text-dark font1">0367253666</a>
            </h6>
        </div>
        {{-- Login --}}


        @if(!empty($_SESSION['user']))
        <a href="{{ routeClient('account') }}" class="header-icon" title="{{ $_SESSION['user']['name'] }}">
            <i class="icon-user-2"></i>
        </a>
        @else
        <a href="{{ routeClient('auth/login') }}" class="header-icon" title="Login">
            <i class="icon-user-2"></i>
        </a>
        @endif


        <a href="#" class="header-icon" title="Wishlist">
            <i class="icon-wishlist-2"></i>
        </a>
        <div class="dropdown cart-dropdown">
            <a href="#123" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <i class="minicart-icon"></i>
                <span class="cart-count badge-circle">0</span>
            </a>
            <div class="cart-overlay"></div>
            <div class="dropdown-menu mobile-cart">
                <a href="#" title="Close (Esc)" class="btn-close">×</a>
                <div class="dropdownmenu-wrapper custom-scrollbar">
                    <div class="dropdown-cart-header">Shopping Cart</div>
                    <!-- End .dropdown-cart-header -->
                    <div class="dropdown-cart-products">
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $99.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-1.jpg') }}" alt="product"
                                        width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <!-- End .product -->
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Brown Women Casual HandBag</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-2.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <!-- End .product -->
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <!-- End .product -->
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Circled Ultimate 3D Speaker</a>
                                </h4>
                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span> × $35.00
                                </span>
                            </div>
                            <!-- End .product-details -->
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('theme/client/images/products/product-3.jpg') }}"
                                        alt="product" width="80" height="80">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                            </figure>
                        </div>
                    </div>
                    <!-- End .cart-product -->
                    <div class="dropdown-cart-total">
                        <span>SUBTOTAL:</span>
                        <span class="cart-total-price float-right">$134.00</span>
                    </div>
                    <!-- End .dropdown-cart-total -->
                    <div class="dropdown-cart-action">
                        <a href="{{ routeClient('cart') }}" class="btn btn-gray btn-block view-cart">View
                            Cart</a>
                        <a href="#" class="btn btn-dark btn-block">Checkout</a>
                    </div>
                    <!-- End .dropdown-cart-total -->
                </div>
                <!-- End .dropdownmenu-wrapper -->
            </div>
            <!-- End .dropdown-menu -->
        </div>
        <!-- End .dropdown -->
    </div>
    <!-- End .header-right -->
</div>
