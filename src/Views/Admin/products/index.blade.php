@extends('layouts.master')
@section('title', 'Products')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Products</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Products</li>
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
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ routeAdmin('products/create') }}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                    <i class="mdi mdi-plus me-1"></i>
                                    New Product
                                </a>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive min-vh-100">
                        <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Category</th>
                                    <th>Price_Regular</th>
                                    <th>Price_Sale</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $product['id'] }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-{{ $product['id'] }}"> <label
                                                    class="form-check-label"
                                                    for="customerlistcheck-{{ $product['id'] }}"></label> </div>
                                        </td>
                                        <td>
                                            <img src="{{ getImage($product['thumb_image']) }}" alt="{{ $product['name'] }}"
                                                width="50px" height="50px">
                                        </td>
                                        <td>
                                            {{ $product['name'] }}
                                        </td>

                                        <td>
                                            {{ $product['sku'] }}
                                        </td>

                                        <td>
                                            1
                                        </td>

                                        <td>
                                            {{ $product['price_regular'] }}
                                        </td>

                                        <td>
                                            {{ $product['price_sale'] }}
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <a href="{{ routeAdmin('products/' . $product['id'] . '/edit') }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ routeAdmin('products/' . $product['id']) }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="fa-regular fa-eye font-size-16 text-warning me-1"
                                                                style="color: #FFD43B;"></i>
                                                            Show
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ routeAdmin('products/' . $product['id'] . '/delete') }}"
                                                            method="POST" id="product-form-delete-{{ $product['id'] }}">
                                                            @csrf
                                                            @method('DELETE')


                                                            <button type='button' class="dropdown-item remove-list"
                                                                onclick="handleDelete({{ $product['id'] }})">
                                                                <i
                                                                    class="mdi mdi-trash-can font-size-{{ $product['id'] }} text-danger me-1"></i>
                                                                Delete
                                                            </button>
                                                        </form>
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

@section('script')
    <script src="{{ asset('js/products/index.js') }}"></script>
@endsection
