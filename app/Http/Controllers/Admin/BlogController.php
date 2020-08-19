<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Blog;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class BlogController extends Controller
{
	public function index() {
        return view('admin.blog.index');
    }

    public function indexData() {
    	$listData = Blog::select(['*'])->get();
		$dataTables = Datatables::of($listData)
						->addColumn('action', function($blog) {
							return '
								<a href="'.route('blog.detail', ['id' => $blog->id]).'" class="btn btn-xs btn-success">Update</a>		
                                <a href="'.route('blog.changeStatus', ['id' => $blog->id]).'" class="btn btn-xs btn-warning">Change Status</a>    		
    						';
						})
						->editColumn('status', function($blog) {
							return Constant::BLOG_STATUS_LIST[$blog->status];
						})
						->make(true);
		return $dataTables;
    }

    public function detail($id = 0) {
    	if (empty($id)) {
			$blog = new Blog;
    	} else {
    		$blog = Blog::find($id);	
    	}
    	
    	if (empty($blog)) abort(404);

    	return view('admin.blog.detail', [
    		'blog' => $blog
    	]);
    }

    public function save($id = 0, Request $request) {
    	$data = (object)$request->all();

    	if (empty($id)) {
			$blog = new Blog;
    	} else {
    		$blog = Blog::find($id);	
    	}
    	
    	if (empty($blog)) abort(404);

    	$request->validate([
            'title' => 'required',
            'synopsis' => 'required',
    		'content' => 'required',
    		'status' => 'required'
        ]);

        if (!empty($data->thumbnail)) {
			$thumbnailName = time().'.'.$request->thumbnail->extension();  
	    	$upload = $request->thumbnail->move(public_path('upload'), $thumbnailName);

	    	if ($upload) {
	    		$blog->thumbnail = $thumbnailName;
	    	}
        }

    	$blog->title = $data->title;
        $blog->synopsis = $data->synopsis;
	    $blog->content = $data->content;
	    $blog->status = $data->status;

    	$blog->save();

    	return redirect()->route('blog.index');
    }

    public function changeStatus($id = 0) {
        if (empty($id)) {
            return redirect()->back()->withErrors([
                'Blog ID cannnot be NULL!'
            ]);
        }

        $blog = Blog::find($id);

        if ($blog->status == Constant::BLOG_STATUS_PUBLISHED) {
            $blog->status = Constant::BLOG_STATUS_UNPUBLISHED;
        } else if ($blog->status == Constant::BLOG_STATUS_UNPUBLISHED) {
            $blog->status = Constant::BLOG_STATUS_PUBLISHED;
        }

        $blog->save();

        return redirect()->back()->with([
            'Blog status has been updated!'
        ]);
    }
}
