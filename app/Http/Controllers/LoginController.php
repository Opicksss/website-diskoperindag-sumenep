<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            ],
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

    public function forgot()
    {
        return view('admin.auth.forgot');
    }

    public function forgot_proses(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // Generate token
            $token = Str::random(64);

            // Store the token in password_reset_tokens table
            DB::table('password_reset_tokens')->updateOrInsert(['email' => $request->email], ['token' => $token, 'created_at' => now()]);

            // Send reset link via email
            $resetLink = route('reset', ['token' => $token]);
            Mail::send('admin.auth.email-reset', ['resetLink' => $resetLink], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });

            return back()->with('success', 'Reset link sent to your email address.');
        } catch (\Exception $e) {
            return back()->with('error', 'Email address provided is not registered');
        }
    }

    public function reset($token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$record) {
            return redirect()
                ->route('forgot')
                ->with(['error' => 'Token is invalid or expired.']);
        }

        // Konversi `created_at` ke Carbon untuk pengecekan waktu
        $createdAt = Carbon::parse($record->created_at);

        if ($createdAt->addMinutes(60)->isPast()) {
            return redirect()
                ->route('forgot')
                ->with(['error' => 'Token is invalid or expired.']);
        }

        return view('admin.auth.reset', [
            'email' => $record->email,
            'token' => $token,
        ]);
        // return view('login.reset', ['token' => $token]);
    }

    public function reset_proses(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required',
        ]);

        // Verify token and email
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with(['error' => 'Token is invalid.']);
        }

        // Convert `created_at` to Carbon for time validation
        $createdAt = Carbon::parse($record->created_at);

        if ($createdAt->addMinutes(60)->isPast()) {
            return back()->with(['error' => 'Token is expired.']);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Delete the token after successful reset
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')->with('success', 'Password has been reset successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
