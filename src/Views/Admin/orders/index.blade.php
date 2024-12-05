@extends('layouts.master')
@section('title', 'Orders')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Orders</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="searchTableList" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive min-vh-100">
                        <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>UserName</th>
                                    <th>Phone</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $order['o_id'] }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-{{ $order['o_id'] }}"> <label
                                                    class="form-check-label"
                                                    for="customerlistcheck-{{ $order['o_order_code'] }}"></label> </div>
                                        </td>
                                        <td>
                                            {{ $order['o_user_name'] }}
                                        </td>
                                        <td>
                                            {{-- <span
                                            class="badge font-size-12 p-2 {{ $category['status'] ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category['status'] ? 'public' : 'pending' }}
                                        </span> --}}
                                            {{ $order['o_user_phone'] }}
                                        </td>
                                        <td>
                                            {{ $order['oi_count_record'] }}
                                        </td>
                                        <td>
                                            <span style="color: #fff"
                                                class="p-2 badge {{ matchStatusOrderClass($order['o_status_order']) }}">
                                                {{ matchStatusOrder($order['o_status_order']) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="p-2 badge {{ $order['o_status_payment'] == 'unpaid' ? 'bg-danger' : 'bg-success' }}"
                                                style="color: #fff">
                                                {{ $order['o_status_payment'] == 'unpaid' ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <a href="{{ routeAdmin('orders/' . $order['o_id']) }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="fa-regular fa-eye font-size-16 text-warning me-1"
                                                                style="color: #FFD43B;"></i>
                                                            Show
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @if ($page && $totalPage)
                        <div class="row">
                            @include('layouts.components.pagination', [
                                'page' => $page,
                                'totalPage' => $totalPage,
                                'url' => "categories?page="
                            ])
                        </div>
                    @endif --}}
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
{{-- @section('script')
    <script src="{{ asset('js/categories/index.js') }}"></script>
@endsection --}}