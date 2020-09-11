<?php

namespace App\Http\Controllers\Web;

use Session;
use App\User;
use App\Model\UserDetail;
use App\Util\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            'role' => Constant::USER_ROLE_CUSTOMER,
            'password' => Hash::make($data->password)
        ]);

        $userDetail = UserDetail::create([
        	'name' => $data->name
        ]);

        $user->detail()->save($userDetail);

        return redirect()->back()->with('success', 'Register successfully, please login on login form.');
	}

	public function postLogin(Request $request) {
		request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role != Constant::USER_ROLE_CUSTOMER) {
                self::logout();
            }

            return redirect()->route('web.homePage');
        }

        return redirect()->back()->withError('Oppes! You have entered invalid credentials.');
	}

    public function postChangePassword(Request $request) {
        $data = (object)$request->all();

        $request->validate([
            'password_old' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = Auth::user();

        if (empty($user)) abort('404');

        $checkPassword = Hash::check($data->password_old, $user->password);

        if (!$checkPassword) {
            return redirect()->back()->withError('Oppes! You have entered invalid Old Password.');
        }

        $user->password = Hash::make($data->password);
        $user->save();

        return redirect()->back()->with('success', 'Successfully change password.');
    }

	public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('web.registerPage');
    }
}
