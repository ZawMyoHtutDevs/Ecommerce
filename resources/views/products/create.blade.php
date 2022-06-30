
@extends('layouts.app')
@section('style')

<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Add New Product</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('products.index')}}">Products</a>
            <span class="breadcrumb-item active">Add Product</span>
        </nav>
    </div>
</div>
@endsection
@section('content')



<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
<div class="row">
    {{-- Add Form --}}
    <div class="col-sm-12 col-md-8">
        <div class="card">
            <div class="card-body">
                {{-- name --}}
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" autofocus required value="{{ old('name') }}">
                    
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sku">SKU</label>
                        <input type="text"
                        class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" aria-describedby="sku" value="{{ old('sku') }}">
                        @error('sku')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputPassword4">Permalink</label>
                        <input type="text" name="permalink" id="permalink" class="form-control  @error('permalink') is-invalid @enderror" placeholder="apple" value="{{ old('permalink') }}" autocomplete="permalink" >
                        @error('permalink')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Product Description</label>
                    <textarea name="description" class="form-control" id="description"
                    style="width: 100%;height:10em;">{!! old('name') !!}</textarea>
                    
                </div>
            </div>
        </div>
        {{-- card --}}
        
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        
                        {{-- normal_price --}}
                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="input-group mb-3">
                                <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{currency()->code}}</span>
                                </div>
                            </div>
                            
                            @error('price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            
                            
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>

        {{-- Product inventory --}}
        <div class="card mt-3">
            <div class="card-body">
                
                <h5>Product's Inventory</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quanitity">Product's Quantity</label>
                            <input type="number" class="form-control @error('quanitity') is-invalid @enderror" name="quanitity" id="quanitity" aria-describedby="quanitity" required value="{{ old('price') }}">
                            @error('quanitity')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inv_status">Product's Status</label>
                            <select name="inv_status" id="inv_status" class="form-control">
                                <option value="In Stock">In Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                                <option value="Backorder">Backorder</option>
                            </select>
                            @error('inv_status')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Product Detail --}}
        <div class="card mt-3">
            <div class="card-body">
                
                <h5>Product's Full Details</h5>
                
                <div class="form-group">
                    <textarea name="detail" class="form-control" id="detail"
                    style="width: 100%;height:10em;">{!! old('name') !!}</textarea>
                    
                </div>
                
            </div>
        </div>
        
        
    </div>
    
    <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
                
                <button type="submit" class="btn btn-primary btn-block">Save</button>
                
                {{-- Is Active --}}
                <div class="form-group d-flex align-items-center mt-4">
                    <div class="switch m-r-10">
                        <input type="checkbox" name="status" id="status" checked>
                        <label for="status"></label>
                    </div>
                    <label>Status</label>
                </div>
                
                <hr>
                <h5>Select Category</h5>
                <div class="mb-4" style="overflow-y: scroll; max-height: 300px;">
                    
                    <select name="category_id" id="inputState" class="form-control">
                        <option value="" selected>select category</option>
                        
                        @if($categories_data)
                        @foreach($categories_data as $category)
                        <?php $dash=''; ?>
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @if(count($category->subcategory))
                        @include('products.categories.subcategories',['subcategories' => $category->subcategory])
                        @endif
                        @endforeach
                        @endif
                        
                    </select>
                    @error('parent_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                
                <hr>
                <h5>Add Main Image</h5>
                <div class="form-group">
                    <input type="file" class="form-control-file @error('asset') is-invalid    @enderror" name="asset" id="asset" value="{{ old('asset') }}">
                    @error('asset')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                
                
                <hr>
                <h5>Add Gallery Images</h5>
                <div class="form-group">
                    <input type="file" class="form-control-file @error('gallery_image') is-invalid @enderror" name="gallery_image[]" id="gallery_image" multiple value="{{ old('gallery_image') }}">
                    
                    @error('gallery_image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end row --}}
</form>


@endsection

@section('script')


<script>    
    
    
    CKEDITOR.replace( 'description',{
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } 
    );
    CKEDITOR.replace( 'detail',{
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } 
    );
    
    
</script>
@endsection