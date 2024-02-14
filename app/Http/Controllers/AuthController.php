<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        if ($request->isMethod('GET')) {
            return view('auth.login');
        }

        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect()->route('index');
        } else {
            return redirect()->route('auth.login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'Berhasil Logout');
    }
}
