<?php

namespace App\Service;

use Auth;
use RajaOngkir;
use App\Util\Constant;

class RajaOngkirService
{
	public static function GetProvinceName($province_id) {
		$province = RajaOngkir::provinsi()->find($province_id);
		return $province['province'];
	}

	public static function GetCityName($city_id) {
		$city = RajaOngkir::kota()->find($city_id);
		return $city['type'].' '.$city['city_name'];
	}

	public static function getListCourier() {
		$result = [];
		$totalWeight = ProductService::GetTotalWeight();

		foreach (Constant::COURIER_LABEL as $key => $value) {
			$amount = static::getAmount($totalWeight, $key);
			$result[] = $amount[0];
		}

		return $result;
	}

	public static function getAmount($weight, $courier) {
		$ongkir = RajaOngkir::biaya([
		    'origin'        => '318',   
		    'destination'   => Auth::user()->detail->city,
		    'weight'        => $weight,
		    'courier'       => $courier 
		])->get();

		return $ongkir;
	}
}
