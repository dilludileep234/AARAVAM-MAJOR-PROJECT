<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Otp;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (auth()->attempt([
            $loginType => $request->username,
            'password' => $request->password
        ])) {
            $user = auth()->user();
            if ($user->status === 'pending') {
                auth()->logout();
                return back()->withErrors(['username' => 'Your account is pending admin approval.']);
            } elseif ($user->status === 'rejected') {
                auth()->logout();
                return back()->withErrors(['username' => 'Your account has been rejected by the admin.']);
            }
            return redirect()->route('portal')->with('success', 'Login successful');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password'
        ]);
    }
//register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending',
        ]);

        return redirect()->route('student')->with('success', 'Account created successfully. Please wait for admin approval.');
    }

    // Forgot Password View
    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    // Handle Forgot Password Form Submission
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $otp = rand(100000, 999999);
        
        Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp]
        );

        // Store email in session to know who is resetting
        session(['reset_email' => $request->email]);
        
        return redirect()->route('otp')->with('success', 'OTP sent to your email');
    }

    // OTP View
    public function showOtp()
    {
        return view('otp');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('reset_email');
        if(!$email) {
             return redirect()->route('forgot-password')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $otpRecord = Otp::where('email', $email)->where('otp', $request->otp)->first();

        if (!$otpRecord) {
             return back()->withErrors(['otp' => 'Invalid OTP']);
        }
        
        // On success redirect to reset password page setting a verified flag
        session(['otp_verified' => true]);

        return redirect()->route('reset-password');
    }

    // Reset Password View
    public function showResetPassword()
    {
        if (!session('otp_verified') || !session('reset_email')) {
             return redirect()->route('forgot-password');
        }
        return view('reset-password');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
             'password' => 'required|min:6|confirmed'
        ]);

        $email = session('reset_email');
        if(!$email) {
             return redirect()->route('forgot-password');
        }

        $user = User::where('email', $email)->first();
        if($user) {
             $user->password = Hash::make($request->password);
             $user->save();
             
             // Clear OTP
             Otp::where('email', $email)->delete();
        }

        // Clear session
        session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('student')->with('success', 'Password reset successfully');
    }


    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
