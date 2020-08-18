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
                    <p class="price">$124.00</p>
                    <p class="text-center buttons"><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a><a href="basket.html" class="btn btn-outline-primary"><i class="fa fa-heart"></i> Add to wishlist</a></p>
                  </div>
                </div>
              </div>
              <div id="details" class="box">
                <p></p>
                <h4>Product details</h4>
                <p>White lace top, woven, has a round neck, short sleeves, has knitted lining attached</p>
                <h4>Material &amp; care</h4>
                <ul>
                  <li>Polyester</li>
                  <li>Machine wash</li>
                </ul>
                <h4>Size &amp; Fit</h4>
                <ul>
                  <li>Regular fit</li>
                  <li>The model (height 5'8" and chest 33") is wearing a size S</li>
                </ul>
                <blockquote>
                  <p><em>Define style this season with Armani's new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em></p>
                </blockquote>
              </div>
              
            </div>
        </div>
    </div>
 
@endsection