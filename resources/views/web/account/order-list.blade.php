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
                <h1>My orders</h1>
                <p class="lead">Your orders on one place.</p>
                <div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
                      			<tr>
                        			<th>Order</th>
                        			<th>Date</th>
                        			<th>Total</th>
                        			<th>Status</th>
                        			<th>Action</th>
                      			</tr>
                    		</thead>
                    		<tbody>
                    			@foreach ($orders as $order)
                    				<tr>
	                        			<th>{{ $order->order_number }}</th>
	                        			<td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
	                        			<td>IDR {{ number_format($order->total_amount) }}</td>
	                        			<td>{{ $order->status }}</td>
	                        			<td><a href="{{ route('web.account.getDetailOrder', ['id' => $order->order_number]) }}" class="btn btn-primary btn-sm">View</a></td>
	                      			</tr>
                    			@endforeach
                    		</tbody>
						</table>
					</div>
					<div class="d-flex justify-content-center">
						{{ $orders->links() }}	
					</div>
				</div>
              </div>
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