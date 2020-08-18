<?php

namespace App\Http\Controllers\Web;

use App\Model\Product;
use App\Service\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Util\Constant;

class ProductController extends Controller
{
	public function getCategoryList($category = '') {
		$categoryName = Constant::ALL_TYPE_LABEL[$category];
		$categoryDescription = Constant::ALL_TYPE_DESCRIPTION_LABEL[$category];

		return view('web.product.category', [
			'category' => $category,
			'categoryName' => $categoryName,
			'categoryDescription' => $categoryDescription
		]);
	}

	public function getProductList(Request $request) {
		$data = (object)$request->all();

		$page = isset($data->page) ? $data->page : 1;
		$limit = isset($data->limit) ? $data->limit : 10;

		$products = Product::where('status', Constant::STATUS_ACTIVE);

		if (isset($data->category)) {
			$products = $products->where('type', $data->category);
		}

		if (isset($data->orderBy)) {
			foreach ($data->orderBy as $column => $order) {
				$products = $products->orderBy($column, $order);
			}
		}
					
		$products = $products->limit($limit)->offset(($page - 1) * $limit)->get();

		foreach ($products as $key => $product) {
			$parsedData = ProductService::SetPriceRange($product);
			$product->priceRange = $parsedData;
			unset($product['varians']);
			$products[$key] = $product;
		}

		$allProducts = Product::count();

		$totalPage = ceil($allProducts / $limit);

		$prevPage = ($page == 1) ? 1 : ($page-1);
		$nextPage = ($page == $totalPage) ? $totalPage : ($page+1);

		return response([
			'data' => $products,
			'prevPage' => $prevPage,
			'page' => $page,
			'nextPage' => $nextPage,
			'dataPerPage' => $limit,
			'totalPage' => $totalPage,
		]);
	}

	public function getVarianDetail($id) {

	}
}
