<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate(
            [
                'login' => 'required',
                'password' => 'required',
            ],
            [
                'login.required' => 'Email or username is required',
                'password.required' => 'Password is required',
            ]
        );

        $login = $request->input('login');
        $password = $request->input('password');

        $user = User::where('email', $login)->orWhere('name', $login)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            if (Auth::user()->role == 'user') {
                return redirect('/dashboard');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email, username or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
