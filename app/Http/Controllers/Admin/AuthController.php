<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function getLoginPage() {
        return view('admin.auth.login');
    }

    // 'password' => Hash::make($data['password'])

    public function postLogin(Request $request) {
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $attemptAuth = Auth::attempt($credentials);

        if ($attemptAuth) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withError('Oppes! You have entered invalid credentials.');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.getLogin');
    }
}
