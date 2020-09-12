<?php

namespace App\Service;

use Cart;
use App\Model\Product;
use App\Model\Varian;
use App\Util\Constant;

class ProductService
{
	public static function SetPriceRange($product) {
		$result = '';
		$minPrice = $product->varians->min('price');
		$maxPrice = $product->varians->max('price');

		if ($minPrice == $maxPrice) {
			$result = 'IDR '.number_format($minPrice);
		} else {
			$result = 'IDR'.number_format($minPrice).' - '.number_format($maxPrice);
		}

		return $result;
	}

	public static function CheckQty($varian_id, $qty) {
		$flag = true;
		$varian = Varian::find($varian_id);

		if ($varian->quantity < $qty) {
			$flag = false;
		}

		return $flag;
	}

	public static function GetTotalWeight() {
		$carts = Cart::content();
		$weight = 1;
		foreach ($carts as $cart) {
			if ($cart->options->weight > 0) {
				$weight += $cart->options->weight;
			}
		}

		return $weight;
	}
}
