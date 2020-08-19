@extends('web.template.layout')
@inject('constant', 'App\Util\Constant')
 
@section('content')
 
	<div class="container">
        <div class="row">                       
            <div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ route('web.category.list', ['category' => $product->type]) }}">{{ $constant::ALL_TYPE_LABEL[$product->type] }}</a></li>
						<li aria-current="page" class="breadcrumb-item active">{{ $product->name }}</li>
					</ol>
				</nav>
            </div>
            <div class="col-lg-12">
              <div id="productMain" class="row">
                <div class="col-md-6">
                  <img src="{{ asset('upload/'. $product->thumbnail) }}" alt="" class="img-fluid display-image">
                </div>
                <div class="col-md-6">
                  <div class="box">
                    <h1 class="text-center">{{ $product->name }}</h1>
                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material &amp; care and sizing</a></p>
                    <p class="price">-</p>
                    <p class="text-center">Stock : <span class="stock">-</span></p>
                    <div>
                    	<select name="sort-by" class="form-control varianId">
							<option value="">-- SELECT VARIAN FIRST --</option>
							@foreach ($product->varians as $varian)
								<option value="{{ $varian->id }}">{{ $varian->size }}</option>
							@endforeach
						</select>
                    </div>
                    <br><br>
                    <p class="text-center buttons"><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a></p>
                  </div>
                </div>
              </div>
              <div id="details" class="box">
              	<strong>Description Product :</strong> <hr>
              	{!! $product->description !!}
              </div>
              <div class="box">
              	<strong>Varian Detail :</strong> <br><br>
              	<div class="varian-detail-content">
					<table class="table table-bordered">
						<tr>
							<td width="25%">Varian/Size</td>
							<td class="varian-name"></td>
						</tr>
						<tr>
							<td width="25%">Color</td>
							<td class="varian-color"></td>
						</tr>
						<tr>
							<td width="25%">Volume</td>
							<td class="varian-volume"></td>
						</tr>
						<tr>
							<td width="25%">Nicotine</td>
							<td class="varian-nicotin"></td>
						</tr>
					</table>
              	</div>
              </div>
            </div>
        </div>
    </div>
 
@endsection

@push('scripts')
	<script type="text/javascript">
		var productImage = '{{ $product->thumbnail }}';

		$(function() {
			$('.varianId').on('change', function() {
				getVarianDetail($(this).val());
			})
		});

		function getVarianDetail(varianId) {
			var ajaxUrl = '{{ route('web.varian.detail') }}';
			$.ajax({
				url: ajaxUrl,
				method: 'POST',
				data: { varianId },
				type: 'json',
				success: function(data) {
					setVarianDetail(data);
				},
				error: function() {
					resetVarianDetail()
				}
			});
		}

		function setVarianDetail(data) {
			let varian = data.data;

			$('.price').html('IDR '+varian.price)
			$('.stock').html(varian.quantity)

			$('.varian-name').html(varian.size)
			$('.varian-volume').html(varian.volume)
			$('.varian-color').html(varian.colorName)
			$('.varian-nicotin').html(varian.nicotin)

			$('.display-image').attr('src', '/upload/'+varian.image);
		}

		function resetVarianDetail() {
			$('.price').html('-')
			$('.stock').html('-')

			$('.varian-name').html('-')
			$('.varian-volume').html('-')
			$('.varian-color').html('-')
			$('.varian-nicotin').html('-')

			$('.display-image').attr('src', '/upload/'+productImage);
		}
	</script>
@endpush