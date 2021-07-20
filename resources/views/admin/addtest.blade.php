@extends('layouts.master')

@section('content')
                     <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Covid19-Testing</h1>
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
                    <form name="newtesting" method="post" action="{{url('/addtest/send')}}">
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="col-lg-6">

                           <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Testing Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>User Id</label>
                                        <select class="form-select" id="uid" name="uid">
                                            <option value="">Select</option> 
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Test Type</label>
                                        <select class="form-control" id="testtype" name="testtype">
                                            <option value="">Select</option> 
                                            <option value="Antigen">Antigen</option>  
                                            <option value="RT-PCR">RT-PCR</option>
                                            <option value="CB-NAAT">CB-NAAT</option>    
                                        </select>
                                     </div>

                                    <div class="form-group">
                                        <label>Time Slot for Test</label>
                                        <input type="datetime-local" class="form-control" id="timeslot" name="timeslot" class="form-control">                                        
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="Orderno" value="{{ mt_rand(100000, 999999)}}" name="Orderno" placeholder="OrderNo">                  
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" id="submit">                           
                                    </div>

                                </div>
                            </div>
                       

                        </div>

                    </div>
</form>

@endsection
