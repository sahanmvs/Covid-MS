@extends('layouts.master')
@section('content')
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form name="assignto" method="post">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>  
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>NIC</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                      
                                    <tbody>
                                      
                                       @foreach($users as $data)
                                        <tr>                                    
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email}}</td>   
                                            <td>{{ $data->phone }}</td>
                                            <td>{{ $data->address }}</td>
                                            <td>{{ $data->NIC }}</td>
                                
                                            <td><a href="/testdetails/{{ $data->id }}" class="btn btn-info btn-sm">Edit</a> </td>
                                            <td><a href="/testdetails/{{ $data->id }}" class="btn btn-danger btn-sm">Delete</a>  </td>
                                        </tr>
                                        @endforeach                                       

                                    </tbody>

                                </table>
                                     </form>
                            </div>
                        </div>
                    </div>

@endsection