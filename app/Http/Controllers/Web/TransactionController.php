<?php

namespace App\Http\Controllers\Web;

use Auth;
use Cart;
use Midtrans;
use App\Model\Varian;
use App\Service\ProductService;
use App\Service\RajaOngkirService;
use App\Service\TransactionService;
use App\Service\MidtransService;;
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
		$data = (object)$request->all();

		$invoice = TransactionService::createInvoice($data->grandTotal);
		$order = TransactionService::createOrder($invoice->id, $data->courierName, $data->delivery, $data->grandTotal);

		$params = array(
		    'transaction_details' => array(
		        'order_id' => $invoice->invoice_number,
		        'gross_amount' => $invoice->total_amount,
		    )
		);

		$paymentRedirectUrl = Midtrans::createTransaction($params)->redirect_url;
		
		return redirect($paymentRedirectUrl);
	}
}
