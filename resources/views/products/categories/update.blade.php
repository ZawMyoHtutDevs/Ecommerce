@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Category List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('products.index')}}">Products</a>
            <span class="breadcrumb-item active">Categories</span>
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

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Update Category') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('categories.update', $category_data->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ $category_data->name ?? old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Permalink</label>
                        <input type="text" name="permalink" id="permalink" class="form-control  @error('permalink') is-invalid @enderror" placeholder="apple" value="{{ $category_data->permalink ?? old('permalink') }}" autocomplete="permalink" >
                        <small id="helpId" class="form-text text-muted">အင်္ဂလိပ်လို ထည့်သွင်းပေးရန်</small>
                        @error('permalink')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Update Image</label>
                        
                        <img class="img-fluid rounded shadow" src="{{ url('images/products/categories/'.$category_data->asset) }}" style="max-width: 150px" alt="">
                        
                        <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" placeholder="apple" value="{{ old('asset') }}" autocomplete="asset" >
                        @error('asset')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    {{-- Parent Category --}}
                    <div class="form-group mt-4">
                        <label for="inputState">Parent Category</label>
                        <select name="parent_id" id="inputState" class="form-control">
                            
                            @if ($category_data->parent)
                            <option value="{{$category_data->parent->id}}" selected>{{$category_data->parent->name}}</option>
                            @else
                            <option value="" selected>Select Category</option>
                            @endif


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
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">{{ $category_data->description ?? old('description') }}</textarea>
                    </div>
                    
                    {{-- Order --}}
                    <div class="form-group">
                        <label for="">Order</label>
                        <input type="number" name="order" id="order" class="form-control  @error('order') is-invalid @enderror" value="{{ $category_data->order ?? old('order') }}" autocomplete="order" >
                        @error('order')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection