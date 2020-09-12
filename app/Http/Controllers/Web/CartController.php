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
			'cartList' => $cartList,
			'cart' => Cart::class
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
		$data = (object)$request->all();

		$row = count($request->rowId);
		$errors = [];

		if ($row == 0) {
			return rediract()->back()->withError('Cart is empty.');
		}

		for ($i=0; $i < $row; $i++) { 
			$checkStock = ProductService::CheckQty($request->varianId[$i], $request->qty[$i]);
			if (!$checkStock) {
				$errors[] = 'Produk '.$request->productName[$i].' qty insuficient.';
				continue;
			}
			Cart::update($request->rowId[$i], $request->qty[$i]);
		}

		if (count($errors) > 0) {
			return rediract()->back()->withError($errros);
		}

		return redirect()->back()->with('success', 'Successfully update cart.');
	}

	public function postremoveCart(Request $request) {
		
	}

	public function destroyCart() {
		Cart::destroy();

		return redirect()->back();
	}
}
