@extends('layouts.account')
@section('view-tab')
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <h1>
                Chi Tiết Đơn Hàng
            </h1>
        </div>
    </div>

    <div class="container">

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ routeClient('') }}">Home</a>
            <a class="breadcrumb-item" href="{{ routeClient('account/orders') }}">Orders</a>
            <span class="breadcrumb-item active" aria-current="page">
                Đơn Hàng: {{ $order['order_code'] }}
            </span>
        </nav>

        <div class="row">

            <div class="col-12">
                <section class="py-5">
                    <ul class="timeline">

                        @foreach (['Chờ xác nhận', 'Đã xác nhận', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao hàng', 'Đơn hàng đã bị hủy'] as $status)
                            <li class="timeline-item mb-2">
                                <p class="fw-bold active">
                                    {{ $status }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3>Thông Tin Người Nhận:</h3>
                                </div>

                                <div class="mb-1 mt-3">
                                    Name: {{ $order['user_name'] }}
                                </div>
                                <div class="mb-1">
                                    Email: {{ $order['user_email'] }}
                                </div>
                                <div class="mb-1">
                                    Phone: {{ $order['user_phone'] }}
                                </div>
                                <div class="mb-1">
                                    Address: {{ $order['user_address'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3>Thông Tin Đơn Hàng:</h3>
                                </div>

                                <div class="mb-1 mt-3">
                                    Status Order:
                                    <span class="badge p-2 {{ matchStatusOrderClass($order['status_order']) }}">
                                        {{ matchStatusOrder($order['status_order']) }}</span>
                                </div>

                                <div class="mb-1">
                                    Status Payment:
                                    <span style="color: #fff"
                                        class="badge p-2 {{ $order['status_payment'] == 'unpaid' ? 'bg-danger' : 'bg-primary' }}">
                                        {{ matchStatusPayMent($order['status_payment']) }}
                                    </span>
                                </div>

                                <div class="mb-1">
                                    Total: {{ formatPrice($order['total_price']) }}đ
                                </div>

                                <div class="mb-1">
                                    Time: {{ date('Y/m/y H:i', strtotime($order['created_at'])) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Sku</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Color</th>
                                <th scope="col">Price</th>
                                <th scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orderItems as $key => $item)
                                @php
                                    $price = $item['oi_product_price_sale'] ?: $item['oi_product_price_regular'];
                                    $subTotal = $price * $item['oi_quatity'];
                                @endphp

                                <tr class="">
                                    <td scope="row">
                                        @if (!empty($item['oi_product_thumb_image']))
                                            <img src="{{ getImage($item['oi_product_thumb_image']) }}"
                                                alt="{{ $item['oi_product_name'] }}" width="60px" height="60px">
                                        @endif
                                    </td>
                                    <td>
                                        {{ limitText($item['oi_product_name'], 10) }}
                                    </td>
                                    <td>{{ $item['oi_product_sku'] }}</td>
                                    <td>x{{ $item['oi_quatity'] }}</td>
                                    <td>{{ $item['oi_variant_color_name'] }}</td>
                                    <td>
                                        {{ formatPrice($price) }}đ
                                    </td>
                                    <td>
                                        {{ formatPrice($subTotal) }}đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($order['status_order'] === 'pending')
                <div class="col-12">
                    <button class="btn btn-danger">Hủy đơn hàng</button>
                </div>
            @endif
        </div>
    </div>
@endsection
