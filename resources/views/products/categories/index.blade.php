@extends('layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

<style>
    #data-table_filter input{
        max-width: 200px !important;
    }
</style>
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

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Add New Category') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Permalink</label>
                        <input type="text" name="permalink" id="permalink" class="form-control  @error('permalink') is-invalid @enderror" placeholder="apple" value="{{ old('permalink') }}" autocomplete="permalink" >
                        <small id="helpId" class="form-text text-muted">အင်္ဂလိပ်လို ထည့်သွင်းပေးရန်</small>
                        @error('permalink')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" placeholder="apple" value="{{ old('asset') }}" autocomplete="asset" >
                        @error('asset')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    {{-- Parent Category --}}
                    <div class="form-group mt-4">
                        <label for="inputState">Parent Category</label>
                        <select name="parent_id" id="inputState" class="form-control">
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
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror"  value="{{ old('description') }}" autocomplete="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    
                    {{-- Order --}}
                    <div class="form-group">
                        <label for="">Order</label>
                        <input type="number" name="order" id="order" class="form-control  @error('order') is-invalid @enderror" value="{{ old('order') }}" autocomplete="order" >
                        @error('order')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Categories') }}</div>
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories_data)
                            @foreach($categories_data as $item)
                            <?php $dash=''; ?>
                            <tr>
                                <td>
                                    <img class="img-fluid rounded shadow" src="{{ url('images/products/categories/'.$item->asset) }}" style="max-width: 60px" alt="">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{-- Products Count --}}
                                    {{$item->products->count()}}
                                </td>
                                <td>
                                    
                                    {{-- Edit and View --}}
                                    <a href="{{route('categories.edit', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                    
                                    
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                    <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('categories.destroy', $item->id)}}" >
                                        @csrf @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                            @if(count($item->subcategory))
                            @include('products.categories.subcategorieslist',['subcategories' => $item->subcategory])
                            @endif
                            @endforeach
                        @endif
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- page js -->
<script src="{{ asset('backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    

$('#data-table').DataTable();


</script>
@endsection
