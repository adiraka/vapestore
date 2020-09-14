\@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
    <h1>Order</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					Order Detail
					<a href="{{ route('order.index') }}" class="btn btn-sm btn-default float-right">List Orders</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table>
								<tr>
									<th>Order Number</th>
									<td>&nbsp;</td>
									<td>{{ $order->order_number }}</td>
								</tr>
								<tr>
									<th>Order Date</th>
									<td>&nbsp;</td>
									<td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>&nbsp;</td>
									<td>{{ $order->user->email }}</td>
								</tr>
								<tr>
									<th>Name</th>
									<td>&nbsp;</td>
									<td>{{ $order->user->detail->name }}</td>
								</tr>
								<tr>
									<th>Phone</th>
									<td>&nbsp;</td>
									<td>{{ $order->user->detail->phone }}</td>
								</tr>
								<tr>
									<th>Status</th>
									<td>&nbsp;</td>
									<td>{{ $order->status }}</td>
								</tr>
							</table>
							<hr>
							<table>
								<tr>
									<th>Invoice Number</th>
									<td>&nbsp;</td>
									<td>{{ $order->invoice->invoice_number }}</td>
								</tr>
								<tr>
									<th>Invoice Date</th>
									<td>&nbsp;</td>
									<td>{{ \Carbon\Carbon::parse($order->invoice->invoice_date )->format('d M Y') }}</td>
								</tr>
							</table>
							<hr>
							<table>
								<tr>
									<th>Delivery Method</th>
									<td>&nbsp;</td>
									<td>{{ $order->courier_name }}</td>
								</tr>
								<tr>
									<th>Address</th>
									<td>&nbsp;</td>
									<td>{{ $order->user->detail->address }}</td>
								</tr>
								<tr>
									<th></th>
									<td>&nbsp;</td>
									<td>
										Kel. {{ $order->user->detail->subdistrict }} - Kec. {{ $order->user->detail->district }}
									</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;</td>
									<td>
										{{ \App\Service\RajaOngkirService::GetCityName($order->user->detail->city) }}
                                		-
                                		{{ \App\Service\RajaOngkirService::GetProvinceName($order->user->detail->province) }}
									</td>	
								</tr>
								<tr>
									<th>Postal Code</th>
									<td>&nbsp;</td>
									<td>{{ $order->user->detail->postalCode }}</td>
								</tr>
							</table>
							<hr>
						</div>
						<div class="col-md-12">
							
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

