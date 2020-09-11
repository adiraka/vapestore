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
	

	public function postAccountDetail(Request $request) {
		$data = (object)$request->all();

		$account = Auth::user()->detail;

		if (empty($account)) abort('404');

		$account->name = $data->name;
		$account->gender = $data->gender;
		$account->dateOfBirth = $data->dateOfBirth;
		$account->phone = $data->phone;
		$account->address = $data->address;
		$account->subdistrict = $data->subdistrict;
		$account->district = $data->district;
		$account->city = $data->city;
		$account->province = $data->province;
		$account->postalCode = $data->postalCode;
		$account->save();

		return redirect()->back()->with('success', 'Successfully update account info.');
	}
}
