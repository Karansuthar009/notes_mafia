<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerlogin()
    {
        return view('loginregister');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = explode('@', $request->email)[0];
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        Session::put('login_notification', 'You Are Register Successfully!', true);
        return redirect('registerlogin')->with('success', 'Registered Successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role == 'admin') {
                Session::put('login_notification', 'You Are Login Successfully!', true);
                return redirect('/')->with('success', 'Admin Login Successfully');
            } else {
                Session::put('login_notification', 'You Are Login Successfully!', true);
                return redirect('/')->with('success', 'Login Successfully');
            }
        }

        return redirect()->back()->with('fail', 'Login failed');
    }

    public function clearNotification(Request $request)
    {
        if ($request->session()->has('login_notification')) {
            $request->session()->forget('login_notification');
        }

        return response()->json(['success' => true]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('registerlogin')->with('success', 'Logout Successfully');
    }
}
