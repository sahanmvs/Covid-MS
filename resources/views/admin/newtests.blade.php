@extends('layouts.master')
@section('content')
                    <!-- Page Heading -->
                    <div class="row">
                        <h1 class="h3 mb-2 text-gray-800">New Test Requests</h1>
                        <nav class="ml-auto" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">New Test</li>
                            </ol>
                          </nav>
                        </div>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">New Test Requests</h6>
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
                                            <th>Time Slot</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                      
                                       @foreach($newtests as $newtest)
                                        <tr>                                    
                                            <td>{{ $newtest->OrderNo }}</td>
                                            <td>{{ $newtest->user->name }}</td>   
                                            <td>{{ $newtest->PatientMobile }}</td>
                                            <td>{{ $newtest->TestType }}</td>
                                            <td>{{ $newtest->TestTimeSlot }}</td>
                                            <td>{{ $newtest->RegistrationDate }}</td>                                   
                                            <td>
                                            <a href="/testdetails/{{ $newtest->id }}" class="btn btn-info btn-sm">View Details</a> 
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