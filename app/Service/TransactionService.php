<?php

namespace App\Service;

use Cart;
use Auth;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Util\Constant;
use App\Service\ProductService;
use Carbon\Carbon;

class TransactionService
{
	public static function createInvoice($total) {
		$invoiceNumber = static::GenerateInvoiceNumber();

		$invoice = new Invoice;
		$invoice->user_id = Auth::user()->id;
		$invoice->invoice_number = $invoiceNumber;
		$invoice->invoice_date = Carbon::now();
		$invoice->total_amount = $total;
		$invoice->status = Constant::INVOICE_STATUS_UNPAID;
		$invoice->save();

		return $invoice;
	}

	public static function createOrder($invoice_id, $courier, $delivery, $grand_total) {
		$orderNumber = static::GenerateOrderNumber();
		$deliveryData = json_decode($delivery);

		$carts = Cart::content();

		$order = new Order;
		$order->invoice_id = $invoice_id;
		$order->user_id = Auth::user()->id;
		$order->order_number = $orderNumber;
		$order->order_date = Carbon::now();
		$order->subtotal = Cart::total();
		$order->courier_name = $courier;
		$order->delivery_amount = $deliveryData->cost[0]->value;
		$order->delivery_type = $deliveryData->service;
		$order->delivery_desc = $deliveryData->description;
		$order->total_amount = $grand_total;
		$order->total_weight = ProductService::GetTotalWeight();
		$order->status = Constant::ORDER_STATUS_PAYMENT;
		$order->save();

		foreach ($carts as $cart) {

			$orderDetail = new OrderDetail;
			$orderDetail->order_id = $order->id;
			$orderDetail->varian_id = $cart->options->id;
			$orderDetail->qty = $cart->qty;
			$orderDetail->price = $cart->price;
			$orderDetail->subtotal = $cart->qty * $cart->price;
			$orderDetail->save();

			ProductService::SubsProductStock($orderDetail->varian_id, $orderDetail->qty);
		}

		Cart::destroy();
		
		return $order;
	}

	public static function GenerateInvoiceNumber(){
        $invoiceNumber = 'INV-'.date('Y-m-d').'-';
        $invoiceCount = Invoice::whereYear('created_at', '=', Carbon::now()->format('Y'))
        							->whereMonth('created_at', '=', Carbon::now()->format('m'))
        							->count();
        $invoiceNumber .= str_pad(($invoiceCount + 1), 6, "0", STR_PAD_LEFT);

	    return $invoiceNumber;
    }

    public static function GenerateOrderNumber(){
        $orderNumber = 'ORDER-'.date('Y-m-d').'-';
        $orderCount = Order::whereYear('created_at', '=', Carbon::now()->format('Y'))
        							->whereMonth('created_at', '=', Carbon::now()->format('m'))
        							->count();
        $orderNumber .= str_pad(($orderCount + 1), 6, "0", STR_PAD_LEFT);

	    return $orderNumber;
    }

}
