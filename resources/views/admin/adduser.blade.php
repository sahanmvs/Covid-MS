@extends('layouts.master')

@section('content')
 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">Add User</h1>
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
 <form method="POST" action="{{url('/adduser/send')}}">
    {{ csrf_field() }}
    <div class="col-md-9">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                            <div class="form-group">
                                <label>User Name</label>
                                    <input type="text" class="form-control" id="username" name="username"  placeholder="User name" >
                             </div>
                             <div class="form-group">
                                <label>Email</label>
                                    <input type="text" class="form-control" id="email" name="email"  placeholder="Email">
                             </div>
                            <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Mobile number">
                                    <span id="mobile-availability-status" style="font-size:12px;"></span>
                            </div>
                            <!-- <div class="form-group">
                                    <label>DOB</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required="true">
                            </div> -->
                            <div class="form-group">
                                    <label>NIC Number</label>
                                    <input type="text" class="form-control" id="NIC" name="NIC" placeholder="Identity card Number">
                            </div>
                            
                            <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address"  placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" id="submit">                           
                             </div>
                </div>
        </div>
    </div>
 </form>

@endsection