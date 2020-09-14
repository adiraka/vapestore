<?php

namespace App\Http\Controllers\Web;

use Midtrans;
use App\Model\ApiLog;
use App\Model\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\InvoiceService;

class MidtransController extends Controller
{
	public function handlingCallback(Request $request) {
		$notification = Midtrans::notification();

		

		$transaction = $notification->transaction_status;
		$fraud = $notification->fraud_status;

		error_log("Order ID $notification->order_id: "."transaction status = $transaction, fraud staus = $fraud");

		// if ($transaction == 'capture') {
		//     if ($fraud == 'challenge') {
		//     }
		//     else if ($fraud == 'accept') {
		//       \Log::info(json_encode($notification));
		//     }
		// }
		// else if ($transaction == 'cancel') {
		//     if ($fraud == 'challenge') {
		//     }
		//     else if ($fraud == 'accept') {
		//     }
		// }
		// else if ($transaction == 'deny') {
		// }
		
		if ($transaction == 'capture' || $transaction == 'settlement') {
            $invoice = Invoice::where('invoice_number', $notification->order_id)->first();
            InvoiceService::UpdateStatus($invoice, Constant::INVOICE_STATUS_PAID);
        }

		return response('Data Accepted');
	}

	public function finish() {
		return view('web.transaction.complete', [
			'message' => 'Terima Kasih Telah Belanja di VAPESTORE'
		]);
	}

	public function unifinish() {
		return view('web.transaction.complete', [
			'message' => 'Mohon Maaf Transaksi Anda Tidak Bisa Dilanjutkan.'
		]);
	}

	public function error() {
		return view('web.transaction.complete', [
			'message' => 'Mohon Maaf, Terdapat Kesalahan Disaat Memproses Transaski'
		]);
	}
}