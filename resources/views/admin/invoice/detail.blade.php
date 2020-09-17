@extends('adminlte::page')

@section('title', 'Invoice')

@section('content_header')
    <h1>Invoice</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					Invoice Detail
					<a href="{{ route('invoice.index') }}" class="btn btn-sm btn-default float-right">List Invoices</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table>
								<tr>
									<th>Invoice Number</th>
									<td>&nbsp;</td>
									<td>{{ $invoice->invoice_number }}</td>
								</tr>
								<tr>
									<th>Invoice Date</th>
									<td>&nbsp;</td>
									<td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>&nbsp;</td>
									<td>{{ $invoice->user->email }}</td>
								</tr>
								<tr>
									<th>Name</th>
									<td>&nbsp;</td>
									<td>{{ $invoice->user->detail->name }}</td>
								</tr>
								<tr>
									<th>Phone</th>
									<td>&nbsp;</td>
									<td>{{ $invoice->user->detail->phone }}</td>
								</tr>
								<tr>
									<th>Order Number</th>
									<td>&nbsp;</td>
									<td><a href="{{ route('order.detail', ['id' => $invoice->order->id]) }}" target="_blank">{{ $invoice->order->order_number }}</a></td>
								</tr>
								<tr>
									<th>Total Amount</th>
									<td>&nbsp;</td>
									<td>IDR {{ number_format($invoice->order->total_amount) }}</td>
								</tr>
								<tr>
									<th>Status</th>
									<td>&nbsp;</td>
									<td>{{ $invoice->status }}</td>
								</tr>
							</table>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-md-12">
							@if ($invoice->status == \App\Util\Constant::INVOICE_STATUS_UNPAID && $invoice->order->status == \App\Util\Constant::ORDER_STATUS_PAYMENT)
								<a href="{{ route('midtrans.reject', ['id' => $invoice->invoice_number]) }}" class="btn btn-danger">Reject Payment</a>
								<a href="{{ route('midtrans.status', ['id' => $invoice->invoice_number]) }}" class="btn btn-success">Check Status Payment</a>
							@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')

@section('js')
	<script>
		$(function() {

		});
	</script>
@stop

