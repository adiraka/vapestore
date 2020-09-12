<?php

namespace App\Http\Controllers\Web;

use Auth;
use Cart;
use Midtrans;
use App\Model\Varian;
use App\Service\ProductService;
use App\Service\RajaOngkirService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
	public function checkout() {
		if (!Auth::check()) {
			return redirect()->route('web.register');
		}

		$cartList = Cart::content();
		
		return view('web.transaction.checkout', [
			'cartList' => $cartList,
			'cart' => Cart::class, 
			'courierList' => RajaOngkirService::getListCourier()
		]);
	}

	public function payment(Request $request) {
		$params = array(
		    'transaction_details' => array(
		        'order_id' => rand(),
		        'gross_amount' => 10000,
		    )
		);

		try {
		  // Get Snap Payment Page URL
		  $paymentRedirectUrl = Midtrans::createTransaction($params)->redirect_url;
		  
		  // Redirect to Snap Payment Page
		  return redirect($paymentRedirectUrl);
		}
		catch (Exception $e) {
		  echo $e->getMessage();
		}
	}
}
