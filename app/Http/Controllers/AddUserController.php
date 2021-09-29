<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    public function index(){
        return view('admin.adduser');
    }

    function send(Request $request){
        $this->validate($request, [
            'username' => 'required|min:4',
            'email' =>  'required|email|unique:users',
            'address'  =>  'required',
            'phone'  =>  'required|numeric',
            'NIC'   =>  'required',
        ]);

        $user = new ModelsUser();
        $user->name = $request->input('username');
        $user->password = Hash::make('password');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->NIC = $request->input('NIC');
        $user->role = 'user';
        $user->save();
        return back()->with('success', 'User Added');
    }

    // for users and phlebotomists
    function allusers() {
        $users = DB::table('users')->where('role', 'user')->get();
        return view('admin.manageuser', ['users'=>$users]);
    }

    //edit User
    function editUser($id){
        $user = ModelsUser::find($id);
        return view('admin.edituser', compact('user', 'id'));
    } 
    
    function updateUser(Request $request){

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' =>  'required|email|unique:users',
            'address'  =>  'required',
            'mobile'  =>  'required|numeric',
            'NIC'   =>  'required',
        ]);

        $user = ModelsUser::find($request->id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('mobile');
        $user->NIC = $request->get('NIC');
        $user->save();
        return back()->with('success', 'User Updated');
    }

    //Admin Profile

    function adminprofile() {
        $user = Auth::user();
        return view('admin.admindetails', ['admin'=>$user]);
    }

    function showpasswordchange(){
        return view('admin.adminpasswordchange');
    }

     /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function changePassword(Request $request)
    {       
        $user = Auth::user();
    
        $userPassword = $user->password;
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>'password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success','password successfully updated');
    }

}
