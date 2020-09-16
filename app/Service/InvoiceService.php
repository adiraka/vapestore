<?php

namespace App\Service;

use App\Model\Invoice;
use App\Util\Constant;

use App\Service\OrderService;

class InvoiceService
{
	public static function UpdateStatus(Invoice $invoice, $newStatus) {
		if ($invoice->status == $newStatus) return;

		$invoice->status = $newStatus;
		$invoice->save();

		if ($newStatus == Constant::INVOICE_STATUS_PAID) {
			OrderService::UpdateStatus($invoice->order, Constant::ORDER_STATUS_PACKING);
		} else if ($newStatus == Constant::INVOICE_STATUS_EXPIRED) {
			OrderService::UpdateStatus($invoice->order, Constant::ORDER_STATUS_CANCELLED);
		}

		return $invoice;
	}
}
