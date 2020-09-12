<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Varian;

use Validator;
use DataTables;
use App\Util\Constant;

class VarianController extends Controller
{
	public function indexData($productId) {
		$listData = Varian::select(['*'])->where('product_id', $productId)->get();
		$dataTables = Datatables::of($listData)
						->addColumn('action', function($varian) {
							return '
								<a href="'.route('varian.detail', ['id' => $varian->id, 'productId' => $varian->product->id]).'" class="btn btn-xs btn-success">Update</a> &nbsp;
								<a href="'.route('varian.changeStatus', ['id' => $varian->id]).'" class="btn btn-xs btn-warning">Change Status</a>
    						';
						})
						->editColumn('price', function($varian) {
							return number_format($varian->price);
						})
						->make(true);
		return $dataTables;
	}

	public function detail($id = 0, $productId = 0) {
		if ($productId == 0) {
			return redirect()->back()->withErrors([
				'Product Id Cannot be NULL!'
			]);
		}

		if (empty($id)) {
			$varian = new Varian;
    	} else {
    		$varian = Varian::find($id);	
    	}
    	
    	if (empty($varian)) abort(404);

    	return view('admin.varian.detail', [
    		'varian' => $varian,
    		'productId' => $productId
    	]);
	}

	public function save($id = 0, $productId = 0, Request $request) {
		if ($productId == 0) {
			return redirect()->back()->withErrors([
				'Product Id Cannot be NULL!'
			]);
		}

		$data = (object)$request->all();

		if (empty($id)) {
			$varian = new Varian;
    	} else {
    		$varian = Varian::find($id);	
    	}

    	$varian->product_id = $productId;
    	$varian->color_id = @$data->color_id;
    	$varian->size = $data->size;
    	$varian->volume = @$data->volume;
    	$varian->weight = @$data->weight;
    	$varian->nicotin = @$data->nicotin;
    	$varian->quantity = @$data->quantity;
    	$varian->price = $data->price;

    	if (empty($id)) {
			$varian->status = Constant::STATUS_ACTIVE;
    	}

    	if (!empty($data->image)) {
			$imageName = time().'.'.$request->image->extension();  
	    	$upload = $request->image->move(public_path('upload'), $imageName);

	    	if ($upload) {
	    		$varian->image = $imageName;
	    	}
        }

        $varian->save();

        return redirect()->route('product.detail', ['id' => $productId])->with([
        	'Success add product varian!'
        ]);
	}

	public function changeStatus($id = 0) {
		if (empty($id)) {
			return redirect()->back()->withErrors([
				'Varian ID cannnot be NULL!'
			]);
		}

		$varian = Varian::find($id);

		if ($varian->status == Constant::STATUS_ACTIVE) {
			$varian->status = Constant::STATUS_INACTIVE;
		} else if ($varian->status == Constant::STATUS_INACTIVE) {
			$varian->status = Constant::STATUS_ACTIVE;
		}

		$varian->save();

		return redirect()->back()->with([
			'Product Varian status has been updated!'
		]);
	}
}
