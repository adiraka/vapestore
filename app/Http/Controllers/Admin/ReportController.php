<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Order;

use Carbon\Carbon;
use PDF;
use Validator;
use DataTables;
use App\Util\Constant;

class ReportController extends Controller
{
	public function index() {
		return view('admin.report.index');
	}

	public function generateOrderMonthlyReport(Request $request) {
		$data = (object)$request->all();

		$orders = Order::where('status', Constant::ORDER_STATUS_COMPLETED)
							->whereMonth('order_date', '=', $data->month)
							->whereYear('order_date', '=', $data->year)
							->get();

		$pdf = PDF::loadView('pdf.order-monthly', [
			'orders' => $orders,
			'month' => Constant::MONTH_LABEL[$data->month],
			'year' => $data->year
		])->setPaper('a4', 'landscape');;

     	return $pdf->stream('order-report-'.Carbon::now()->format("Ymd-His").'.pdf');
	}
}
