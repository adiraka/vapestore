<?php

namespace App\Service;

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
}
