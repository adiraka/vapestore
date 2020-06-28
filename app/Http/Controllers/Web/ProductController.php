<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function getCategoryList($category = '') {
		return view('web.product.category');
	}
}
