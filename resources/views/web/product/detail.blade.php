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
                    <p class="text-center buttons">
                    	<a id="btn-add-tocart" data-toggle="modal" data-target="#add-tocart-modal" class="btn btn-primary disabled">
                    		<i class="fa fa-shopping-cart"></i> Add to cart
                    	</a>
                    </p>
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

    <div id="add-tocart-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add To Cart</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('web.cart.add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" id="modal-varian-id" name="varian_id" value="">
              <div class="form-group">
                <input id="qty-modal" type="text" name="qty" placeholder="QTY" class="form-control">
              </div>
              <p class="text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> ADD</button>
              </p>
            </form>
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
				if ($(this).val().length > 0) {
					$('#btn-add-tocart').removeClass('disabled');
					$('#modal-varian-id').val($(this).val());
				} else {
					$('#btn-add-tocart').addClass('disabled');
				}
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