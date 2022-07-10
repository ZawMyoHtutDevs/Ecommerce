
@extends('layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Customer List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Customer</span>
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


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Customers') }}</div>
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Order</th>
                            <th>Address Count</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers_data as $item)
                        <tr>
                            <td>                                
                                {{$item->name}}    
                            </td>
                            
                            <td>
                                {{$item->phone}}
                            </td>
                            <td>
                                {{count($item->orders)}}
                            </td>
                            <td>
                                {{count($item->addresses)}}
                            </td>
                            <td>
                                <span class="badge badge-default">
                                    {{ Carbon\Carbon::parse($item->updated_at)->format('d-M-Y') }}
                                </span>
                            </td>
                            <td>
                                
                                {{-- View --}}
                                <a href="{{route('customers.show', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded text-success">
                                    <i class="anticon anticon-eye"></i>
                                </a>
                                
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