<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Admin;

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

    // admin register function

    public function AdminRegister(){
        return view('admin.admin_register');

    }

    // admin create 

    public function AdminRegisterCreate(Request $request){
        Admin::insert([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('success','Admin created Account successfully!!');

    }
}
