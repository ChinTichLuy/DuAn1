@isset($products)
    <div class="container">
        <h2 class="section-title">
            {{ $title }}
        </h2>
        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            @foreach ($products as $product)
                <div class="product-default">
                    <figure>
                        <a href="{{ route('shop.detail', $product->slug) }}">
                            @if ($product['thumb_image'] && Storage::exists($product['thumb_image']))
                                <img src="{{ Storage::url($product['thumb_image']) }}" width="280" height="280"
                                    alt="product">
                                {{-- <img src="{{ $product['img_2'] }}" width="280" height="280" alt="product"> --}}
                            @endif
                        </a>
                        @if ($product->price_sale > 0)
                            <div class="label-group">
                                {{-- <div class="product-label label-hot">
                        {{ $product['type'] }}
                </div> --}}
                                <div class="product-label label-sale">
                                    Sale
                                </div>
                            </div>
                        @endif
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="{{ route('shop.category', $product->slug) }}" class="product-category">
                                {{ $product->category->name }}
                            </a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{ route('shop.detail', $product->slug) }}">{{ $product->name }}</a>
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
                            @if ($product->price_sale > 0)
                                <del class="old-price">{{ formatPrice($product->price_regular) }}đ</del>
                            @endif
                            <span class="product-price">
                                {{ formatPrice($product->price_sale ?: $product->price_regular) }}đ
                            </span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="{{ route('wishlist.index') }}" title="Wishlist" class="btn-icon-wish">
                                <i class="icon-heart"></i>
                            </a>
                            <a href="{{ route('shop.detail', $product['slug']) }}" class="btn-icon btn-add-cart">
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