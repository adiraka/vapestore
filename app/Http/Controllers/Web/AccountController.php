<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Model\Order;
use App\Service\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Util\Constant;

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

	public function getListOrder() {
		$userId = Auth::user()->id;

		$orders = Order::where('user_id', $userId)->orderBy('id', 'desc')->paginate(10);

		return view('web.account.order-list', [
			'orders' => $orders
		]);
	}

	public function getDetailOrder($id) {
		$userId = Auth::user()->id;

		$order = Order::where('user_id', $userId)->where('order_number', $id)->first();

		if(empty($order)) abort('404');

		return view('web.account.order-detail', [
			'order' => $order
		]);
	}

	public function confirmationOrder(Request $request) {
		$data = (object)$request->all();

		$order = Order::find($data->order_id);

		if ($data->status == Constant::ORDER_STATUS_COMPLETED) {
			OrderService::UpdateStatus($order, $data->status);
		}

		return redirect()->back()->with('success', 'Order successfully confirmed.');
	}
}
