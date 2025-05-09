<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserAuth extends Controller
{
    function login()
    {
        return view("auth.login");
    }
    
    function register()
    {
        return view("auth.register");
    }

    function registerUser(Request $request){
       
         $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 0;
        $user->password = Hash::make($request->password);

        $result = $user->save();

        if($result)
        {
            return back()->with('succes','You have registered');
        }else{
            return back()->with('fail','Something Went Wrong');
        }
    }

    function loginuser(Request $request)
    {

        $request->validate([

            'email'=>'required',
            'password'=>'required|min:8'
        ]);


       
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            //return Auth::user();
            return redirect()->intended('dashboard'); // or any route
        }




    
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);

        // $user = User::where('email', '=',$request->email)->first();
        // if(user)
        // {
        //     if(Hash::check($request->password, $user->password))
        //     {
        //         $request = Session()-> put('login_id', $user->id);

        //         return redirect('dashboard');
        //     }
        //     else
        //     {
        //         return back()-> with('fail', 'Invalid email and password');
        //     }
        // }
        // else
        // {
        //     return back()-> with('fail', 'Invalid email and password');
        // }
    }

    function logoutUser()
    {
        Auth::logout();
        return redirect('login')->with('success', 'You have been logged out.');
    }

    function home(){

           return view('dashboard.home');
        //   dd('request');
         
    }

}
