@extends('layouts.app')
@section('style')


@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Accounts List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Accounts</span>
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
    <div class="col-md-5">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Add New Account') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('create.user') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="text-md-right">{{ __('Name') }}</label>
                        
                        
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="text-md-right">{{ __('Email') }}</label>
                        
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                        
                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                    
                    
                    <div class="form-group ">
                        <label for="password" class="text-md-right">{{ __('Password') }}</label>
                        
                        
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                    
                    <div class="form-group ">
                        <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                        
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        
                    </div>
                    
                    {{-- Role --}}
                    <div class="form-group mt-4">
                        <label for="inputState">User Role</label>
                        <select name="utype" id="inputState" class="form-control">
                            <option value="ADM" selected>Admin</option>
                            <option value="STA">Staff</option>
                            <option value="CUS">Customer</option>
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mt-4">
                        <label for="inputState">Bio</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group  mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Accounts') }}</div>
            
            <div class="card-body">
                <table class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                @switch($data->utype)
                                    @case('ADM')
                                    <span class="badge badge-danger">Admin</span>
                                        @break
                                    @case('STA')
                                    <span class="badge badge-warning">Staff</span>
                                        @break
                                    @default
                                    <span class="badge badge-info">Customer</span>
                                @endswitch
                                
                            </td>
                            <td>
                                
                                {{-- Edit and View --}}
                                <a href="{{route('users.detail', $data->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                    <i class="anticon anticon-edit"></i>
                                </a>
                                {{-- Delete User --}}
                                @if (Auth::user()->id != $data->id)
                                
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" type="submit" onclick="confirm('Are you sure you want to delete this item?'); event.preventDefault(); document.getElementById('delete-form{{$data->id}}').submit(); ">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                                <form id="delete-form{{$data->id}}" method="POST" action="{{route('delete.user', $data->id)}}" >
                                    @csrf
                                </form>
                                @endif
                                
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

@endsection