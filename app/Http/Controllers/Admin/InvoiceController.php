<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Invoice;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class InvoiceController extends Controller
{
	public function index() {
        return view('admin.invoice.index');
    }

    public function indexData() {
        $listData = Invoice::select(['*'])->orderBy('id', 'desc');
        $dataTables = Datatables::of($listData)
                        ->addColumn('customer_name', function($invoice) {
                            return $invoice->user->detail->name;
                        })
                        ->editColumn('total_amount', function($invoice) {
                            return number_format($invoice->total_amount);
                        })
                        ->addColumn('action', function($invoice) {
                            return '
                                <a href="'.route('invoice.detail', ['id' => $invoice->id]).'" class="btn btn-xs btn-success">Detail</a>    
                            ';
                        })
                        ->make(true);
        return $dataTables;
    }

    public function detail($id) {
        $invoice = Invoice::find($id);

        if (empty($invoice)) abort(404);
        
        return view('admin.invoice.detail', [
            'invoice' => $invoice
        ]);
    }
}
