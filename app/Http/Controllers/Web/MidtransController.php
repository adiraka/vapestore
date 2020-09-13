<?php

namespace App\Http\Controllers\Web;

use Midtrans;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
	public function handlingCallback(Request $request) {
		$notification = Midtrans::notification();

		$transaction = $notification->transaction_status;
		$fraud = $notification->fraud_status;

		error_log("Order ID $notification->order_id: "."transaction status = $transaction, fraud staus = $fraud");

		if ($transaction == 'capture') {
		    if ($fraud == 'challenge') {
		      // TODO Set payment status in merchant's database to 'challenge'
		    }
		    else if ($fraud == 'accept') {
		      \Log::info(json_encode($notification));
		    }
		}
		else if ($transaction == 'cancel') {
		    if ($fraud == 'challenge') {
		      // TODO Set payment status in merchant's database to 'failure'
		    }
		    else if ($fraud == 'accept') {
		      // TODO Set payment status in merchant's database to 'failure'
		    }
		}
		else if ($transaction == 'deny') {
		      // TODO Set payment status in merchant's database to 'failure'
		}
	}

	public function finish() {
		return 'finish';
	}

	public function unifinish() {
		return 'unifinish';
	}

	public function error() {
		return 'error';
	}
}