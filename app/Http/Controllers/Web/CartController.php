<?php

namespace App\Http\Controllers\Web;

use Auth;
use Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public function getCartList() {
		$cartList = Cart::content();

		return view('web.transaction.cart', [
			'cartList' => $cartList
		]); 
	}

	public function postAddCart(Request $request) {
		
	}

	public function postUpdateCart(Request $request) {
		
	}

	public function postremoveCart(Request $request) {
		
	}
}
