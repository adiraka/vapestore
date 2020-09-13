<?php

namespace App\Service;

use Midtrans;
use App\Model\Product;
use App\Model\Varian;
use App\Util\Constant;

class MidtransService
{
	public static function status($orderId) {
		$status = Midtrans::status($orderId);
		return $status;
	}

	public static function approve($orderId) {
		$approve = Midtrans::approve($orderId);
		return $approve;
	}

	public static function cancel($orderId) {
		$cancel = Midtrans::cancel($orderId);
		return $cancel;
	}
}
