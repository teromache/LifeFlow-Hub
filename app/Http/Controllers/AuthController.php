<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credential = $request->only("email", "password");

        if(Auth::attempt($credential)){
            return redirect("/dasboard");
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
