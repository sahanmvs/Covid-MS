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
 <form method="POST" action="{{url('/addphlebotomist/send')}}">
    {{ csrf_field() }}
    <div class="col-md-9">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                            <div class="form-group">
                                <label>Phlebotomist Name</label>
                                    <input type="text" class="form-control" id="username" name="name"  placeholder="Name" >
                             </div>
                             <div class="form-group">
                                <label>EmpID</label>
                                    <input type="text" class="form-control" id="empid" name="empid"  placeholder="EmpID">
                             </div>
                            <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number">
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