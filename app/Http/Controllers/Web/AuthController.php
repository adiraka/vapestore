<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\User;
use App\Model\UserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function getRegisterPage() {
		return view('web.auth.register');
	}

	public function postRegister(Request $request) {
		$data = (object)$request->all();

		$request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
    		'password' => 'required|confirmed',
    		'password_confirmation' => 'required'
        ]);

		$user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);

        $userDetail = UserDetail::create([
        	'name' => $data->name
        ]);

        $user->detail()->save($userDetail);

        return redirect()->back()->with('success', 'Register successfully, please login on login form.');
	}
}
