<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
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
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check user_type and redirect accordingly
        if ($user->user_type == 1) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->intended('user-product-view'); // Change this route as needed
        }
    }

    // If authentication fails
    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}

    function logoutUser()
    {
        Auth::logout();
        return redirect('login')->with('success', 'You have been logged out.');
    }

    function home(){

        $newOrdersCount = Order::where('status', 'pending')->count();
    $orders = Order::latest()->take(10)->get();
    
    return view('dashboard.home', compact('newOrdersCount', 'orders'));

        //    return view('dashboard.home');
        //   dd('request');
         
    }

    public function redirectAfterLogin()
{
    $loguser = auth()->user(); // get logged-in user

    if($loguser->type == 1){
        return redirect('dashboard.home');
    }
    if($loguser->type == 0) {
        return redirect('User-dashboard/home');
    }

    // Optional: default redirect if no type matched
    return redirect('home');
}



}
