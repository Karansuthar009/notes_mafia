<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\OtpVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class AdminController extends Controller
{
    public function register_page()
    {
        return view('admin.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => "required|email|unique:users,email",
            'password' => "required|min:8|numeric",
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $data = $user->save();
        if ($data) {
            return back()->with('success', 'Data insert successfully');
        }
        return back()->with('fail', 'Data insert failed');
    }

    public function login_page()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email'=> 'required',
        //     'password'=> 'required'
        // ]);
        $email = $request->email;
        $password = $request->password;
        // dd($email);
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/');
        } else {
            return back()->with('fail', 'Login fail');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login/page')->with('success', 'Logout successfully');
    }

    public function reset_password_page()
    {
        return view('admin.reset_password');
    }

    public function reset_password(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users,email',
        // ]);

        $code = mt_rand(100000, 999999);
        $email = $request->email;
        // dd($email);
        $otp = new OtpVerify();
        $otp->otp = $code;
        $otp->email = $email;
        $otp->save();

        try {
            Mail::to($email)->send(new ResetPassword($code));
            return redirect('newpassword')->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function newpassword()
    {
        return view('admin.newpassword');
    }
    // public function verify_otp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:otp_verifies,email',
    //         'otp' => 'required|digits:6',
    //         'new_password' => 'required|min:8|confirmed',
    //         'password_confirmed' => 'required'
    //     ]);

    //     $otp = OtpVerify::where('email', $request->email)
    //         ->where('otp', $request->otp)
    //         ->first();

    //     if (!$otp) {
    //         return redirect()->back()->with('error', 'Invalid OTP.');
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     $user->password = bcrypt($request->new_password);
    //     $user->save();

    //     return redirect()->route('login')->with('success', 'Password reset successfully!');
    // }

    public function change_password(Request $request)
    {
        $request->validate([
            'currunt_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            // 'password_confirmation' => 'required'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->currunt_password, $user->password)) {
            return back()->with('fail', 'The current password is incorrect.');
        }
  
        $user->password = Hash::make($request->new_password);
       $user->save();
       
        return redirect('login/page')->with('success','Password was changed');
     
    }
}
