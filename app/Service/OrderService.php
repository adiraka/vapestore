<?php

namespace App\Service;

use App\Model\Order;

use App\Util\Constant;

class OrderService
{
	public static function UpdateStatus(Order $order, $newStatus) {
		if ($order->status == $newStatus) return;

		$oldStatus = $order->status;

		$order->status = $newStatus;
		$order->save();

		if ($oldStatus == Constant::ORDER_STATUS_PAYMENT && $newStatus == Constant::ORDER_STATUS_PACKING) {

		} elseif ($oldStatus == Constant::ORDER_STATUS_PACKING && $newStatus == Constant::ORDER_STATUS_SEND) {

		} elseif ($oldStatus == Constant::ORDER_STATUS_SEND && $newStatus == Constant::ORDER_STATUS_COMPLETED) {

		} elseif ($oldStatus == Constant::ORDER_STATUS_PAYMENT && $newStatus == Constant::ORDER_STATUS_CANCELLED) {

		}

		return $order;
	}
}
