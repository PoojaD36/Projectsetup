<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\user;
use Session;
use Hash;

class UserAuth extends BaseController
{
    function userLogin(Request $request)
    {
        $data = $request->input();
        $request -> session() -> put('user', $data['name']);
        echo session('user');
    }

    function login()
    {
        return view("login");
    }
    
    function register()
    {
        return view("register");
    }

    function registeruser(Request $request){


        dd($request);
       
        /*
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:5'
        ]);

        $user = new Users();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        $result = $user->save();

        if($result)
        {
            return back()->with('succes','You have registered');
        }else{
            return back()->with('fail','Something Went Wrong');
        }

        */
    }

    function loginuser(Request $request)
    {
        $request->validate([

            'email'=>'required',
            'password'=>'required|min:5'
        ]);

        $user = Users::where('email', '=',$request->email)->first();
        if(user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $request = Session()-> put('login_id', $user->id);

                return redirect('dashboard');
            }
            else
            {
                return back()-> with('fail', 'Invalid email and password');
            }
        }
        else
        {
            return back()-> with('fail', 'Invalid email and password');
        }
    }

    function logoutUser()
    {
        if(Session::has('login_id'))
        {
            Session::pull('login_id');
            return redirect('dashboard');
        }
        else
        {
            return view("login");
        }
    }

    function dashboard()
    {
        $data = array();
        if(Session::has('login_id'))
        {
            $data = users::where('id', '=', Session:get('login_id'))->first();
        }

        return view("dashboard");
    }
}