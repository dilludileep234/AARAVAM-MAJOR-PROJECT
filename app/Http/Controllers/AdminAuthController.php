<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Admin Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Find admin
        $admin = Admin::where($loginType, $request->username)->first();

        // Check if admin exists and password is correct
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Check approval status
            if ($admin->status === 'pending') {
                return back()->withErrors([
                    'username' => 'Your account is pending approval. Please wait for an administrator to approve your account.'
                ]);
            }

            if ($admin->status === 'rejected') {
                return back()->withErrors([
                    'username' => 'Your account has been rejected. Please contact the system administrator.'
                ]);
            }

            // If approved, log in
            if ($admin->status === 'approved') {
                Auth::guard('admin')->login($admin);
                
                if ($admin->role === 'super_admin') {
                    return redirect()->route('admin.dashboard')->with('success', 'Master Admin Login successful');
                } else {
                    return redirect()->route('category.dashboard')->with('success', 'Category Portal access granted');
                }
            }
        }

        return back()->withErrors([
            'username' => 'Invalid admin credentials'
        ]);
    }

    // Admin Register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required|string',
            'category_access' => 'nullable|string',
        ]);

        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'category_access' => $request->category_access,
            'status' => 'pending', // Set as pending by default
        ]);

        if ($request->role === 'super_admin') {
            return redirect()->route('admin')->with('success', 'Registration successful! Your account is pending approval.');
        } else {
            return redirect()->route('category.login')->with('success', 'Clearance requested! Pending System Ops validation.');
        }
    }

    // Admin Show Login
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->role === 'super_admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('category.dashboard');
            }
        }
        return view('admin-login');
    }

    // Category Admin Show Login
    public function showCategoryLogin()
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->role === 'category_admin') {
                return redirect()->route('category.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
        return view('category-login');
    }

    // Admin Logout
    public function logout()
    {
        $role = Auth::guard('admin')->user()->role ?? null;
        Auth::guard('admin')->logout();
        
        if ($role === 'super_admin') {
            return redirect()->route('admin');
        }
        
        return redirect()->route('category.login');
    }

    // Admin Forgot Password View
    public function showForgotPassword()
    {
        return view('admin-forgot-password');
    }

    // Handle Admin Forgot Password Form Submission
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $otp = rand(100000, 999999);
        
        \App\Models\Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp]
        );

        // Store email in session to know who is resetting (admin specific key)
        session(['admin_reset_email' => $request->email]);
        
        return redirect()->route('admin.otp')->with('success', 'OTP sent to your email');
    }

    // Admin OTP View
    public function showOtp()
    {
        return view('admin-otp');
    }

    // Verify Admin OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('admin_reset_email');
        if(!$email) {
             return redirect()->route('admin.forgot-password')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $otpRecord = \App\Models\Otp::where('email', $email)->where('otp', $request->otp)->first();

        if (!$otpRecord) {
             return back()->withErrors(['otp' => 'Invalid OTP']);
        }
        
        // On success redirect to reset password page setting a verified flag (admin specific key)
        session(['admin_otp_verified' => true]);

        return redirect()->route('admin.reset-password');
    }

    // Admin Reset Password View
    public function showResetPassword()
    {
        if (!session('admin_otp_verified') || !session('admin_reset_email')) {
             return redirect()->route('admin.forgot-password');
        }
        return view('admin-reset-password');
    }

    // Update Admin Password
    public function updatePassword(Request $request)
    {
        $request->validate([
             'password' => 'required|min:6|confirmed'
        ]);

        $email = session('admin_reset_email');
        if(!$email) {
             return redirect()->route('admin.forgot-password');
        }

        $admin = Admin::where('email', $email)->first();
        $redirectRoute = 'admin';

        if($admin) {
             $admin->password = Hash::make($request->password);
             $admin->save();
             
             // Clear OTP
             \App\Models\Otp::where('email', $email)->delete();

             if ($admin->role !== 'super_admin') {
                  $redirectRoute = 'category.login';
             }
        }

        // Clear session
        session()->forget(['admin_reset_email', 'admin_otp_verified']);

        return redirect()->route($redirectRoute)->with('success', 'Password reset successfully');
    }
}
