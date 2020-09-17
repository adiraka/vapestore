<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Invoice;
use App\Service\MidtransService;
use App\Service\InvoiceService;

use Response;
use Validator;
use DataTables;
use App\Util\Constant;

class MidtransController extends Controller
{
    public function status($id) {
        $status = MidtransService::status($id);

        if (isset($status->transaction_status)) {
            if ($status->transaction_status == 'capture' || $status->transaction_status == 'settlement') {
                $invoice = Invoice::where('invoice_number', $id)->first();
                InvoiceService::UpdateStatus($invoice, Constant::INVOICE_STATUS_PAID);
            }
        }

        return redirect()->back();
    }

    public function reject($id) {
        $reject = MidtransService::cancel($id);

        if ($reject == '200') {
            $invoice = Invoice::where('invoice_number', $id)->first();
            InvoiceService::UpdateStatus($invoice, Constant::INVOICE_STATUS_EXPIRED);
        }
        
        return redirect()->back();
    }

    public function approve($id) {
        // $approve = MidtransService::approve($id);
        // dd($approve);
        // if ($reject == '200') {
        //     $invoice = Invoice::where('invoice_number', $id)->first();
        //     InvoiceService::UpdateStatus($invoice, Constant::INVOICE_STATUS_EXPIRED);
        // }
        
        // return redirect()->back();
    }
}
