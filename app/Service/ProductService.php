<?php

namespace App\Service;

use App\Model\Product;
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
}
