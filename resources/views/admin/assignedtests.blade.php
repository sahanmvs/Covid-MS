 @extends('layouts.master')
 @section('content')    
                    <!-- Page Heading -->
                    <div class="row">
                        <h1 class="h3 mb-2 text-gray-800">Assigned To Phlebotomist</h1>
                        <nav class="ml-auto" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Assigned Tests</li>
                            </ol>
                          </nav>
                        </div>
                    <h1 class="h3 mb-2 text-gray-800"></h1>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Assigned Tests</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

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
                                          
                                           @foreach($assigned as $assign)
                                            <tr>                                    
                                                <td>{{ $assign->OrderNo }}</td>
                                                <td>{{ $assign->user->name }}</td>   
                                                <td>{{ $assign->PatientMobile }}</td>
                                                <td>{{ $assign->TestType }}</td>
                                                <td>{{ $assign->TestTimeSlot }}</td>
                                                <td>{{ $assign->RegistrationDate }}</td>                                   
                                                <td>
                                                <a href="/testdetails/{{ $assign->id }}" class="btn btn-info btn-sm">View Details</a> 
                                                </td>
                                            </tr>
                                            @endforeach                                       
    
                                        </tbody>
    
                                    </table>

                            </div>
                        </div>
                    </div>
@endsection