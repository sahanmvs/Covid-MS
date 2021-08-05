<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testrecord;
use App\Models\Phlebotomist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class TestsController extends Controller
{
    function newtest() {
        //$data = DB::table('testrecords')->whereNull('ReportStaus')->get();
        $data = Testrecord::whereNull('ReportStaus')->get();
        return view('admin.newtests', ['newtests'=>$data]);
    }   

    function view($id) { //view newtests
        $testrecord = Testrecord::find($id); 
        $phlebotomist = Phlebotomist::all(); 
        return view('admin.testdetails', compact('testrecord', 'phlebotomist', 'id'));
    }

    function assign(Request $request) {
        $id = $request->input('testrecordID');
        $testrecord = Testrecord::find($id); 
        if($testrecord) {
            $testrecord->ReportStaus = 'Assigned';
            $testrecord->AssignedEmpID = $request->input('assignto');
            
            $testrecord->AssignedEmpName = $testrecord->phlebotomist->name;
            $testrecord->AssignedTime = Carbon::now();
            $testrecord->save();
            return back()->with('success', 'Successfully assigned');
        }
    }

    function assigned() { // orders assigned phlebotomists
        $data = Testrecord::where('ReportStaus', 'Assigned')->get();
        return view('admin.assignedtests', ['assigned'=>$data]);
    }

    function viewAssigned($id) { //view newtests
        $testrecord = Testrecord::find($id); 
        $phlebotomist = Phlebotomist::all(); 
        return view('admin.testdetails', compact('testrecord', 'phlebotomist', 'id'));
    }

    function updatestatus(Request $request) { 
       $id = $request->input('testrecordID');
       $record = Testrecord::find($id);
       if($record) {
        $record->ReportStaus = $request->input('status');

        // $record->FinalReport = $request->file->store('public');
        if($request->file){
        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $record->FinalReport = $filename;}

        $record->ReportUploadedTime = Carbon::now();
        $record->save();
        return back()->with('success', 'Status updated');
       }
    }

    function otwforsamples() { // on the way for collection
        $data = Testrecord::where('ReportStaus', 'On the Way for Collection')->get();
        return view('admin.otwsample', ['otws'=>$data]);
    }

    function collected() { // collected samples
        $data = Testrecord::where('ReportStaus', 'Sample Collected')->get();
        return view('admin.samplecollected', ['scs'=>$data]);
    }

    function sentlab() { // collected samples
        $data = Testrecord::where('ReportStaus', 'Sent to Lab')->get();
        return view('admin.senttolab', ['labs'=>$data]);
    }

    function reportok() { // report delivered
        $data = Testrecord::where('ReportStaus', 'Delivered')->get();
        return view('admin.reportdelivered', ['reports'=>$data]);
    }

    function reportdownload($file) {      
    	return response()->download(public_path('assets/'.$file));
    }

    //DashBoard Values
    function dashboad_details(){
        $total_test_count = Testrecord::all()->count();

        $total_assigned_count = Testrecord::where('ReportStaus', 'Assigned')->count();

        $total_otw_count = Testrecord::where('ReportStaus', 'On the Way for Collection')->count();

        $total_collected_count = Testrecord::where('ReportStaus', 'Sample Collected')->count();

        $total_sent_count = Testrecord::where('ReportStaus', 'Sent to Lab')->count();

        $total_delivered_count = Testrecord::where('ReportStaus', 'Delivered')->count();

        $total_users = User::where('role', 'user')->count();

        $total_phlebotomists = Phlebotomist::all()->count();

        return view('admin.dashboard', compact('total_test_count', 'total_assigned_count', 
                    'total_otw_count', 'total_collected_count', 'total_sent_count', 
                    'total_delivered_count', 'total_users', 'total_phlebotomists'));
    }

}
