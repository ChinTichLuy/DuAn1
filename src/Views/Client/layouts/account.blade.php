@extends('layouts.master')
@section('title', 'Account Settings')
@section('content')

    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <h1>
                @if (isset($_SESSION['user']))
                    {{ $_SESSION['user']['name'] }}
                @endif
            </h1>
        </div>
    </div>


    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                <h2 class="text-uppercase">My Account</h2>
                <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ routeClient('account/orders') }}">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                            aria-controls="address" aria-selected="false">Addresses</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                            aria-controls="edit" aria-selected="false">Account
                            details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shop-address-tab" data-toggle="tab" href="#shipping" role="tab"
                            aria-controls="edit" aria-selected="false">Shopping Addres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Wishlist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account-logout" onclick="handleLogout()">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div>
                    @yield('view-tab')
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
@endsection

@section('script')

    <script>
        const logout = document.querySelector('#account-logout');

        const handleLogout = () => {
            if (confirm('Bạn có chắc muốn đăng xuất')) {
                logout.href = `${BASE_URL}auth/logout`;
            }
        }
    </script>

@endsection
