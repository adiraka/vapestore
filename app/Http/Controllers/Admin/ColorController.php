<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Color;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class ColorController extends Controller
{
	public function index() {
        return view('admin.color.index');
    }

    public function indexData() {
    	$listData = Color::select(['*'])->get();
		$dataTables = Datatables::of($listData)
						->addColumn('action', function($color) {
							return '
								<a href="'.route('color.detail', ['id' => $color->id]).'" class="btn btn-xs btn-success">Update</a>				
    						';
						})
						->editColumn('status', function($color) {
							return Constant::STATUS_LABELS[$color->status];
						})
						->make(true);
		return $dataTables;
    }

    public function detail($id = 0) {
    	if (empty($id)) {
			$color = new Color;
    	} else {
    		$color = Color::find($id);	
    	}
    	
    	if (empty($color)) abort(404);

    	return view('admin.color.detail', [
    		'color' => $color
    	]);
    }

    public function save($id = 0, Request $request) {
    	$data = (object)$request->all();

    	if (empty($id)) {
			$color = new Color;
    	} else {
    		$color = Color::find($id);	
    	}
    	
    	if (empty($color)) abort(404);

    	$request->validate([
            'code' => 'required',
    		'name' => 'required'
        ]);

    	$color->code = $data->code;
	    $color->name = $data->name;
	    $color->status = Constant::STATUS_ACTIVE;

    	$color->save();

    	return redirect()->route('color.index');
    }

    public function find(Request $request) {
        $term = trim($request->q);

        if (empty($term)) {
            return Response::json([]);
        }

        $colors = Color::where('name', 'LIKE', '%'.$term.'%')->get();

        $formatted_colors = [];

        foreach ($colors as $color) {
            $formatted_colors[] = ['id' => $color->id, 'text' => $color->name];
        }

        return Response::json($formatted_colors);
    }
}
