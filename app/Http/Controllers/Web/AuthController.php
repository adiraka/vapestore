<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\User;
use App\Model\UserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function getRegisterPage() {
		return view('web.auth.register');
	}
}
