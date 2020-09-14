<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Order;
use App\Model\OrderDetail;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class OrderController extends Controller
{
	public function index() {
        return view('admin.order.index');
    }

    public function indexData() {
        $listData = Order::select(['*'])->orderBy('id', 'DESC')->get();
        $dataTables = Datatables::of($listData)
                        ->addColumn('customer_name', function($order) {
                            return $order->user->detail->name;
                        })
                        ->editColumn('total_amount', function($order) {
                            return number_format($order->total_amount);
                        })
                        ->addColumn('action', function($order) {
                            return '
                                <a href="'.route('order.detail', ['id' => $order->id]).'" class="btn btn-xs btn-success">Detail</a>    
                            ';
                        })
                        ->make(true);
        return $dataTables;
    }

    public function detail($id) {
        $order = Order::find($id);

        if (empty($order)) abort(404);
        
        return view('admin.order.detail', [
            'order' => $order
        ]);
    }
}
