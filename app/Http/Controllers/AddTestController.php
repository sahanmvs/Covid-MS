<?php

namespace App\Http\Controllers;

use App\Models\Testrecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddTestController extends Controller
{
    public function index(){
        $users = DB::table('users')->where('role', 'user')->get();
        return view('admin.addtest', ['users'=>$users]);
    }

    function send(Request $request){
        $this->validate($request,[
            'uid' => 'required',
            'testtype' => 'required',
            'timeslot'  => 'required',
        ]);

        $testrecord = new Testrecord();
        $testrecord->OrderNo = $request->input('Orderno');
        $testrecord->user_id = $request->input('uid');
        $testrecord->TestType = $request->input('testtype');
        $testrecord->TestTimeSlot = $request->input('timeslot');

        $testrecord->PatientMobile = $testrecord->user->phone;
        $testrecord->save();
        return back()->with('success', 'Test Record Added');
    }
}
