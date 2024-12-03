@extends('layouts.master')
@section('title', 'Nhom 1 Ecommerce')
@section('content')
    <!-- home-slider -->
    @include('layouts.components.banner-home')
    <!-- info-boxes-slider -->
    <div class="container">
        @include('layouts.components.info-boxes-slider')
        @include('layouts.components.categories-home-slider')
    </div>
    <section class="products-section pt-0">
        @include('layouts.components.products-slider', [
            'title' => 'Featured Product',
            'products' => $top10,
        ])
    </section>
    <section class="products-section pt-0">
        @include('layouts.components.products-slider', ['title' => 'New Product', 'products' => $top10])
        <div class="container">
            <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter"
                style="background: #2A95CB center/cover url('/b3_du_an1/assets/theme/client/images/demoes/demo4/banners/banner-4.jpg')">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                            <b class="d-inline-block mr-3 mb-1 mb-md-0">Big Sale</b> All new fashion brands
                            items up to 70% off
                            <small class="text-transform-none align-middle">Online Purchases Only</small>
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center text-sm-right">
                        <a class="btn btn-light btn-white btn-lg" href="category.html">View Sale</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products-section pt-0">
        @include('layouts.components.products-slider', ['title' => 'Sale Product', 'products' => $top10])
    </section>
    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Customer Support</h3>
                            <h5>You Won't Be Alone</h5>
                            <p>We really care about you and your website as much as you do. Purchasing Porto or
                                any other theme from us you get 100% free support.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Fully Customizable</h3>
                            <h5>Tons Of Options</h5>
                            <p>With Porto you can customize the layout, colors and styles within only a few
                                minutes. Start creating an amazing website right now!</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-action-undo"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Powerful Admin</h3>
                            <h5>Made To Help You</h5>
                            <p>Porto has very powerful admin features to help customer to build their own shop
                                in minutes without any special skills in web development.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-->
    </section>
@endsection
