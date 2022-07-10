
@extends('layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Update Discount</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('discounts.index')}}">Discounts</a>
            <span class="breadcrumb-item active">Update Discount</span>
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


<form method="POST" action="{{ route('discounts.update', $discount->id) }}" >
    @csrf @method('PUT')
    <div class="row">
        {{-- Add Form --}}
        <div class="col-sm-12 col-md-6">
            
            <div class="card">
                <div class="card-body">

                    <h4><span class="badge badge-pill badge-success" style="text-transform:capitalize;" >{{$discount->status}}</span></h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Discount Name</label>
                                <input type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" autofocus required value="{{ $discount->name ?? old('name') }}">
                                
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5">{{ $discount->description ?? old('description') }}</textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                
                                {{-- Status --}}
                                <input type="hidden" class="form-control" name="status"  aria-describedby="status" value="{{$discount->status}}">
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
            
        </div>
        
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                    
                    @switch($discount->status)
                        @case('fit price')
                        <div class="fit_product" id="fit_product" >
                            <hr>
                            <h5>Select Product</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="fit_product_id">
                                    @foreach($discount->products as $data)
                                    <option value="{{$data->id}}">{{$data->name}}_{{$data->price}} {{currency()->code}}</option>
                                    @endforeach
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}">{{$data->name}}_{{$data->price}} {{currency()->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- discount_price --}}
                            
                            <div class="form-group">
                                <label for="discount_price">Price</label>
                                
                                <div class="input-group mb-3">
                                    <input name="discount_price" type="text" class="form-control @error('discount_price') is-invalid @enderror" value="{{ $discount->discount_price ?? old('discount_price') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">{{currency()->code}}</span>
                                    </div>
                                </div>
                                
                                @error('discount_price')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                
                            </div>
                        </div>
                            @break
                        @case('percentage price')
                        <div class="percent_product" id="percent_product">
                            <hr>
                            <h5>Select Products</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="percentage_product_id[]"  multiple="multiple">
                                    @foreach($discount->products as $data)
                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                    @endforeach
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}" >{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Discount Percent --}}
                            <div class="form-group">
                                <label for="discount_percent">Percent</label>
                                <input type="number" min="0" max="100"
                                class="form-control @error('discount_percent') is-invalid @enderror" name="discount_percent" id="discount_percent" aria-describedby="helpId" value="{{ $discount->discount_percent ?? old('discount_percent') }}">
                                
                                @error('discount_price')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                
                            </div>
                        </div>
                            @break
                        @case('free gif')
                        <div class="gif_product" id="gif_product">
                            <hr>
                            <h5>Select Product</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="gif_single_product_id">
                                    @foreach($discount->products as $data)
                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                    @endforeach
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('gif_single_product_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <hr>
                            <h5>Gif Products</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="gif_products_id[]"  multiple="multiple">
    
                                    {{-- change string to array --}}
                                    <?php
                                        if (count(explode(" - ", $discount->gif_products_id))) {
                                            $gif_product = [$discount->gif_products_id];
                                        }else{
                                            $gif_product = explode("", $discount->gif_products_id);
                                        }
                                    ?>
    
                                    {{-- Product Data --}}
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}"
                                        {{-- Check selected Product --}}
                                        @foreach($gif_product as $value)
                                            @if ($value == $data->id)
                                                selected
                                            @endif
                                        @endforeach
                                        >{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('gif_products_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                            @break
                        @case('free shipping')
                        <div class="free_ship_product" id="free_ship_product" style="display: none;">
                            <hr>
                            <h5>Free Shipping Products</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="free_ship_products_id[]"  multiple="multiple">
                                    @foreach($discount->products as $data)
                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                    @endforeach
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                            @break
                        @case('buy one get one')
                        <div class="bogo" id="bogo" style="display: none;">
                            <hr>
                            <h5>Buy One Get One</h5>
                            <div class="m-b-15" >
                                <select class="select2" name="get_one_product_id">
                                    @foreach($discount->products as $data)
                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                    @endforeach
                                    @foreach($products_data as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                            @break
                        @default
                        <div class="alert alert-danger" role="alert">
                            <strong>NO Discount Type</strong>
                        </div>
                    @endswitch
                    
                </div>
            </div>
        </div>
    </div>
    {{-- end row --}}
</form>


@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>

<script>
    $('.select2').select2();
    
    window.onload = function() {  
        switch($("#select_discount_type option:selected").val()) {
            case 'fit price':
            $('#fit_product').show();
            break;
            case 'percentage price':
            $('#percent_product').show();
            break;
            case 'free gif':
            $('#gif_product').show();
            break;
            case 'free shipping':
            $('#free_ship_product').show();
            break;
            default:
            $('#bogo').show();
        }
    }
    
    $('#select_discount_type').on('change', function () {
        switch($("#select_discount_type option:selected").val()) {
            case 'fit price':
            $('#fit_product').show();
            $('#percent_product').hide();
            $('#gif_product').hide();
            $('#free_ship_product').hide();
            $('#bogo').hide();
            break;
            case 'percentage price':
            $('#fit_product').hide();
            $('#percent_product').show();
            $('#gif_product').hide();
            $('#free_ship_product').hide();
            $('#bogo').hide();
            break;
            case 'free gif':
            $('#fit_product').hide();
            $('#percent_product').hide();
            $('#gif_product').show();
            $('#free_ship_product').hide();
            $('#bogo').hide();
            break;
            case 'free shipping':
            $('#fit_product').hide();
            $('#percent_product').hide();
            $('#gif_product').hide();
            $('#free_ship_product').show();
            $('#bogo').hide();
            break;
            default:
            $('#fit_product').hide();
            $('#percent_product').hide();
            $('#gif_product').hide();
            $('#free_ship_product').hide();
            $('#bogo').show();
        }
    });
    
    // fit_product
    // percent_product
    // gif_product
    // free_ship_product
    
</script>
@endsection