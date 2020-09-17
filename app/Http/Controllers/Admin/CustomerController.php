<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class CustomerController extends Controller
{
	public function index() {
        return view('admin.customer.index');
    }

    public function indexData() {
    	$listData = User::select(['*'])->where('role', Constant::USER_ROLE_CUSTOMER)->orderBy('id', 'desc');
		$dataTables = Datatables::of($listData)
						->addColumn('action', function($user) {
							return '
								<a href="'.route('customer.detail', ['id' => $user->id]).'" class="btn btn-xs btn-success">Detail</a>	
    						';
						})
						->make(true);
		return $dataTables;
    }

    public function detail($id) {
        $user = User::has('detail')->find($id);

        if (empty($user)) abort('404');

        return view('admin.customer.detail', [
            'user' => $user
        ]);
    }
}
