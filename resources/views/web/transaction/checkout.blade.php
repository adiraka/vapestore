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
                        <h1>Checkout - Order review</h1>
                        <br><br>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#"><img src="img/detailsquare.jpg" alt="White Blouse Armani"></a></td>
                                            <td><a href="#">White Blouse Armani</a></td>
                                            <td>2</td>
                                            <td>$123.00</td>
                                            <td>$0.00</td>
                                            <td>$246.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th>$446.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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