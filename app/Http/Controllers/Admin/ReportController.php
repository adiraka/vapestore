<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Order;

use Validator;
use DataTables;
use App\Util\Constant;

class ReportController extends Controller
{
	public function index() {
		return 'report page';
	}
}
