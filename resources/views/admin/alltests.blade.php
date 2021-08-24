@extends('layouts.master')
@section('content')
                    <!-- Page Heading -->
                    <div class="row">
                        <h1 class="h3 mb-2 text-gray-800">All-Test Details</h1>
                        <nav class="ml-auto" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Tests</li>
                            </ol>
                          </nav>
                        </div>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Test Records</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form name="assignto" method="post">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>  
                                            <th>Order No.</th>
                                            <th>Patient Name</th>
                                            <th>Mobile No.</th>
                                            <th>Test Type</th>
                                            <th>Status</th>
                                            <th>Time Slot</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                      <tfoot>
                                            <tr> 
                                            <th>Order No.</th>
                                            <th>Patient Name</th>
                                            <th>Mobile No.</th>
                                            <th>Test Type</th>
                                            <th>Status</th>
                                            <th>Time Slot</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                      
                                       @foreach($alltests as $test)
                                        <tr>                                    
                                            <td>{{ $test->OrderNo }}</td>
                                            <td>{{ $test->user->name }}</td>   
                                            <td>{{ $test->PatientMobile }}</td>
                                            <td>{{ $test->TestType }}</td>
                                            <td>{{ $test->ReportStaus }}</td>
                                            <td>{{ $test->TestTimeSlot }}</td>
                                            <td>{{ $test->RegistrationDate }}</td>                                   
                                            <td>
                                            <a href="/testdetails/{{ $test->id }}" class="btn btn-info btn-sm">View Details</a> 
                                            </td>
                                        </tr>
                                        @endforeach                                       

                                    </tbody>

                                </table>
                                     </form>
                            </div>
                        </div>
                    </div>

@endsection