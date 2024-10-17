<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.auth.login');
    }
    public function userlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            return redirect()->route('user.dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    


    public function userView(){
      return view('user.auth.register');
    }


    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful. Please log in.');
    }


    public function userDashboard(){
      $user = Auth::user(); 
      return view('user.auth.dashboard', compact('user'));
    }


    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('user.login');
    }
}
