@extends('layouts.master')
@section('title', 'User')

@section('style')
    <style>
        #projectlogo-img {
            width: 6rem;
        }

        .h-screen {
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create User</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ routeAdmin('users') }}">User</a>
                        </li>
                        <li class="breadcrumb-item active">Create New</li>
                    </ol>
                </div>
            </div>


            <form action="{{ routeAdmin('users/store') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Avatar</label>

                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="position-absolute bottom-0 end-0">
                                                <label for="project-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Select Image">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                                            <i class='bx bxs-image-alt'></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input class="form-control d-none" value="" id="project-image-input"
                                                    type="file" accept="image/png, image/gif, image/jpeg" name="avatar"
                                                    onchange="previewImage(event)">
                                            </div>
                                            <div class="avatar-lg">
                                                <div class="avatar-title bg-light">
                                                    <img src id="projectlogo-img" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="projectname-input" class="form-label">Name</label>
                                            <input id="projectname-input" name="name" type="text" class="form-control"
                                                placeholder="Enter name..." value="{{ getOldValue('name') }}">
                                            <div class="text-danger fst-italic">
                                                {{ error('name') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="projectname-input" class="form-label">Email</label>
                                            <input id="projectname-input" name="email" type="text" class="form-control"
                                                placeholder="Enter email..." value="{{ getOldValue('email') }}">
                                            <div class="text-danger fst-italic">
                                                {{ error('email') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="projectname-input" class="form-label">Password</label>
                                            <input id="projectname-input" name="password" type="password"
                                                class="form-control" placeholder="Enter password..."
                                                value="{{ getOldValue('password') }}">
                                            <div class="text-danger fst-italic">
                                                {{ error('password') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="projectname-input" class="form-label">Phone</label>
                                            <input id="projectname-input" name="phone" type="text" class="form-control"
                                                placeholder="Enter phone..." value="{{ getOldValue('phone') }}">
                                            <div class="text-danger fst-italic">
                                                {{ error('phone') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Publish</h5>

                                <div class="mb-3">
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label">status</label>
                                        <input class="form-check-input" type="checkbox" value="1" checked
                                            name="is_active">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <select name="role" class="form-control">
                                        <option value="0">Member</option>
                                        <option value="1">Admin</option>
                                    </select>

                                    <div class="text-danger fst-italic">
                                        {{ error('role') }}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-8">
                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('js/users/create.js') }}"></script>
@endsection
