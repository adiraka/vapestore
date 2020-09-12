<?php

namespace App\Http\Controllers\Web;

use Auth;
use Cart;
use App\Model\Varian;
use App\Service\ProductService;
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
		$data = (object)$request->all();

		$request->validate([
            'varian_id' => 'required',
            'qty' => 'required'
        ]);

		$varian = Varian::find($request->varian_id);

		$checkStock = ProductService::CheckQty($varian->id, $data->qty);

		if (!$checkStock) {
			return rediract()->back()->withError('Insuficient qty amount.');
		}

		$addToCart = Cart::add($varian->id, $varian->product->name, $data->qty, $varian->price, $varian->toArray());

		return redirect()->route('web.cart.list');
	}

	public function postUpdateCart(Request $request) {
		
	}

	public function postremoveCart(Request $request) {
		
	}

	public function destroyCart() {
		Cart::destroy();

		return redirect()->back();
	}
}
