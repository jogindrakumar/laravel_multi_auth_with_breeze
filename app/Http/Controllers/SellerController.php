<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{
    //
        public function Index(){
        return view('seller.seller_login');
    }

    // Dashboard

    public function Dashboard(){
        return view('seller.index');
    }

    // login 

    public function Login(Request $request){
        $check = $request->all();
        if(Auth::guard('seller')->attempt(['email' => $check['email'],'password' =>$check['password']])){
            return redirect()->route('seller.dashboard')->with('success','seller Login successfully');
        }else{
            return redirect()->back()->with('error','Invalid Email or Password');
        }
    }

    // seller logout 

    public function SellerLogout(){
        Auth::guard('seller')->logout();
        return redirect()->route('login_form')->with('success','seller Logout successfully');
    }

    // seller register function

    public function SellerRegister(){
        return view('seller.seller_register');

    }

    // seller create 

    public function SellerRegisterCreate(Request $request){
        Seller::insert([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('success','seller created Account successfully!!');

    }
}
