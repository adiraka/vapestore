@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">Shopping Cart</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div id="basket" class="col-lg-12">
              <div class="box">
                <form method="post" action="{{ route('web.cart.update') }}">
                    {{ csrf_field() }}
                    <h1>Shopping cart</h1>
                    <p class="text-muted">You currently have {{ $cartList->count() }} item(s) in your cart.</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Varian</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th colspan="2">Total</th>
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
                                            <input type="hidden" name="rowId[]" value="{{ $product->rowId }}">
                                            <input type="hidden" name="varianId[]" value="{{ $product->options->id }}">
                                            <input type="hidden" name="productName[]" value="{{ $product->name }}">
                                            <input type="number" name="qty[]" value="{{ $product->qty }}" class="form-control">
                                        </td>
                                        <td>{{ number_format($product->price) }}</td>
                                        <td>{{ number_format($product->price * $product->qty) }}</td>
                                        <td><a href="{{ route('web.cart.remove', ['id' => $product->rowId]) }}"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total</th>
                                    <th colspan="2">IDR {{ $cart::subtotal() }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                        <div class="left">
                            <a href="{{ route('web.homePage') }}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                        </div>
                        <div class="right">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fa fa-refresh"></i> Update cart
                            </button>
                            <a href="{{ route('web.checkout') }}" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </form>
              </div>
            </div>
		</div>
	</div>
 
@endsection