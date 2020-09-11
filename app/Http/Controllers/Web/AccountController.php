<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
	public function getAccountDetail() {
		$account = Auth::user()->detail;

		if (empty($account)) abort('404');

		return view('web.account.detail', [
			'account' => $account
		]);
	}
}
