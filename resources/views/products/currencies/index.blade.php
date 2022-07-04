
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
    <h2 class="header-title">Currency List</h2>
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
{{-- Success message --}}
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
            <div class="card-header mt-3 h3">{{ __('Add New Currency') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('currencies.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Currency Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Myanmar" value="{{ old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Currency Code</label>
                        <input type="text" name="code" id="code" class="form-control  @error('code') is-invalid @enderror" placeholder="MMK" value="{{ old('code') }}" autocomplete="code" >
                        <small id="helpId" class="form-text text-muted">အင်္ဂလိပ်လို ထည့်သွင်းပေးရန်</small>
                        @error('code')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Flag</label>
                        <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" value="{{ old('asset') }}" autocomplete="asset" >
                        @error('asset')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <div class="switch m-r-10">
                            <input type="checkbox" name="status" id="switch-2">
                            <label for="switch-2"></label>
                        </div>
                        <label>Set Default Currency</label>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Currencies') }}</div>
            
            <div class="card-body">
                <table id="data-table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Flag</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($currencies_data as $item)
                            <tr>
                                <td>
                                    <img class="img-fluid rounded shadow" src="{{ url('images/products/currencies/'.$item->asset) }}" style="max-width: 40px" alt="">
                                </td>
                                <td>
                                    @if ($item->status == '1')
                                    <span class="badge badge-danger">Default Currency</span>
                                    @endif
                                    <br>

                                    {{$item->name}}
                                </td>
                                <td>
                                    {{$item->code}}
                                </td>
                                <td>
                                    
                                    {{-- Edit and View --}}
                                    <a href="{{route('currencies.edit', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                    
                                    
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                    <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('currencies.destroy', $item->id)}}" >
                                        @csrf @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
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