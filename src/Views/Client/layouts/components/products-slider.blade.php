@isset($products)
    <div class="container">
        <h2 class="section-title">
            {{ $title }}
        </h2>
        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            @foreach ($products as $product)
                <div class="product-default">
                    <figure>
                        <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}">
                            @if ($product['p_thumb_image'])
                                <img style="width: 200px; height: 200px;" src="{{ getImage($product['p_thumb_image']) }}" width="280px" height="280px"
                                    alt="product">
                            @endif

                        </a>

                        <div class="label-group">
                            @if ($product['p_is_new'] = 1)
                                <div class="product-label label-hot">
                                    New
                                </div>
                            @endif
                            @if ($product['p_price_sale'] > 0 || ($product['p_is_good_deal'] == 1))
                                <div class="product-label label-sale">
                                    Sale
                                </div>
                            @endif
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="#" class="product-category">
                                {{ $product['c_name'] }}
                            </a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}">{{ $product['p_name'] }}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            @if ($product['p_price_sale'] > 0)
                                <del class="old-price">{{ formatPrice($product['p_price_sale']) }}đ</del>
                            @endif
                            <span class="product-price">
                                {{ formatPrice($product['p_price_sale'] ?: $product['p_price_regular']) }}đ
                            </span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="#" title="Wishlist" class="btn-icon-wish">
                                <i class="icon-heart"></i>
                            </a>
                            <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}" class="btn-icon btn-add-cart">
                                <i class="fa fa-arrow-right"></i>
                                <span>SELECT OPTIONS</span>
                            </a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
            @endforeach
        </div>
    </div>
@endisset
