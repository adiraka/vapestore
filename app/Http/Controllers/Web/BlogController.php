<?php

namespace App\Http\Controllers\Web;

use App\Model\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
	public function getBlogList() {
		$blogs = Blog::simplePaginate(12);

		return view('web.blog.list', [
			'blogs' => $blogs
		]);
	}

	public function getBlogDetail($id) {
		$blog = Blog::find($id);

		if (empty($blog)) abort('404');

		return view('web.blog.detail', [
			'blog' => $blog
		]);
	}
}
