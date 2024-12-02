@extends('layouts.master')
@section('title', 'Create New Products')

@section('style')
<style>
    #projectlogo-img{
        width: 6rem;
    }
    .h-screen{
        height: 100%;
    }
</style>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create New Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ routeAdmin('products') }}">Products</a>
                                </li>
                                <li class="breadcrumb-item active">Create Product</li>
                            </ol>
                        </div>
                    </div>
            </div>   
        </div>

        <form id="form-create-product" action="{{ routeAdmin('products/store') }}" method="POST" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Ảnh Bìa</label>
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
                                                type="file" accept="image/png, image/gif, image/jpeg"
                                                name="product[thumb_image]" onchange="previewImage(event)">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light">
                                                <img src id="projectlogo-img" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-lable">Tên</label>
                                <input type="text" name="product[name]" class="form-control" placeholder="Enter product name..." value="">
                                <div class="text-danger fst-italic">{{ error('product[name]') }}</div>  
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label" >
                                            Price Regular
                                        </label>
                                        <input type="number" class="form-control" name="product[price_regular]" placeholder="Enter product price regular..." value="">
                                        <div class="text-danger fst-italic">{{ error('product[price_regular]') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="projectname-input" class="form-label" >
                                            Price Sale
                                        </label>
                                        <input type="number" class="form-control" name="product[price_sale]" placeholder="Enter product price sale..." value="">
                                        <div class="text-danger fst-italic">{{ error('product[price_sale]') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-lable">Mô tả</label>
                                <input type="text" name="product[description]" class="form-control" placeholder="Enter description..." value="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-lable">Content</label>
                                <input type="text" name="product[description]" class="form-control @error('product.content') is-invalid @enderror" placeholder="Enter Content..." value="">
                                @error('product.content')
                                <div class="text-danger fst-italic">*{{ $message }}</div>
                                    
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                            <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4" id="gallery_list">
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                id="gallery_default">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <h4>Biến Thể</h4>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="form-label">Color</span>
                                        <select id="select-color-product-multiple" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Select color ..." name="colors[]">
                                           
                                          
                                            @foreach ($colors as $color)
                                                <option value="{{ $color['id'] }}">{{ $color['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="table-product-variant-preview">
                        <div class="card-body">
                            <div class="card-title">Table Review</div>
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <input type="number" placeholder="Kho hàng" class="form-control"
                                        id="product-quantity-variant-all">
                                </div>
                                <div class="">
                                    <button id="apply-quantity-variant-all" type="button"
                                        class="btn btn-outline-danger">Áp Dụng Cho All</button>
                                </div>
                            </div>
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Price Regular</th>
                                        <th>Price Sale</th>
                                    </tr>
                                </thead>
                                <tbody id="render-tbody-product"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Publish</h5>
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" name="product[sku]" class="form-control" value="">
                                <div class="text-danger fst-italic">{{ error('product[sku]') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Tags</label>
                                <select id="select-tag-product-multiple" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Chose Tags" name="tags[]">
                                    
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag['id'] }}">
                                            {{ $tag['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- @error('tags')
                                    <div class="text-danger fst-italic">*{{ $message }}</div>
                                @enderrorb --}}
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Category
                                </label>
                                <select class="form-control select2-multiple" name="product[category_id]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                                $is = ['is_active', 'is_hot_deal', 'is_good_deal', 'is_new', 'is_show_home'];
                            @endphp
                            @foreach ($is as $item)
                                <div class="mb-3">
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label">{{ $item }}</label>
                                        <input class="form-check-input" value="1" type="checkbox"
                                            {{ $item === 'is_active' ? 'checked' : '' }}
                                            name="product[{{ $item }}]">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <div class="col-lg-8">

                    <div class="text-end mb-4">
                        <button class="btn btn-primary" id="btn-submit-form-create">Create</button>
                    </div>
                </div>
            </div>
        </form>
     
       
    </div>
   
@endsection
@section('script')
<script src="{{ asset('js/products/create.js') }}"></script>
@endsection