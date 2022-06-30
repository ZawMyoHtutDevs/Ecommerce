
@extends('layouts.app')
@section('style')

<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
<style>
    /* image gallery */
    .image_custom {
        width: 100%;
        height: 150px;
        background-size: cover;
        background-position: center;
    }
    .delete_image_overly{
        display: none;
        width: 100%;
        height: 150px;
        background-color: #8080804f;
        margin-top: -150px;
    }
</style>
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Update Product</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('products.index')}}">Products</a>
            <span class="breadcrumb-item active">Update Product</span>
        </nav>
    </div>
</div>
@endsection
@section('content')

{{-- Success message --}}
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

{{-- Error message --}}
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif


<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="row">
        {{-- Add Form --}}
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- name --}}
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text"
                        class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" autofocus required value="{{ $product->name ?? old('name') }}">
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="sku">SKU</label>
                            <input type="text"
                            class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" aria-describedby="sku" value="{{ $product->sku ?? old('sku') }}">
                            @error('sku')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputPassword4">Permalink</label>
                            <input type="text" name="permalink" id="permalink" class="form-control  @error('permalink') is-invalid @enderror" placeholder="apple" value="{{ $product->permalink ?? old('permalink') }}" autocomplete="permalink" >
                            @error('permalink')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <textarea name="description" class="form-control" id="description"
                        style="width: 100%;height:10em;">{!! $product->description ?? old('description') !!}</textarea>
                        
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
                                    <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price ?? old('price') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                                <input type="number" class="form-control @error('quanitity') is-invalid @enderror" name="quanitity" id="quanitity" aria-describedby="quanitity" value="{{ $product->inventory->quanitity ?? old('quanitity') }}">
                                @error('quanitity')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inv_status">Product's Status</label>
                                <select name="inv_status" id="inv_status" class="form-control">
                                    <option value="{{$product->inventory->status}}" checked>{{$product->inventory->status}}</option>
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
            <div class="card mt-3">
                <div class="card-body">
                    <h3>Add New Gallery Image</h3>
                    <div class="form-group">
                        <input type="file" class="form-control-file @error('gallery_image') is-invalid @enderror" name="gallery_image[]" id="gallery_image" multiple>
    
                        @error('gallery_image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                </div>
            </div>


            <div class="card mt-3">
                <div class="card-body">
    
                    <h5>Gallery List</h5>
    
                    <input type="hidden" name="delete_gallery_images" id="delete_gallery_images">
    
                    <div class="row">
                        @foreach ($product->images as $data)
                        <div class="col-md-4 mb-4">
                            <div class="image_custom shadow"  style="background-image: url({{ asset('images/products/'.$data->image) }});">
                            <span class="badge badge-danger float-right" id="image{{$data->id}}" onclick="del_image('{{$data->image}}', '{{$data->id}}')">X</span>
                            </div>
    
                            <div class="delete_image_overly text-center" id="image_over{{$data->id}}">
                                <span class="btn btn-info mt-5" onclick="restore_image('{{$data->id}}')">Restore</span>
                            </div>
                        </div> 
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
            {{-- Product Detail --}}
            <div class="card mt-3">
                <div class="card-body">
                    
                    <h5>Product's Full Details</h5>
                    
                    <div class="form-group">
                        <textarea name="detail" class="form-control" id="detail"
                        style="width: 100%;height:10em;">{!! $product->detail ?? old('detail') !!}</textarea>
                        
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
                            
                            <option value="{{$product->category->id}}" selected>{{$product->category->name}}</option>
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
                        @if ($product->asset != '')
                        <img src="{{ asset('/images/products/'.$product->asset) }} " class="img-fluid shadow" alt="{{$product->name}}">                            
                        @endif

                        <input type="file" class="mt-2 form-control-file @error('asset') is-invalid    @enderror" name="asset" id="asset" value="{{ old('asset') }}">
                        @error('asset')
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

    window.onload = function() {   
        document.getElementById('delete_gallery_images').value = '';
    }


    var options = []; 

    function del_image(image, id){
        document.getElementById('image'+id).style.display = "none";
        document.getElementById('image_over'+id).style.display = "block";

        options.push(id);
        document.getElementById('delete_gallery_images').value = options.toString();
        
    }

    function restore_image(id){
        document.getElementById('image'+id).style.display = "block";
        document.getElementById('image_over'+id).style.display = "none";

        
        for( var i = 0; i < options.length; i++){ 
    
            if ( options[i] === id) { 

                options.splice(i, 1); 
            }

        }
        document.getElementById('delete_gallery_images').value = options.toString();
    }

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