@extends('web.template.layout')
 
@section('content')
 
	@include('web.template.parts.slider-section', ['some' => 'data'])
	@include('web.template.parts.advantage-section', ['some' => 'data'])
	@include('web.template.parts.hot-section', ['some' => 'data'])
	@include('web.template.parts.blog-section', ['some' => 'data'])
 
@endsection

@push('scripts')
	<script type="text/javascript">
		var currentPage = 1;
		var currentLimit = 12;
		var category = '';

		$(function() {
			getProductList(currentPage, currentLimit);
		});

		function getProductList(page, limit) {
			var ajaxUrl = '{{ route('web.product.list') }}';
			$.ajax({
				url: ajaxUrl,
				method: 'POST',
				data: {
					page, 
					limit, 
					category,
					orderBy: {
						created_at: "DESC"
					}
				},
				type: 'json',
				success: function(data) {
					setProduct(data);
				},
				fail: function() {
					alert('gagal');
				}
			});
		}

		function setProduct(data) {
			$('.product-slider').empty();

			let productList = data.data;
			let html = '';

			$.each(productList, function(index, value){
				html += '<div class="col-lg-3 col-md-4">'
				html += '	<div class="product">'
				html += '		<div class="flip-container">'
				html += '			<div class="flipper">'
				html += '				<div class="front"><a href="detail.html"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a></div>'
				html += '				<div class="back"><a href="detail.html"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a></div>'
				html += '			</div>'
				html += '		</div><a href="detail.html" class="invisible"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a>'
				html += '		<div class="text">'
				html += '			<h3><a href="detail.html">'+value.name+'</a></h3>'
				html += '			<p class="price">' 
				html += '				<del></del>'+value.priceRange 
				html += '			</p>'
				html += '			<p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>'
				html += '		</div>'
				html += '	</div>'
				html += '</div>'
			});

			$('.products').append(html);
		}
	</script>
@endpush