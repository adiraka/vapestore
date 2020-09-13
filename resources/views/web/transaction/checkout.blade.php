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
                    <form method="post" action="{{ route('web.payment') }}">
                        {{ csrf_field() }}
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
                                            <th>IDR {{ number_format($cart::subtotal()) }}</th>
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
                            <p>
                                {{ \App\Service\RajaOngkirService::GetCityName(Auth::user()->detail->city) }}
                                -
                                {{ \App\Service\RajaOngkirService::GetProvinceName(Auth::user()->detail->province) }}
                            </p>
                            <p>{{ Auth::user()->detail->postalCode }}</p>
                            <a href="{{ route('web.account.detail') }}">Edit Address</a>
                        </div>
                        <hr>
                        <h3>Delivery</h3>
                        <br>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach ($courierList as $data)
                                        <div>
                                            <p><strong>{{ $data['name'] }}</strong></p>
                                            @foreach ($data['costs'] as $cost)
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="radio" data-cost="{{ $cost['cost'][0]['value'] }}" name="delivery" value="{{ json_encode($cost) }}" required>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>{{ $cost['description'] }}</td>
                                                            <td>|</td>
                                                            <td>{{ $cost['cost'][0]['etd'] }}</td>
                                                            <td>|</td>
                                                            <td><strong>IDR {{ number_format($cost['cost'][0]['value']) }}</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Total Amount : IDR <span id="total-amount">{{ number_format($cart::total()) }}</span></h3>
                        <input type="hidden" name="grandTotal" id="grand-total" value="{{ $cart::total() }}">
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

@push('scripts')
    <script>
        $(function() {
            $("input[name='delivery']").click(function() {
                let cost = $(this).data('cost');
                let total = parseInt('{{ $cart::total() }}');
                let grand_total = cost + total;

                $('#grand-total').val(grand_total);
                $('#total-amount').empty().append(number_format(grand_total));
            });

            function number_format (number, decimals, decPoint, thousandsSep) { 
             number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
             var n = !isFinite(+number) ? 0 : +number
             var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
             var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
             var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
             var s = ''

             var toFixedFix = function (n, prec) {
              var k = Math.pow(10, prec)
              return '' + (Math.round(n * k) / k)
                .toFixed(prec)
             }

             // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
             s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
             if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
             }
             if ((s[1] || '').length < prec) {
              s[1] = s[1] || ''
              s[1] += new Array(prec - s[1].length + 1).join('0')
             }

             return s.join(dec)
            }
        }); 
    </script>
@endpush