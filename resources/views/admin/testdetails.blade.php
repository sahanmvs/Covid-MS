@extends('layouts.master')
@section('content')
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Test Details #{{$testrecord->OrderNo}}</h1>
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
            <div class="row">
                     
                <!-- personal information --->
                <div class="col-lg-6">
                     
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                             <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                            </div>

                     <div class="card-body">
                        
                      <table class="table table-bordered"  width="100%" cellspacing="0">
                       
                         <tr>
                         <th>Full Name</th> 
                         <td>{{ $testrecord->user->name }}</td>
                         </tr>
                     
                          <tr>
                         <th>Mobile Number</th> 
                         <td>{{ $testrecord->PatientMobile}}</td>
                         </tr>
                     
                          <tr>
                         <th>Identity No.</th> 
                         <td>{{ $testrecord->user->NIC}}</td>
                         </tr>                                                           
                     
                          <tr>
                         <th>Full Address</th> 
                         <td>{{ $testrecord->user->address }}</td>
                         </tr>
                    
                     
                         <tr>
                         <th>Profile Reg Date</th> 
                         <td>{{ $testrecord->RegistrationDate }}</td>
                         </tr>
                         
                      </table>       
                                                         
                        </div>
                    </div>
                </div>

                <!-- Test Information --->
                <div class="col-lg-6">

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Test Information</h6>
                        </div>
                        
                        <div class="card-body">

                            <table class="table table-bordered"  width="100%" cellspacing="0">
                            <tr>
                            <th>Order Number</th> 
                            <td>{{$testrecord->OrderNo}}</td>
                            </tr>

                            <tr>
                            <th>Test Type</th> 
                            <td>{{$testrecord->TestType}}</td>
                            </tr>


                            <tr>
                            <th>Time Slot</th> 
                            <td>{{$testrecord->TestTimeSlot}}</td>
                            </tr>

                            <tr>
                                <th>Report Status</th>
                                   @if($testrecord->ReportStaus == '') 
                                        <td>Not processed yet</td>
                                   @else
                                        <td>{{$testrecord->ReportStaus}}</td>
                                   @endif    
                            </tr>

                            @if($testrecord->AssignedEmpID != '')
                            <tr>
                                <th>Assign To</th> 
                                <td>{{$testrecord->AssignedEmpName}}</td>
                            </tr>
                            <tr>
                                <th>Assigned Time</th> 
                                <td>{{$testrecord->AssignedTime}}</td>
                            </tr>
                            @endif

                            @if($testrecord->FinalReport != '')
                            <tr>
                                <th>Report</th>
                                <td><a href="{{ url('/download', $testrecord->FinalReport) }}">Download</a></td>
                            </tr>
                            @endif

                            </table>
                            
                            @if($testrecord->AssignedEmpID == '')
                                <div class="form-group">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#assignto">Assign To</button>
                                </div>
                            @else
                                
                                @if($testrecord->ReportStaus=='Assigned' ||  $testrecord->ReportStaus=='On the Way for Collection' || $testrecord->ReportStaus=='Sample Collected' || $testrecord->ReportStaus=='Sent to Lab')
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#takeaction">Take Action</button>
                                @endif
                            @endif

                        </div>
                    </div>

                </div>

</div>

<!-- Assign Modal -->
<div id="assignto" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left">Assign to</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ url('testdetails/assignto') }}">
                {{ csrf_field() }}
                    <p>  <select class="form-control" name="assignto" required="true">
                    <option value="">Select Phlebotomist</option>
                    @foreach($phlebotomist as $ph)
                        <option value="{{ $ph->id }}">{{ $ph->name }}</option>
                    @endforeach
                    </select></p>
                    <p>
            <input type="hidden" name="testrecordID" value="{{ $testrecord->id }}" />
            <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" id="submit">   </p> 
            </form>
        </div>
       
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
</div>

<!-- Take Action Modal -->
<div id="takeaction" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left">Take Action</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ url('/testdetails/update') }}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <p> <select class="form-control" name="status" id="status" required="true">
                        <option value="">Select Action</option>
                
                        @if($testrecord->ReportStaus == 'Assigned')
                        <option value="On the Way for Collection">On the Way for Collection</option>
                        <option value="Sample Collected">Sample Collected</option>
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>

                        @elseif($testrecord->ReportStaus == 'On the Way for Collection')
                        <option value="Sample Collected">Sample Collected</option>
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>
                        
                        @elseif($testrecord->ReportStaus == 'Sample Collected')
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>
                        
                        @elseif($testrecord->ReportStaus == 'Sent to Lab')
                        <option value="Delivered">Delivered</option>
                        @endif
    
                    </select></p>
                    
                    <input type="hidden" value="{{$testrecord->id}}" name="testrecordID"/>
            @if($testrecord->ReportStaus == 'Sent to Lab')
                <p><div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label" for="chooseFile">Select file</label>
                </div></p>
            @endif
            <p><input type="submit" class="btn btn-primary btn-user btn-block" name="takeaction" id="submit"></p> 
            </form> 
        </div>
    
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>
               
@endsection