@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
    <h1>Order</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<div class="card">
				<div class="card-header">
					<strong>ORDER DETAIL</strong>
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
									<td><strong>{{ $order->status }}</strong></td>
								</tr>
							</table>
							<hr>
							<table>
								<tr>
									<th>Invoice Number</th>
									<td>&nbsp;</td>
									<td><a href="{{ route('invoice.detail', ['id' => $order->invoice->id]) }}" target="_blank">{{ $order->invoice->invoice_number }}</a></td>
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
									<th>Delivery Method </th>
									<td>&nbsp;</td>
									<td>{{ $order->courier_name }}</td>
								</tr>
								@if ($order->status == \App\Util\Constant::ORDER_STATUS_SEND)
									<tr>
										<th>Receipt No.</th>
										<td>&nbsp;</td>
										<td>{{ $order->delivery_receipt }}</td>
									</tr>
								@endif
								<tr>
									<td colspan="3">&nbsp;</td>
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
							<p><strong>DETAILS</strong></p>
							<br>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Varian Id</th>
										<th>Product Name</th>
										<th>Product Varian</th>
										<th class="text-center">Price (@)</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Total</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($order->detail as $detail)
										<tr>
											<td>{{ $detail->varian->id }}</td>
											<td>{{ $detail->varian->product->name }}</td>
											<td>{{ $detail->varian->size }}</td>
											<td class="text-center">{{ number_format($detail->price) }}</td>
											<td class="text-center">{{ $detail->qty }}</td>
											<td class="text-center">{{ number_format($detail->subtotal) }}</td>
										</tr>
									@endforeach
									<tr>
										<td colspan="5">Subtotal</td>
										<td class="text-center">{{ number_format($order->subtotal) }}</td>
									</tr>
									<tr>
										<td colspan="5">Delivery Cost</td>
										<td class="text-center">{{ number_format($order->delivery_amount) }}</td>
									</tr>
									<tr>
										<td colspan="5"><strong>TOTAL</strong></td>
										<td class="text-center"><strong>{{ number_format($order->total_amount) }}</strong></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<br>
							@if ($order->status == \App\Util\Constant::ORDER_STATUS_PACKING)
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendOrder">SEND ORDER</button>
							@elseif ($order->status == \App\Util\Constant::ORDER_STATUS_PAYMENT)

							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="sendOrder" tabindex="-1" role="dialog" aria-labelledby="sendOrderLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('order.changeStatus') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="order" value="{{ $order->id }}">
					<input type="hidden" name="status" value="{{ \App\Util\Constant::ORDER_STATUS_SEND }}">
					<div class="modal-header">
						<h5 class="modal-title" id="sendOrderLabel">Send Order</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Please input delivery receipt before change order status to <strong>SEND</strong></p>
						<div class="form-group">
                        	<label for="code" class="control-label">Delivery Receipt :</label>
                        	<input class="form-control" type="text" name="delivery_receipt"></input>
                    	</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">SEND</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')

