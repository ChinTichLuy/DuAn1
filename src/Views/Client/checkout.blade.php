@extends('layouts.master')
@section('title', 'Check Out')
@section('content')
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="#">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="#">Checkout</a>
            </li>
            <li class="disabled">
                <a href="#">Order Complete</a>
            </li>
        </ul>
        @php
            $checkAuth = true;
        @endphp
        @if ($checkAuth)
            <form action="{{ routeClient('checkout/add') }}" method="POST">
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>
                                <div id="checkout-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Name
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="text" name="user_name" class="form-control"
                                                    value="#" />
                                                {{-- @error('user_name') --}}
                                                <span class="fst-italic text-danger">Lỗi nha</span>
                                                {{-- @enderror --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email
                                                    <abbr class="required" title="required">*</abbr></label>
                                                <input type="email" name="user_email" class="form-control"
                                                    value="" />
                                                {{-- @error('user_email') --}}
                                                <span class="fst-italic text-danger">Lỗi nha</span>
                                                {{-- @enderror --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Phone
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="tel" name="user_phone" class="form-control"
                                                    value="#" />
                                                {{-- @error('user_phone') --}}
                                                <span class="fst-italic text-danger">Lỗi nha</span>
                                                {{-- @enderror --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address
                                                    <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="user_address" class="form-control"
                                                    value="#" />
                                                {{-- @error('user_address') --}}
                                                <span class="fst-italic text-danger">Lỗi nha</span>
                                                {{-- @enderror --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="form-label">
                                                    City
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <select class="form-select" id="city">
                                                    <option value="0" selected>Chọn Thành Phố</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="w-100">
                                                <label>
                                                    District
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <select class="form-select" id="district" value="#">
                                                    <option value="0" selected>Chọn Quận Huyện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label>
                                            Ward
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <select class="form-select" id="ward" value="#">
                                            <option value="0" selected>Chọn Phường Xã</option>
                                        </select>
                                    </div>
                                    <input type="text" hidden value="{{ $total }}" name="total_price">
                                    <input type="text" hidden name="city_main">
                                    <input type="text" hidden name="district_main">
                                    <input type="text" hidden name="ward_main">
                                    {{-- @foreach ($cart->cartItems as $key => $item)
                                        @php
                                            $price =
                                                $item->productVariant->product->price_sale ?:
                                                $item->productVariant->product->price_regular;
                                            $slug = $item->productVariant->product->slug;
                                            $image = $item->productVariant->product->thumb_image;
                                            $name = $item->productVariant->product->name;
                                            $color = $item->productVariant->color->name;
                                            $size = $item->productVariant->size->name;
                                            $sku = $item->productVariant->product->sku;
                                        @endphp
                                        <input type="text" hidden name="product[{{ $key }}][product_variant_id]"
                                            value="{{ $item->product_variant_id }}">
                                        <input type="text" hidden name="product[{{ $key }}][quantity]"
                                            value="{{ $item->quantity }}">
                                        <input type="text" hidden name="product[{{ $key }}][product_name]"
                                            value="{{ $name }}">
                                        <input type="text" hidden name="product[{{ $key }}][product_sku]"
                                            value="{{ $sku }}">
                                        <input type="text" hidden
                                            name="product[{{ $key }}][product_img_thumbnail]"
                                            value="{{ $image }}">
                                        <input type="text" hidden
                                            name="product[{{ $key }}][product_price_regular]"
                                            value="{{ $item->productVariant->product->price_regular }}">
                                        <input type="text" hidden
                                            name="product[{{ $key }}][product_price_sale]"
                                            value="{{ $item->productVariant->product->price_sale }}">
                                        <input type="text" hidden
                                            name="product[{{ $key }}][variant_size_name]"
                                            value="{{ $size }}">
                                        <input type="text" hidden
                                            name="product[{{ $key }}][variant_color_name]"
                                            value="{{ $color }}">
                                    @endforeach --}}
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create-account" />
                                            <label class="custom-control-label" data-toggle="collapse"
                                                data-target="#collapseThree" aria-controls="collapseThree"
                                                for="create-account">Create an
                                                account?</label>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="collapse">
                                        <div class="form-group">
                                            <label>Create account password
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input type="password" placeholder="Password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mt-0">
                                            <input type="checkbox" class="custom-control-input"
                                                id="different-shipping" />
                                            <label class="custom-control-label" data-toggle="collapse"
                                                data-target="#collapseFour" aria-controls="collapseFour"
                                                for="different-shipping">Ship to a
                                                different
                                                address?</label>
                                        </div>
                                    </div>
                                    {{-- <div id="collapseFour" class="collapse">
                            <div class="shipping-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Company name (optional)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="select-custom">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">Vanuatu</option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>
                                <div class="form-group mb-1 pb-2">
                                    <label>Street address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" placeholder="House number and street name" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" required />
                                </div>
                                <div class="form-group">
                                    <label>Town / City <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" required />
                                </div>
                                <div class="select-custom">
                                    <label>State / County <abbr class="required" title="required">*</abbr></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">NY</option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Postcode / ZIP <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="order-comments">Order notes (optional)</label>
                            <textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." required></textarea>
                        </div> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->
                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>
                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $product)
                                        <tr>
                                            <td>
                                                <h3 class="product-title">
                                                    {{ limitText($product['p_name'], 10) }}
                                                    <span class="product-qty">x{{ $product['ct_quantity'] }}</span>
                                                </h3>
                                            </td>
                                            <td>
                                                {{ $product['pc_name'] }}
                                            </td>
                                            <td>
                                                {{ calculateSubTotal($product['p_price_sale'] ?: $product['p_price_regular'], $product['ct_quantity']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal"></tr>
                                    <tr class="order-total">
                                        <td>
                                            <h4>Total:</h4>
                                        </td>
                                        <td>
                                            <b class="total-price">
                                                <span>{{ formatPrice($total) }}đ</span>
                                            </b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="payment-methods">
                                <h4 class="">Payment methods</h4>
                                <div class="form-check">
                                    <div>
                                        <input class="form-check-input" type="radio" value="0"
                                            name="payment" checked />
                                        <label class="form-check-label" for="">
                                            Thanh Toán Nhận Hàng
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" value="1" name="payment" />
                                        <label class="form-check-label" for="">
                                            Momo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="payUrl" class="btn btn-dark btn-place-order">
                                Place order
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
            </form>
        @else
            <div class="login-form-container">
                <h4>
                    Returning customer?
                    <a class="btn btn-link btn-toggle text-dark" href="#">
                        Login
                    </a>
                </h4>
            </div>
        @endif
        <!-- End .row -->
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/js/client/checkout/index.js') }}"></script> --}}
@endsection