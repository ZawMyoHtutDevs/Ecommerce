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
            <span class="breadcrumb-item active">Currencies</span>
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
            <div class="card-header mt-3 h3">{{ __('Update Currency') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('currencies.update', $currency_data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ $currency_data->name ?? old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" name="code" id="code" class="form-control  @error('code') is-invalid @enderror" placeholder="apple" value="{{ $currency_data->code ?? old('code') }}" autocomplete="code" >
                        <small id="helpId" class="form-text text-muted">အင်္ဂလိပ်လို ထည့်သွင်းပေးရန်</small>
                        @error('code')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Update Flag</label>
                        
                        <img class="img-fluid rounded shadow" src="{{ url('images/products/categories/'.$currency_data->asset) }}" style="max-width: 150px" alt="">
                        
                        <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" placeholder="apple" value="{{ old('asset') }}" autocomplete="asset" >
                        @error('asset')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group d-flex align-items-center">
                        <div class="switch m-r-10">
                            <input type="checkbox" name="status" id="switch-2"
                            @if ($currency_data->status == '1')
                                checked
                            @endif
                            >
                            <label for="switch-2"></label>
                        </div>
                        <label>Set Default Currency</label>
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