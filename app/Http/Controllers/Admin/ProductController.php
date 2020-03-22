<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

	}

	public function data() {
		
	}

	public function detail($id = 0) {
		if (empty($id)) {
			$antrian = new Antrian;
    	} else {
    		$antrian = Antrian::find($id);	
    	}
    	
    	if (empty($antrian)) abort(404);

    	return view('antrian.detail', [
    		'antrian' => $antrian,
    		'listPasien' => Pasien::all()
    	]);
	}

	public function save($id = 0) {
		if (empty($id)) {
			$antrian = new Antrian;
    	} else {
    		$antrian = Antrian::find($id);	
    	}
    	
    	if (empty($antrian)) abort(404);

    	$validator = Validator::make(request()->all(), [
    		'pasien_id' => 'required',
    		'tanggal' => 'required',
    		'daftar' => 'required',
    		'layanan' => 'required',
    		'selesai' => 'required',
    	]);

    	if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

    	$data = (object)request()->all();

    	$antrian->pasien_id = $data->pasien_id;
    	$antrian->tanggal = $data->tanggal;
    	$antrian->daftar = $data->daftar;
    	$antrian->layanan = $data->layanan;
    	$antrian->selesai = $data->selesai;
    	$antrian->save();

    	return redirect()->route('antrian.index');
	}
}
