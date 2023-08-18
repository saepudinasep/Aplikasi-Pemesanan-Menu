<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticating(Request $request)
    {
        // dd($request->all());

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            Session::flash('status', 'success');
            Session::flash('message', 'Selamat Datang ' . Auth::user()->name);

            return redirect()->intended('/home');
        } else {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {

                Session::flash('status', 'failed');
                Session::flash('message', 'Username tidak ditemukan');

                return redirect('/login');
            } else {
                Session::flash('status', 'failed');
                Session::flash('message', 'Password Salah');

                return redirect('/login');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function show()
    {
        $data = User::findOrFail(Auth::user()->id);
        return view('profile', ['data' => $data]);
    }

    public function edit()
    {
        return view('change-password');
    }

    public function update(Request $request)
    {
        // dd(
        //     Hash::check($request->old_password, Auth::user()->password)
        // );
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // Match Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Password Lama Berbeda!');

            return redirect('/change-password');
        }

        // Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);


        Session::flash('status', 'success');
        Session::flash('message', 'Change Password ' . Auth::user()->name . ' Berhasil');

        return redirect('/home');
    }
}
