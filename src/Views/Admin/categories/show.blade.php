@extends('layouts.master')
@section('title')
Show Category: {{ $category['name'] }}
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Category: {{ $category['name'] }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ routeAdmin('categories') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $category['name'] }}</li>
                </ol>
            </div>
        </div>


        <section>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Name</label>
                                <input disabled id="projectname-input" name="name" type="text" class="form-control"
                                    placeholder="Enter category name..." value="{{ $category['name'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="projectname-input" class="form-label">Description</label>
                                <textarea disabled name="description" type="text" class="form-control"
                                    placeholder="Enter category description..." required>
                                    {{ $category['description'] }}
                            </textarea>
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
                                    <label class="form-check-label">Status</label>
                                    <input disabled class="form-check-input" type="checkbox" {{ $category['status'] ? 'checked' : '' }} name="status">
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
            </form>

    </div>
</div>

@endsection