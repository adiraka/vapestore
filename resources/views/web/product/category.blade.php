@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
        <div class="row">                       
            <div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">{{ $categoryName }}</li>
					</ol>
				</nav>
				<div class="box">
					<h1>{{ $categoryName }}</h1>
					<p>{{ $categoryDescription }}</p>
				</div>
				<div class="box info-bar">
					<div class="row">
						<div class="col-md-12 col-lg-4 products-showing"></div>
						<div class="col-md-12 col-lg-7 products-number-sort">
							<form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
								<div class="products-number">
									<strong>Show</strong>
									<button type="button" class="btn btn-limit-per-page btn-outline-secondary btn-sm" value="10">10</button>
									<button type="button" class="btn btn-limit-per-page btn-outline-secondary btn-sm" value="30">30</button>
									<button type="button" class="btn btn-limit-per-page btn-outline-secondary btn-sm" value="50">50</button>
									<span>products</span>
								</div>
								{{-- <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
									<select name="sort-by" class="form-control">
										<option>Price</option>
										<option>Name</option>
									</select>
								</div> --}}
							</form>
						</div>
					</div>
				</div>
              	<div class="row products">
                	
              	</div>
				<div class="pages">
					<nav aria-label="Page navigation example" class="d-flex justify-content-center">
						<ul class="pagination">
							<li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
							<li class="page-item active"><a href="#" class="page-link">1</a></li>
							<li class="page-item"><a href="#" class="page-link">2</a></li>
							<li class="page-item"><a href="#" class="page-link">3</a></li>
							<li class="page-item"><a href="#" class="page-link">4</a></li>
							<li class="page-item"><a href="#" class="page-link">5</a></li>
							<li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
						</ul>
					</nav>
				</div>
            </div>
        </div>
    </div>
 
@endsection

@push('scripts')
	<script type="text/javascript">
		var currentPage = 1;
		var currentLimit = 10;
		var category = '{{ $category }}';

		$(function() {
			getProductList(currentPage, currentLimit);

			$('.btn-limit-per-page').on('click', function() {
				let limit = $(this).val();
				currentLimit = limit;
				getProductList(currentPage, limit);
			})
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
			$('.products').empty();
			$('.products-showing').empty();
			$('.pagination').empty();

			let productList = data.data;
			let html = '';
			let paginate = '';

			$.each(productList, function(index, value){
				html += '<div class="col-lg-3 col-md-4">'
				html += '<div class="product">'
				html += '<div class="flip-container">'
				html += '<div class="flipper">'
				html += '<div class="front"><a href="/product/detail/'+value.id+'"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a></div>'
				html += '<div class="back"><a href="/product/detail/'+value.id+'"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a></div>'
				html += '</div>'
				html += '</div><a href="/product/detail/'+value.id+'" class="invisible"><img src="/upload/'+value.thumbnail+'" alt="" class="img-fluid"></a>'
				html += '<div class="text">'
				html += '<h3><a href="/product/detail/'+value.id+'">'+value.name+'</a></h3>'
				html += '<p class="price">' 
				html += '<del></del>'+value.priceRange 
				html += '</p>'
				html += '<p class="buttons"><a href="/product/detail/'+value.id+'" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>'
				html += '</div>'
				html += '</div>'
				html += '</div>'
			});

			paginate += '<li class="page-item"><button type="button" value="'+data.prevPage+'" aria-label="Previous" class="page-link pagination-button"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></button></li>';
			for (var i = 1; i <= data.totalPage; i++) {
				if (i == data.page) {
					paginate += '<li class="page-item active"><button type="button" value="'+i+'" class="page-link pagination-button">'+i+'</button></li>';
				} else {
					paginate += '<li class="page-item"><button type="button" value="'+i+'" class="page-link pagination-button">'+i+'</button></li>';
				}
			}
			paginate += '<li class="page-item"><button type="button" value="'+data.nextPage+'" aria-label="Next" class="page-link pagination-button"><span aria-hidden="true">»</span><span class="sr-only">Next</span></button></li>';

			$('.products').append(html);
			$('.pagination').append(paginate);
			$('.products-showing').append('Showing <strong>'+data.page+'</strong> of <strong>'+data.totalPage+'</strong> pages');

			$('.pagination-button').on('click', function() {
				let page = $(this).val();
				currentPage = page;
				getProductList(page, currentLimit);
			})
		}
	</script>
@endpush