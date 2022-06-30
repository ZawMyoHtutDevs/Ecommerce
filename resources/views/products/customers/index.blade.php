
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
            <div class="card-header mt-3 h3">{{ __('Product') }}</div>
            
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
                                0
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                <span class="badge badge-default">
                                    {{ Carbon\Carbon::parse($item->updated_at)->format('d-M-Y') }}
                                </span>
                            </td>
                            <td>
                                
                                {{-- Edit and View --}}
                                <a href="{{route('products.edit', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                    <i class="anticon anticon-edit"></i>
                                </a>
                                

                                <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                                <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('products.destroy', $item->id)}}" >
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