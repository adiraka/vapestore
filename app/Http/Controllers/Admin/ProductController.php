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

	public function save($id = 0) {
		
	}
}
