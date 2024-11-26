@extends('layouts.master')
@section('title')
    {{ $product['p_name'] }}
@endsection
@section('content')
    @php

        $priceSale = 0;
    @endphp
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="demo4.html">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ routeClient('shop') }}">Shop</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product['p_name'] }}
                </li>
            </ol>
        </nav>
        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“{{ $product['p_name'] }}”</strong>
                <span>has been added to your cart.</span>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            <!---->
                            @if ($product['p_price_sale'] > 0)
                                <div class="product-label label-sale">
                                    -16%
                                </div>
                            @endif
                        </div>

                        @if (!empty($productGalleries))
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach ($productGalleries as $image)
                                    <div class="product-item">
                                        @if ($image && file_exists($image['image']))
                                            <img class="product-single-image" src="{{ getImage($image['image']) }}"
                                                data-zoom-image="{{ getImage($image['image']) }}" width="468px"
                                                height="468px" alt="product" style="height: 478px" />
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <div class="product-item">
                                    @if ($product['p_thumb_image'] && file_exists($product['p_thumb_image']))
                                        <img class="product-single-image" src="{{ getImage($product['p_thumb_image']) }}"
                                            data-zoom-image="{{ getImage($product['p_thumb_image']) }}" width="468px"
                                            height="468px" alt="product" style="height: 478px" />
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- @if (!empty($product->galleries->isNotEmpty()))
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach ($product->galleries as $image)
                                    <div class="product-item">
                                        @if ($image && Storage::exists($image->image))
                                            <img class="product-single-image" src="{{ Storage::url($image->image) }}"
                                                data-zoom-image="{{ Storage::url($image->image) }}" width="468px"
                                                height="468px" alt="product" style="height: 478px" />
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <div class="product-item">
                                    @if ($product->thumb_image && Storage::exists($product->thumb_image))
                                        <img class="product-single-image" src="{{ Storage::url($product->thumb_image) }}"
                                            data-zoom-image="{{ Storage::url($product->thumb_image) }}" width="478px"
                                            height="478px" alt="product" style="height: 478px;" />
                                    @else
                                        <img class="product-single-image" src="{{ $product->thumb_image }}"
                                            data-zoom-image="/assets/theme/client/images/products/zoom/product-1-big.jpg"
                                            width="468" height="468" alt="product" />
                                    @endif
                                </div>
                            </div>
                        @endif --}}
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>



                    @if (!empty($productGalleries))
                        <div class="prod-thumbnail owl-dots">
                            @foreach ($productGalleries as $image)
                                <div class="owl-dot">
                                    @if ($image && file_exists($image['image']))
                                        <img src="{{ getImage($image['image']) }}" alt="product-thumbnail"
                                            style="width: 110px; height: 110px;" />
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif




                </div>
                <!-- End .product-single-gallery -->
                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">
                        {{ $product['p_name'] }}
                    </h1>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->
                        <a href="product-variable.html#" class="rating-link">( 6 Reviews )</a>
                    </div>
                    <!-- End .ratings-container -->
                    <hr class="short-divider">
                    <div class="price-box">
                        <span class="new-price text-danger">
                            {{ formatPrice($product['p_price_sale'] ?: $product['p_price_regular']) }}đ
                        </span>
                        @if ($product['p_price_sale'] > 0)
                            <span class="old-price">
                                {{ formatPrice($product['p_price_regular']) }}đ
                            </span>
                        @endif
                    </div>
                    <!-- End .price-box -->
                    <div class="product-desc">
                        @if ($product['p_content'])
                            <p>
                                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet,
                                ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est.
                                Mauris
                                placerat eleifend leo.
                            </p>
                        @endif
                    </div>
                    <!-- End .product-desc -->
                    <ul class="single-info-list">
                        <!---->
                        <li>
                            SKU:
                            <strong>
                                {{ $product['p_sku'] }}
                            </strong>
                        </li>
                        <li>
                            CATEGORY:
                            <strong>
                                <a href="#" class="product-category">
                                    {{ $product['c_name'] }}
                                </a>
                            </strong>
                        </li>

                        @if (!empty($productTags))
                            <li>
                                TAGs:
                                @foreach ($productTags as $tag)
                                    <strong>
                                        <a href="#" class="product-category">{{ $tag['name'] }}</a>,
                                    </strong>
                                @endforeach
                            </li>
                        @endif
                    </ul>
                    <div class="product-filters-container">

                        @if (!empty($productVariants))
                            <div class="product-single-filter"><label>Color:</label>
                                <ul class="config-size-list config-color-list config-filter-list">
                                    @foreach ($productVariants as $color)
                                        <li class="">
                                            <a href="javascript:;" class="filter-color"
                                                data-color-id="{{ $color['v_product_color_id'] }}">
                                                {{ $color['c_name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="product-single-filter">
                                <label></label>
                                <a class="font1 text-uppercase clear-btn" href="product-variable.html#">Clear</a>
                            </div>
                        @endif
                        <!---->
                    </div>
                    <div class="product-action">
                        <div class="price-box product-filtered-price">
                            <del class="old-price"><span>$286.00</span></del>
                            <span class="product-price">$245.00</span>
                        </div>
                        <div class="product-single-qty">
                            <input id="product-quantity" class="horizontal-quantity form-control" type="text">
                        </div>
                        <!-- End .product-single-qty -->
                        <button id="btn-add-cart" data-product-id="{{ $product['p_id'] }}"
                            class="btn btn-dark add-cart mr-2" type="button">
                            Add to Cart
                        </button>
                        {{-- <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                    Cart</a> --}}
                        <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a>
                    </div>
                    <!-- End .product-action -->
                    <hr class="divider mb-0 mt-0">
                    <div class="product-single-share mb-2">
                        <label class="sr-only">Share:</label>
                        <div class="social-icons mr-2">
                            <a href="product-variable.html#" class="social-icon social-facebook icon-facebook"
                                target="_blank" title="Facebook"></a>
                            <a href="product-variable.html#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="product-variable.html#" class="social-icon social-linkedin fab fa-linkedin-in"
                                target="_blank" title="Linkedin"></a>
                            <a href="product-variable.html#" class="social-icon social-gplus fab fa-google-plus-g"
                                target="_blank" title="Google +"></a>
                            <a href="product-variable.html#" class="social-icon social-mail icon-mail-alt"
                                target="_blank" title="Mail"></a>
                        </div>
                        <!-- End .social-icons -->
                        <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div>
                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        </div>
        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                        role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content"
                        role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                        role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews
                        {{-- ({{ count($comments) }}) --}}
                        10
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum
                            consectetur sed do, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                            occaecat.</p>
                        <ul>
                            <li>Any Product types that You want - Simple, Configurable
                            </li>
                            <li>Downloadable/Digital Products, Virtual Products
                            </li>
                            <li>Inventory Management with Backordered items
                            </li>
                        </ul>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. </p>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->
                <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('theme/client/images/products/single/body-shape.png') }}"
                                    alt="body shape" width="217" height="398">
                            </div>
                            <!-- End .col-md-4 -->
                            <div class="col-md-8">
                                <table class="table table-size">
                                    <thead>
                                        <tr>
                                            <th>SIZE</th>
                                            <th>CHEST (in.)</th>
                                            <th>WAIST (in.)</th>
                                            <th>HIPS (in.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XS</td>
                                            <td>34-36</td>
                                            <td>27-29</td>
                                            <td>34.5-36.5</td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>36-38</td>
                                            <td>29-31</td>
                                            <td>36.5-38.5</td>
                                        </tr>
                                        <tr>
                                            <td>M</td>
                                            <td>38-40</td>
                                            <td>31-33</td>
                                            <td>38.5-40.5</td>
                                        </tr>
                                        <tr>
                                            <td>L</td>
                                            <td>40-42</td>
                                            <td>33-36</td>
                                            <td>40.5-43.5</td>
                                        </tr>
                                        <tr>
                                            <td>XL</td>
                                            <td>42-45</td>
                                            <td>36-40</td>
                                            <td>43.5-47.5</td>
                                        </tr>
                                        <tr>
                                            <td>XLL</td>
                                            <td>45-48</td>
                                            <td>40-44</td>
                                            <td>47.5-51.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-size-content -->
                </div>
                <!-- End .tab-pane -->
                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>23 kg</td>
                            </tr>
                            <tr>
                                <th>Dimensions</th>
                                <td>12 × 24 × 35 cm</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>Black, Green, Indigo</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>Large, Medium, Small</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End .tab-pane -->
                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        {{-- <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3> --}}
                        <div class="comment-list">
                            {{-- @if ($comments->isNotEmpty())
                                @foreach ($comments as $comment)
                                    <div class="comments mb-1">
                                        <figure class="img-thumbnail">
                                            @php
                                                $image = $comment->user->avatar;
                                            @endphp
                                            @if ($image && Storage::exists($image))
                                                <img src="{{ Storage::url($image) }}" alt="{{ $comment->user->name }}"
                                                    width="80" height="80">
                                            @else
                                                <img src="https://laravel.com/img/logomark.min.svg" alt="Default"
                                                    width="80" height="80">
                                            @endif
                                        </figure>
                                        <div class="comment-block">
                                            <div class="comment-header">
                                                <div class="comment-arrow"></div>
                                                <div class="ratings-container float-sm-right">
                                                    <div class="product-ratings">
                                                        <span class="ratings"
                                                            style="width:{{ matchRatings($comment->rating) }}"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <span class="comment-by">
                                                    <strong>{{ $comment->user->name }}</strong>
                                                    – {{ $comment->created_at }}
                                                </span>
                                            </div>
                                            <div class="comment-content">
                                                <p>
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h1>Chua co comment nao</h1>
                            @endif --}}

                            <div class="comments mb-1">
                                <figure class="img-thumbnail">
                                    @if ($product['p_thumb_image'] && file_exists($product['p_thumb_image']))
                                        <img src="{{ getImage($product['p_thumb_image']) }}" alt=""
                                            width="80" height="80">
                                    @else
                                        <img src="https://laravel.com/img/logomark.min.svg" alt="Default" width="80"
                                            height="80">
                                    @endif
                                </figure>
                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>
                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:80%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <span class="comment-by">
                                            <strong>LuxChill</strong>
                                            – 25/11/2024
                                        </span>
                                    </div>
                                    <div class="comment-content">
                                        <p>
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint expedita quisquam
                                            suscipit quos cum voluptatum dolorem quaerat, perspiciatis maxime omnis mollitia
                                            corrupti temporibus blanditiis ex. Aut corporis quisquam aliquam expedita?
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="divider"></div>
                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            @php
                                $isAuth = true;
                            @endphp

                            @if ($isAuth)
                                <form action="#" method="POST" enctype="multipart/form-data"
                                    class="comment-form m-0">
                                    @csrf
                                    <input type="tel" hidden value="{{ $product['p_id'] }}" name="product_id">
                                    <div class="rating-form">
                                        <label for="rating">Your rating <span class="required">*</span></label>
                                        <span class="rating-stars">
                                            <a class="star-1" href="product-variable.html#">1</a>
                                            <a class="star-2" href="product-variable.html#">2</a>
                                            <a class="star-3" href="product-variable.html#">3</a>
                                            <a class="star-4" href="product-variable.html#">4</a>
                                            <a class="star-5" href="product-variable.html#">5</a>
                                        </span>
                                        <select name="rating" id="rating" required="" style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Your review
                                            <span class="required">*</span>
                                        </label>
                                        <textarea cols="5" rows="6" class="form-control form-control-sm" name="content"></textarea>
                                    </div>
                                    <!-- End .form-group -->
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            @endif
                        </div>
                        <!-- End .add-product-review -->
                    </div>
                    <!-- End .product-reviews-content -->
                </div>
                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>


        {{-- <section class="products-section pt-0">
            @include('client.layouts.components.products-slider', [
                'products' => $relatedProducts,
                'title' => 'Related Products',
            ])
        </section> --}}


    </div>
@endsection

@section('script')
    <script src="{{ asset('js/client/shopDetail.js') }}"></script>
@endsection
