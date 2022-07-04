
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
    <h2 class="header-title">{{$customer->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('customers.index')}}">Customers</a>
            <span class="breadcrumb-item active">View Customer</span>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-md-flex align-items-center">
                            <div class="text-center text-sm-left ">
                                <div class="avatar avatar-image" style="width: 150px; height:150px">
                                    <img src="{{asset('backend/images/user.png')}}" alt="">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5">{{$customer->name}}</h2>
                                <p class="text-opacity font-size-13">
                                @switch($customer->utype)
                                    @case('ADM')
                                    <span class="badge badge-danger">Admin</span>
                                        @break
                                    @case('STA')
                                    <span class="badge badge-warning">Staff</span>
                                        @break
                                    @default
                                    <span class="badge badge-info">Customer</span>
                                @endswitch</p>
                                <p class="text-dark m-b-20">{{$customer->description}}</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="d-md-block d-none border-left col-1"></div>
                            <div class="col">
                                <ul class="list-unstyled m-t-10">
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                            <span>Email: </span> 
                                        </p>
                                        <p class="col font-weight-semibold"> {{$customer->email}}</p>
                                    </li>
                                    <li class="row">
                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                            <span>Phone: </span> 
                                        </p>
                                        <p class="col font-weight-semibold"> {{$customer->phone}}</p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            
            <div class="card-body">
                <table class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Address Name</th>
                            <th>Address Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($customer->addresses as $item)
                            <tr>
                                
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{$item->address_type}}
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-primary btn-rounded btn-tone" data-toggle="modal" data-target="#addressmodelId{{$item->id}}">
                                        <i class="anticon anticon-switcher"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Order List') }}</div>
            
            <div class="card-body">
                <table id="data-table" class="table table-inverse">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($customer->orders as $item)
                            <tr>
                                <td>
                                    {{$item->order_number}}
                                </td>
                                <td>
                                    {{$item->status}}
                                </td>
                                <td>
                                    {{$item->total}} {{currency()->code}}
                                </td>
                                <td>
                                    {{$item->payment->payment_type}}
                                </td>
                                <td>
                                    <span class="badge badge-default">
                                        {{ Carbon\Carbon::parse($item->updated_at)->format('d-M-Y') }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-primary btn-rounded btn-tone" data-toggle="modal" data-target="#modelId{{$item->id}}">
                                        <i class="anticon anticon-switcher"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>

{{-- order Modal --}}
@foreach($customer->orders as $item)
<!-- Modal -->
<div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$item->order_number}}
                    <span class="badge badge-default">
                    {{ Carbon\Carbon::parse($item->updated_at)->format('d-M-Y') }}
                    </span>
                    <span class="badge badge-pill badge-primary">
                        {{ $item->status }}
                    </span>
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->order_items as $data)
                            <tr>
                                <th scope="row">{{$data->product_name}}</th>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->discount_type ?? ''}}</td>
                                <td>{{$data->price}} {{currency()->code}}</td>
                            </tr>
                            @endforeach
                          
                            <tr>
                                <th scope="row" colspan="3">Total Price</th>
                                <td>{{$item->total}} {{currency()->code}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Payment</th>
                            <td>{{$item->payment->payment_type}}</td>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col" colspan="2">Note</th>
                            </tr>
                          
                            <tr>
                                <td colspan="2">{{$item->note}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- address modal --}}
@foreach($customer->addresses as $item)
<!-- Modal -->
<div class="modal fade" id="addressmodelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$item->name}}
                    <span class="badge badge-pill badge-primary">
                        {{ $item->address_type }}
                    </span>
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

                <form action="{{route('update.address', $item->id)}}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                      <label>Address Name</label>
                      <input type="text"
                        class="form-control" name="name" value="{{ $item->name }}">
                    </div>
                    <div class="form-group">
                      <label for="">Address Type</label>
                      <select class="form-control" name="address_type" style="text-transform:capitalize">
                        <option>{{$item->address_type}}</option>
                        <option>billing address</option>
                        <option>shipping address</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text"
                          class="form-control" name="country" value="{{ $item->country }}">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text"
                          class="form-control" name="city" value="{{ $item->city }}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text"
                          class="form-control" name="address" value="{{ $item->address }}">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('script')

<!-- page js -->
<script src="{{ asset('backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>

    $('#data-table').DataTable();

</script>
@endsection