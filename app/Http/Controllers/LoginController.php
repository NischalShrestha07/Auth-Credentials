<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    // public function handelLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);
    //     $email = 'rabin@gmail.com';
    //     $password = 'rabin@123';
    //     if ($request->input('email') == $email && $request->input('password') == $password) {
    //         session(['status' => true, 'email' => '$email']);
    //         return redirect()->route('dashboard')->with('success', 'You have successfully logged in!');
    //     }
    //     return redirect()->back()->with('error', 'Incorrect email or password.')->withInput($request->all);
    // }

    public function handelLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('dashboard');
        // }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['status' => true, 'email' => '$email']);

            return redirect()->route('dashboard')->with('success', 'Login successful');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // public function dashboard()
    // {
    //     $user = AUth::user();
    //     if ($user->isSuperAdmin()) {
    //         return view('dashboards.superadmin');
    //     } elseif ($user->isAdmin()) {
    //         return view('dashboards.admin');
    //     } else {
    //         return view('dashboards.staff');
    //     }
    // }

    public function dashboard()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'superadmin' => view('dashboards.superadmin'),
            'admin' => view('dashboards.admin'),
            default => view('dashboards.staff'),
        };
    }


    public function logout()
    {
        session()->forget(['status', 'email']);
        return redirect()->route('login')->with('success', 'You have logged out successfully!!');
    }
}
