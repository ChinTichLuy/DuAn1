@extends('layouts.master')
@section('title', 'Comments')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Comments</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Comments</li>
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
                        {{-- <div class="col-sm-8">
                            <div class="text-sm-end">
                                <a href="{{ routeAdmin('categories/create') }}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                    <i class="mdi mdi-plus me-1"></i>
                                    New Category
                                </a>
                            </div>
                        </div><!-- end col--> --}}
                    </div>
                    <div class="table-responsive min-vh-100">
                        <table class="table align-middle table-nowrap dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Rating</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $comment['c_id'] }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-{{ $comment['c_id'] }}"> <label
                                                    class="form-check-label"
                                                    for="customerlistcheck-{{ $comment['c_id'] }}"></label> </div>
                                        </td>
                                        <td>

                                            {{ limitText($comment['u_name'], 10) }}
                                        </td>
                                        <td>
                                            {{ limitText($comment['p_name']) }}
                                        </td>
                                        <td>
                                            {{ $comment['c_rating'] }}
                                        </td>
                                        <td>
                                            {{ $comment['c_created_at'] }}
                                        </td>
                                        <td>
                                            {{ $comment['c_updated_at'] }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    {{-- <li>
                                                        <a href="{{ routeAdmin('categories/' . $category['id'] . '/edit') }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                            Edit
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <a href="{{ routeAdmin('comments/' . $comment['c_id']) }}"
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
                    @if ($page && $totalPage)
                        <div class="row">
                            @include('layouts.components.pagination', [
                                'page' => $page,
                                'totalPage' => $totalPage,
                                'url' => 'comments?page=',
                            ])
                        </div>
                    @endif
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
