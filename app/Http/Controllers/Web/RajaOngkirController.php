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

	public function getOngkir(Request $request) {
		$data = (object)$request->all();

		$ongkir = RajaOngkir::ongkosKirim([
		    'origin'        => $data->origin,     // ID kota/kabupaten asal
		    'destination'   => $data->destination,      // ID kota/kabupaten tujuan
		    'weight'        => $data->weight,    // berat barang dalam gram
		    'courier'       => $data->courier    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
		]);

		return response($ongkir);
	}
}
