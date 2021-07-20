<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phlebotomist;
use Illuminate\Support\Facades\DB;

class AddPhlebotomistController extends Controller
{
    public function index(){
        return view('admin.addphlebotomist');
    }

    function send(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'empid' =>  'required',
            'mobile'  =>  'required|numeric',

        ]);

        $user = new Phlebotomist();
        $user->name = $request->input('name');
        $user->EmpID = $request->input('empid');
        $user->Mobile = $request->input('mobile');
        $user->save();
        return back()->with('success', 'Phlebotomist Added');
    }

    function allphlebotomists() {
        $users = DB::table('phlebotomists')->get();
        return view('admin.managephlebotomist', ['phle'=>$users]);
    }

    
}
