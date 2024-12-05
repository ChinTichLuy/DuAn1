@extends('layouts.master')
@section('title', 'Shop')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="demo4.html">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </nav>
        @php
            $priceSale = 0;
        @endphp
        <div class="row">

            @if (!empty($products))
                <div class="col-lg-9 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle">
                                <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>
                            <div class="toolbox-item toolbox-sort">
                                <label>Sort By:</label>
                                <div class="select-custom">
                                    <select name="orderby" class="form-control">
                                        <option value="menu_order" selected="selected">Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->
                        </div>
                        <!-- End .toolbox-left -->
                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>Show:</label>
                                <div class="select-custom">
                                    <select name="count" class="form-control">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->
                            <div class="toolbox-item layout-modes">
                                <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="category-list.html" class="layout-btn btn-list" title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div>
                            <!-- End .layout-modes -->
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}">
                                            @if ($product['p_thumb_image'] && file_exists($product['p_thumb_image']))
                                                <img style="height: 200px; width: 200px"
                                                    src="{{ $product['p_thumb_image'] }}" alt="" width="50px"
                                                    height="50px">
                                            @else
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/170px-Laravel.svg.png"
                                                    alt="" width="50px" height="50px">
                                            @endif
                                        </a>
                                        <div class="label-group">
                                            {{-- <div class="product-label label-hot">{{ $product['type'] }}</div> --}}
                                            @if ($product['p_price_sale'] > 0)
                                                <div class="product-label label-sale">Sale</div>
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="#" class="product-category">
                                                    {{ $product['c_name'] }}
                                                </a>
                                            </div>
                                        </div>
                                        <h3 class="product-title">
                                            <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}">
                                                {{ $product['p_name'] }}
                                            </a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->
                                        <div class="price-box">
                                            {{-- <span class="product-price">{{ formatPrice($product->price_regular) }}đ</span> --}}
                                            @if ($product['p_price_sale'] > 0)
                                                <span class="old-price">{{ formatPrice($product['p_price_regular']) }}
                                                    đ</span>
                                                <span class="product-price">{{ formatPrice($product['p_price_sale']) }}
                                                    đ</span>
                                            @else
                                                <span class="product-price">{{ formatPrice($product['p_price_regular']) }}
                                                    đ</span>
                                            @endif
                                        </div>
                                        <!-- End .price-box -->
                                        <div class="product-action">
                                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist">
                                                <i class="icon-heart"></i>
                                            </a>
                                            <a href="{{ routeClient('shop/' . $product['p_slug'] . '/detail') }}"
                                                class="btn-icon btn-add-cart">
                                                <i class="fa fa-arrow-right"></i>
                                                <span>SELECT OPTIONS</span>
                                            </a>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End .row -->
                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show">
                            <label>Show:</label>
                            <div class="select-custom">
                                <select name="count" class="form-control">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                        <!-- End .toolbox-item -->
                        <ul class="pagination toolbox-item">

                            @if ($page == 1)
                                <li class="page-item disabled">
                                    <a class="page-link page-link-btn" href="category-4col.html#">
                                        <i class="icon-angle-left"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link page-link-btn" href="{{ routeClient('shop?page=' . $page - 1) }}">
                                        <i class="icon-angle-left"></i>
                                    </a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $totalPage; $i++)
                                <li class="page-item {{ $page == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ routeClient('shop?page=' . $i) }}">
                                        {{ $i }}
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            @endfor
                            <li class="page-item"><span class="page-link">...</span></li>

                            @if ($page == $totalPage)
                                <li class="page-item disabled">
                                    <a class="page-link page-link-btn" href="category-4col.html#"><i
                                            class="icon-angle-right"></i></a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link page-link-btn"
                                        href="{{ routeClient('shop?page=' . $page + 1) }}"><i
                                            class="icon-angle-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @else
                <h1 class="text-danger">Chưa có sản phẩm nào</h1>
            @endif
            <!-- End .col-lg-9 -->
            <div class="sidebar-overlay"></div>
            {{-- Category --}}
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                aria-controls="widget-body-2">Categories</a>
                        </h3>
                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ routeClient("shop?category={$category['id']}") }}"
                                                class="category-{{ $category['id'] }}">{{ $category['name'] }}</a>
                                            {{-- <span class="products-count">(2)</span> --}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->
                    <!-- End .widget -->
                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured</h3>
                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-4.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-4-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Blue Backpack for
                                                    the Young - S</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-5.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-5-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Casual Spring Blue
                                                    Shoes</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-6.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-6-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Men Black Gentle
                                                    Belt</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <!-- End .featured-col -->
                                <div class="featured-col">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-1.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-1-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Ultimate 3D
                                                    Bluetooth Speaker</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-2-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Brown Women Casual
                                                    HandBag</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('theme/client/images/products/small/product-3.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                                <img src="{{ asset('theme/client/images/products/small/product-3-2.jpg') }}"
                                                    width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product.html">Circled Ultimate
                                                    3D Speaker</a></h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <!-- End .featured-col -->
                            </div>
                            <!-- End .widget-featured-slider -->
                        </div>
                        <!-- End .widget-body -->
                    </div>
                    <!-- End .widget -->
                    <!-- End .widget -->
                </div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
    <div class="mb-4"></div>
@endsection
