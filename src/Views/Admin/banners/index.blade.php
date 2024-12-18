@extends('layouts.master')
@section('title', 'Banners')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Banners</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Categories</a></li> --}}
                        <li class="breadcrumb-item active">Banners</li>
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
                                <a href="{{ routeAdmin('banners/create') }}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2 addCustomers-modal">
                                    <i class="mdi mdi-plus me-1"></i>
                                    New Banner
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
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($banners as $banner)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $banner['id'] }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-{{ $banner['id'] }}"> <label
                                                    class="form-check-label"
                                                    for="customerlistcheck-{{ $banner['id'] }}"></label> </div>
                                        </td>

                                        <td>

                                            @if($banner['image'] && file_exists($banner['image']))
                                                <img src="{{ getImage($banner['image']) }}" alt="" width="50px" height="50px">
                                            @endif
                                        </td>

                                        <td>
                                            {{ $banner['created_at'] }}
                                        </td>

                                        <td>
                                            {{ $banner['updated_at'] }}
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <a href="{{ routeAdmin('banners/' . $banner['id'] . '/edit') }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ routeAdmin('banners/' . $banner['id']) }}"
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

                                {{-- @foreach ($categories as $category)
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            <div class="d-none">{{ $category['id'] }}</div>
                                            <div class="form-check font-size-16"> <input class="form-check-input"
                                                    type="checkbox" id="customerlistcheck-{{ $category['id'] }}"> <label
                                                    class="form-check-label"
                                                    for="customerlistcheck-{{ $category['id'] }}"></label> </div>
                                        </td>

                                        <td>
                                            {{ $category['name'] }}
                                        </td>

                                        <td>
                                            <span
                                                class="badge font-size-12 p-2 {{ $category['status'] ? 'bg-success' : 'bg-danger' }}">
                                                {{ $category['status'] ? 'public' : 'pending' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $category['created_at'] }}
                                        </td>

                                        <td>
                                            {{ $category['updated_at'] }}
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <a href="{{ routeAdmin('categories/' . $category['id'] . '/edit') }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ routeAdmin('categories/' . $category['id']) }}"
                                                            class="dropdown-item edit-list">
                                                            <i class="fa-regular fa-eye font-size-16 text-warning me-1"
                                                                style="color: #FFD43B;"></i>
                                                            Show
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ routeAdmin('categories/' . $category['id'] . '/delete') }}"
                                                            method="POST" id="category-form-delete-{{ $category['id'] }}">
                                                            @csrf
                                                            @method('DELETE')


                                                            <button type='button' class="dropdown-item remove-list"
                                                                onclick="handleDelete({{ $category['id'] }})">
                                                                <i
                                                                    class="mdi mdi-trash-can font-size-{{ $category['id'] }} text-danger me-1"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- @if ($page && $totalPage)
                        <div class="row">
                            @include('layouts.components.pagination', [
                                'page' => $page,
                                'totalPage' => $totalPage,
                                'url' => 'categories?page=',
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