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

    //edit phlebotomist
    function editPhlebotomist($id){
        $phlebotomist = Phlebotomist::find($id);
        return view('admin.editphlebotomist', compact('phlebotomist', 'id'));
    } 
    
    function updatePhlebotomist(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'empid' =>  'required',
            'mobile'  =>  'required|numeric',

        ]);
        $phlebotomist = Phlebotomist::find($request->id);
        $phlebotomist->name = $request->get('name');
        $phlebotomist->EmpID = $request->get('empid');
        $phlebotomist->Mobile = $request->get('mobile');
        $phlebotomist->save();
        return back()->with('success', 'Phlebotomist Updated');
    }
}
