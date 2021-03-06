<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Product;

use Validator;
use DataTables;
use App\Util\Constant;

class ProductController extends Controller
{
	public function index() {
        return view('admin.product.index');
	}

	public function indexData() {
		$listData = Product::select(['*'])->get();
		$dataTables = Datatables::of($listData)
						->addColumn('action', function($product) {
							return '
								<a href="'.route('product.detail', ['id' => $product->id]).'" class="btn btn-xs btn-success">Update</a> &nbsp; 
								<a href="'.route('product.changeStatus', ['id' => $product->id]).'" class="btn btn-xs btn-warning">Change Status</a>	
    						';
						})
						->make(true);
		return $dataTables;
	}

	public function detail($id = 0) {
		if (empty($id)) {
			$product = new Product;
    	} else {
    		$product = Product::find($id);	
    	}
    	
    	if (empty($product)) abort(404);

    	return view('admin.product.detail', [
    		'product' => $product
    	]);
	}

	public function save($id = 0, Request $request) {
		$data = (object)$request->all();

		if (empty($id)) {
			$product = new Product;
    	} else {
    		$product = Product::find($id);	
    	}

    	$product->merk_id = $data->merk_id;
    	$product->type = $data->type;
    	$product->code = $data->code;
    	$product->name = $data->name;
    	$product->description = $data->description;
    	$product->category = $data->category;

    	if (empty($id)) {
			$product->status = Constant::STATUS_ACTIVE;
    	}
    	
    	if (!empty($data->thumbnail)) {
			$thumbnailName = time().'.'.$request->thumbnail->extension();  
	    	$upload = $request->thumbnail->move(public_path('upload'), $thumbnailName);

	    	if ($upload) {
	    		$product->thumbnail = $thumbnailName;
	    	}
        }

    	$product->save();

    	return redirect()->route('product.detail', ['id' => $product->id]);
	}

	public function changeStatus($id = 0) {
		if (empty($id)) {
			return redirect()->back()->withErrors([
				'Product ID cannnot be NULL!'
			]);
		}

		$product = Product::find($id);

		if ($product->status == Constant::STATUS_ACTIVE) {
			$product->status = Constant::STATUS_INACTIVE;
		} else if ($product->status == Constant::STATUS_INACTIVE) {
			$product->status = Constant::STATUS_ACTIVE;
		}

		$product->save();

		return redirect()->back()->with([
			'Product status has been updated!'
		]);
	}
}
