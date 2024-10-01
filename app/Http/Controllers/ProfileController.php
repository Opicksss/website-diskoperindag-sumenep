<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request);
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);

            $user->Update($validatedData);
            return redirect()->back()->with('success', 'Profile Berhasil di Edit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengedit Akun / Email Sudah Ada');
        }
    }

    public function password(Request $request, User $user)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Ambil user
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Password successfully updated');
    }

    public function upload(Request $request, User $user)
    {
        try {
            // dd($request);
            $validatedData = $request->validate([
                'pp' => 'required|image|mimes:jpeg,png,jpg,gif|max:1000',
            ]);
            // dd($user);

            if (isset($validatedData['pp'])) {
                $validatedData['pp'] = $request->file('pp')->store('profile-pp');
            }

            $user->update($validatedData);

            return back()->with('success', 'Photo uploaded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload photo');
        }
    }

    public function reset(User $user)
    {
        // dd($user);
        if ($user->pp) {
            Storage::disk('public')->delete($user->pp);
        }

        $user->pp = null;
        $user->save();

        return back()->with('success', 'Photo Reset successfully.');
    }
}
