<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style type="text/css">
    	.small-font {
    		font-size: 7pt;
    	}
    </style>
  </head>
  <body>
  	<div class="row">
  		<div class="col-md-12 text-center">
  			<strong>ORDER MONTHLY REPORT</strong> <br>
  			<strong>{{ $month.' '.$year }}</strong>
  		</div>		
  	</div>
  	<br><br>
		<div class="row small-font">
			<div class="col-md-12">
				<table class="table table-bordered">
		    	<thead>
		      	<tr>
		      		<th rowspan="2" class="text-center align-middle">ORDER DATE</th>
		      		<th rowspan="2" class="text-center align-middle">NAME</th>
		      		<th rowspan="2" class="text-center align-middle">ADDRESS</th>
		      		<th colspan="5" class="text-center">PRODUCTS</th>
		      		<th rowspan="2" class="text-center align-middle">SUBTOTAL</th>
		      		<th rowspan="2" class="text-center align-middle">SHIPPING</th>
		      		<th rowspan="2" class="text-center align-middle">TOTAL</th>
		      	</tr>
		      	<tr>
		      		<th class="text-center">Name</th>
		      		<th class="text-center">Varian</th>
		      		<th class="text-center">Price @</th>
		      		<th class="text-center">Qty</th>
		      		<th class="text-center">Subtotal</th>
		      	</tr>
		      </thead>
		      <tbody>
		      	@foreach ($orders as $order)
		      		<tr>
		      			<td class="align-middle" rowspan="{{ count($order->detail) }}">
		      				{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
		      			</td>
		      			<td class="align-middle" rowspan="{{ count($order->detail) }}">
		      				{{ $order->user->detail->name }}
		      			</td>
		      			<td class="align-middle" rowspan="{{ count($order->detail) }}">
		      				{{ $order->user->detail->address }} <br>
		      				Kel. {{ $order->user->detail->subdistrict }} <br> 
		      				Kec. {{ $order->user->detail->district }} <br>
		      				{{ \App\Service\RajaOngkirService::GetCityName($order->user->detail->city) }} <br>
                  {{ \App\Service\RajaOngkirService::GetProvinceName($order->user->detail->province) }} <br>
                  {{ $order->user->detail->postalCode }}
		      			</td>
		      			<td class="align-middle">
		      				{{ $order->detail[0]->varian->product->name }}
		      			</td>
		      			<td class="align-middle">
		      				{{ $order->detail[0]->varian->size }}
		      			</td>
		      			<td class="text-center align-middle">
		      				{{ number_format($order->detail[0]->price) }}
		      			</td>
		      			<td class="text-center align-middle">
		      				{{ $order->detail[0]->qty }}
		      			</td>
		      			<td class="text-center align-middle">
		      				{{ number_format($order->detail[0]->subtotal) }}
		      			</td>
		      			<td class="align-middle text-center" rowspan="{{ count($order->detail) }}">
		      				<strong>{{ number_format($order->subtotal) }}</strong>
		      			</td>
		      			<td class="align-middle text-center" rowspan="{{ count($order->detail) }}">
		      				<strong>{{ number_format($order->delivery_amount) }}</strong>
		      			</td>
		      			<td class="align-middle text-center" rowspan="{{ count($order->detail) }}">
		      				<strong>{{ number_format($order->total_amount) }}</strong>
		      			</td>
		      		</tr>
		      		@foreach ($order->detail as $key => $detail)
		      			@if ($key != 0)
		      				<tr>
		      					<td class="align-middle">
				      				{{ $detail->varian->product->name }}
				      			</td>
				      			<td class="align-middle">
				      				{{ $detail->varian->size }}
				      			</td>
				      			<td class="text-center align-middle">
				      				{{ number_format($detail->price) }}
				      			</td>
				      			<td class="text-center align-middle">
				      				{{ $detail->qty }}
				      			</td>
				      			<td class="text-center align-middle">
				      				{{ number_format($detail->subtotal) }}
				      			</td>
		      				</tr>
		      			@endif
		      		@endforeach
		      	@endforeach
		      </tbody>
		      <tfoot>
		      	<tr>
		      		<td colspan="10"><strong>GRAND TOTAL</strong></td>
		      		<td class="text-center"><strong>IDR {{ number_format($orders->sum('total_amount')) }}</strong></td>
		      	</tr>
		      </tfoot>
		    </table>
			</div>		
		</div>
  </body>
</html>