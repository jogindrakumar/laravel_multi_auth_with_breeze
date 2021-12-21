<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    //

    public function Index(){
        return view('admin.admin_login');
    }

    // Dashboard

    public function Dashboard(){
        return view('admin.index');
    }

    // login 

    public function Login(Request $request){
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'],'password' =>$check['password']])){
            return redirect()->route('admin.dashboard')->with('success','Admin Login successfully');
        }else{
            return redirect()->back()->with('error','Invalid Email or Password');
        }
    }

    // admin logout 

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('success','Admin Logout successfully');
    }
}
