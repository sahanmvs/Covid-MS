@extends('layouts.master')

@section('content')
 <!-- Page Heading -->
 <div class="row">
    <h1 class="h3 mb-2 text-gray-800">Admin Profile</h1>
    <nav class="ml-auto" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
        </ol>
      </nav>
    </div>
                           @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>    
                            @endif
                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
 <form method="POST" action="/editUser/update">
    {{ csrf_field() }}
    <div class="col-md-9">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                            <input type="hidden" class="form-control" id="name" name="id" value="{{ $admin->id }}" >
                            <div class="form-group">
                                <label>User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                             </div>
                             <div class="form-group">
                                <label>Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $admin->email }}" readonly>
                             </div>
                             <div class="form-group">
                                <label>Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $admin->address }}">
                             </div>
                            <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" id="Mobile" name="mobile" value="{{ $admin->phone }}"">
                                    <span id="mobile-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <label>NIC</label>
                                <input type="text" class="form-control" id="NIC" name="NIC" value="{{ $admin->NIC }}">
                                <span id="mobile-availability-status" style="font-size:12px;"></span>
                        </div>
                            <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" id="submit">                           
                             </div>
                </div>
        </div>
    </div>
 </form>

@endsection