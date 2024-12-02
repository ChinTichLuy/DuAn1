@extends('layouts.master')
@section('title', 'Add New Tag')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create Color</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ routeAdmin('product-colors') }}">Colors</a>
                        </li>
                        <li class="breadcrumb-item active">Create New</li>
                    </ol>
                </div>
            </div>


            <form action="{{ routeAdmin('product-colors/store') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="projectname-input" class="form-label">Name</label>
                                    <input id="projectname-input" name="name" type="text" class="form-control"
                                        placeholder="Enter category name..." value="{{ getOldValue('name') }}">
                                    <div class="text-danger fst-italic">
                                        {{ error('name') }}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
