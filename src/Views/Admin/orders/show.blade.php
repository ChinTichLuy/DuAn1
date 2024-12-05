@extends('layouts.master')
@section('title')
    OrderCode: {{ $order['order_code'] }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Order: {{ $order['order_code'] }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Order: {{ $order['order_code'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="row">
                <form action="{{ routeAdmin('orders/' . $order['id'] . '/handleEdit') }}" method="POST">
                    {{-- <select name="status" class="form-select mb-3">
                        <option value="{{ $order['status_order'] }}" selected>
                            {{ matchStatusOrder($order['status_order']) }}
                        </option>
                        <option value="pending">Chờ xác nhận</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="preparing_goods">Đang chuẩn bị hàng</option>
                        <option value="shipping">Đang vận chuyển</option>
                        <option value="delivered">Đã giao hàng</option>
                    </select> --}}
                    <select name="status" class="form-select mb-3">
                        @php
                            $currentStatus = array_search(
                                $order['status_order'],
                                array_keys(\App\Models\Order::STATUS_ORDER),
                            );
                        @endphp
                        @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                            @php
                                $statusIndex = array_search($key, array_keys(\App\Models\Order::STATUS_ORDER));
                            @endphp
                            <option value="{{ $key }}" {{ $key === $order['status_order'] ? 'selected' : '' }}
                                {{ $statusIndex < $currentStatus ? 'disabled' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-success">Save</button>
                </form>
            </div>
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
    </div>
@endsection
{{-- @section('script')
    <script src="{{ asset('js/categories/index.js') }}"></script>
@endsection --}}