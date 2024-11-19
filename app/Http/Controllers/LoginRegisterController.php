<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Jobs\SendMailRegisterJob;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginRegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function register() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' =>'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);

        // $credentials = $request->only('email','password');
        // Auth::attempt($credentials);
        // $request->session()->regenerate();

        // $data = $request->validate([
        //     'name' =>'required|string|max:250',
        //     'email' => 'required|email|max:250|unique:users',
        //     'password' => 'required|min:8|confirmed'
        // ]);
        
        dispatch(new SendMailRegisterJob($user));

        return redirect()->route('login');
            // ->withSuccess('You have successfully registered and logged in!');
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->route('dashboard')
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.'
        ]);
    }

    public function dashboard() {
        // if (Auth::check()) {
        //     return view('auth.dashboard');
        // }

        // return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'please login to access the dashboard.'
        //     ])->onlyInput('email');
        return view('auth.dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out succesfully!');
    }
}
