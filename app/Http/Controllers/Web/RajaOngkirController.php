<?php

namespace App\Http\Controllers\Web;

use Auth;
use RajaOngkir;
use App\Service\RajaOngkirService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
	public function getAllProvinces() {
		$provinces = RajaOngkir::provinsi()->all();
		return response($provinces);
	}	

	public function getCities($province_id) {
		$cities = RajaOngkir::kota()->dariProvinsi($province_id)->get();
		return response($cities);
	}
}
