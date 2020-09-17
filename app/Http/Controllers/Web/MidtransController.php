<?php

namespace App\Http\Controllers\Web;

use Midtrans;
use App\Model\ApiLog;
use App\Model\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\InvoiceService;
use App\Util\Constant;

class MidtransController extends Controller
{
	public function handlingCallback(Request $request) {
		$notification = Midtrans::notification();
		$invoice = Invoice::where('invoice_number', $notification->order_id)->first();

		$transaction = $notification->transaction_status;
		$fraud = $notification->fraud_status;

		if ($transaction == 'capture' || $transaction == 'settlement') {
            InvoiceService::UpdateStatus($invoice, Constant::INVOICE_STATUS_PAID);
        } elseif ($transaction == 'deny' || $transaction == 'cancel') {
        	InvoiceService::UpdateStatus($invoice, Constant::EXPIRED);
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