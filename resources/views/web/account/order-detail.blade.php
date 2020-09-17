@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">Account</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="card sidebar-menu">
					<div class="card-header">
						<h3 class="h4 card-title">Customer</h3>
					</div>
					<div class="card-body">
						<ul class="nav nav-pills flex-column">
							<a href="{{ route('web.account.detail') }}" class="nav-link"><i class="fa fa-user"></i> My account</a>
							<a href="{{ route('web.account.getListOrder') }}" class="nav-link active"><i class="fa fa-list"></i> My orders</a>
							<a href="{{ route('web.logout') }}" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a>
						</ul>
					</div>
				</div>
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>Order Detail</h1>
                <p class="lead">
                	{{ $order->order_number }} - [<strong>{{ $order->status }}</strong>] 
                	@if ($order->status == \App\Util\Constant::ORDER_STATUS_SEND)
                		<br><br> Courier : <strong>{{ $order->courier_name }}</strong>
                		<br> Receipt No. : <strong>{{ $order->delivery_receipt }}</strong>
                	@endif
                </p>
				<div class="table-responsive mb-4">
					<table class="table">
						<thead>
							<tr>
								<th colspan="2">Product</th>
								<th>Varian</th>
								<th>Unit price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($order->detail as $detail)
								<tr>
									<td><a href="#"><img src="{{ asset('upload/'. $detail->varian->image) }}" alt="{{ $detail->varian->product->name }}" height="50px" width="50px"></a></td>
									<td><a href="#">{{ $detail->varian->product->name }}</a></td>
									<td>{{ $detail->varian->size }}</td>
									<td>IDR {{ number_format($detail->price) }}</td>
									<td>{{ $detail->qty }}</td>
									<td>IDR {{ number_format($detail->subtotal) }}</td>
								</tr>
							@endforeach
						</tbody>
							<tfoot>
								<tr>
									<th colspan="5" class="text-right">Order subtotal</th>
									<th>IDR {{ number_format($order->subtotal) }}</th>
								</tr>
								<tr>
									<th colspan="5" class="text-right">Shipping and handling</th>
									<th>IDR {{ number_format($order->delivery_amount) }}</th>
								</tr>
								<tr>
									<th colspan="5" class="text-right">Total</th>
									<th>IDR {{ number_format($order->total_amount) }}</th>
								</tr>
							</tfoot>
					</table>
                </div>
                <div class="text-right">
                	@if ($order->status == \App\Util\Constant::ORDER_STATUS_SEND)
                		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmationModal">Order Received ?</button>
                	@endif
                </div>
              </div>
            </div>
		</div>
	</div>

	<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('web.account.confirmationOrder') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="order_id" value="{{ $order->id }}">
					<input type="hidden" name="status" value="{{ \App\Util\Constant::ORDER_STATUS_COMPLETED }}">
					<div class="modal-header">
						<h5 class="modal-title" id="confirmationModalLabel">Order Received ?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Are you sure to confirm this order and verify the product has arrived ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
 
@endsection

@push('scripts')
	<script>
		$(function() {

		});	
	</script>
@endpush