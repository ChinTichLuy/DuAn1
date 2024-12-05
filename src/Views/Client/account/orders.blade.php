@extends('layouts.account')
@section('view-tab')
    <div class="order-content">
        <h3 class="account-sub-title d-none d-md-block">
            <i class="sicon-social-dropbox align-middle mr-3"></i>
            Orders
        </h3>


        <div class="order-table-container text-center">
            <table class="table table-order text-left">

                <thead>
                    <tr>
                        <td>#</td>
                        <td>Qty</td>
                        <td>Status</td>
                        <td>Payment</td>
                        <td>Total</td>
                        <td>Date</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ limitText($order['order_code'], 10) }}</td>
                            <td>2</td>
                            <td>
                                <span class="p-2 badge {{ matchStatusOrderClass($order['status_order']) }}">
                                    {{ matchStatusOrder($order['status_order']) }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="p-2 badge {{ $order['status_payment'] == 'unpaid' ? 'bg-danger' : 'bg-success' }}"
                                    style="color: #fff">
                                    {{ $order['status_payment'] == 'unpaid' ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                </span>
                            </td>
                            <td>{{ formatPrice($order['total_price']) }} đ</td>
                            <td>{{ $order['created_at'] }}</td>
                            <td>
                                <a href="{{ routeClient('account/order-detail/' . $order['id']) }}"
                                    class="btn btn-warning">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
@endsection
