@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">Checkout</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div id="checkout" class="col-lg-12">
                <div class="box">
                    <form method="post" action="checkout4.html">
                        <h3>Checkout</h3>
                        <hr>
                        <h3>Order review</h3>
                        <br>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Varian</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartList as $product)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('web.product.detail', ['id' => $product->options['product']['id']]) }}"><img src="{{ asset('upload/'. $product->options->image) }}" alt="White Blouse Armani"></a>
                                                </td>
                                                <td><a href="{{ route('web.product.detail', ['id' => $product->options['product']['id']]) }}">{{ $product->name }}</a></td>
                                                <td>{{ $product->options->size }}</td>
                                                <td>
                                                    {{ $product->qty }}
                                                </td>
                                                <td>{{ number_format($product->price) }}</td>
                                                <td>{{ number_format($product->price * $product->qty) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th>IDR {{ $cart::subtotal() }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h3>Address</h3>
                        <br>
                        <div class="content">
                            <p><strong>{{ Auth::user()->detail->name }}</strong></p>
                            <p>{{ Auth::user()->detail->address }}</p>
                            <p>{{ 'Kel. '.Auth::user()->detail->subdistrict.' - Kec. '.Auth::user()->detail->district }}</p>
                        </div>
                        <div class="box-footer d-flex justify-content-between">
                            <a href="{{ route('web.cart.list') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-chevron-left"></i>Back to cart
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Place an order<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
 
@endsection