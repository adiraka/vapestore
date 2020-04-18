@extends('adminlte::page')

@section('title', 'Product Varian')

@section('content_header')
    <h1>Product Varian</h1>
@stop

@inject('constant', 'App\Util\Constant')
@section('content')
<form action=""  role="form" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					Product Varian Detail
					<a href="{{ route('product.detail', ['id'=>$productId]) }}" class="btn btn-sm btn-default float-right">Product</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							@if ($message = Session::get('success'))
						        <div class="alert alert-success alert-block">
						            <button type="button" class="close" data-dismiss="alert">×</button>
						                <strong>{{ $message }}</strong>
						        </div>
					        @endif

							@if (count($errors) > 0)
					            <div class="alert alert-danger">
					                <strong>Whoops!</strong> There were some problems with your input.
					                <ul>
					                    @foreach ($errors->all() as $error)
					                        <li>{{ $error }}</li>
					                    @endforeach
					                </ul>
					            </div>
					        @endif
							
							{{ csrf_field() }}
							
							<div class="form-group row">
	                            <label for="size" class="col-md-4 control-label">Color</label>

	                            <div class="col-md-8">
	                                <select name="color_id" id="" class="form-control color-select">
	                                	@if (!empty($varian->id) && !empty($varian->color_id))
	                            			<option value="{{ $varian->color->id }}" selected>{{ $varian->color->name }}</option>
	                            		@endif
	                                </select>
	                            </div>
	                        </div>
		        			<div class="form-group row">
	                            <label for="size" class="col-md-4 control-label">Size/Description</label>

	                            <div class="col-md-8">
	                                <input id="size" type="text" class="form-control" name="size" value="{{ $varian->size }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="volume" class="col-md-4 control-label">Volume</label>

	                            <div class="col-md-8">
	                            	<div class="input-group">
	                            		<input id="volume" type="number" step="0.01" min="0" class="form-control" name="volume" value="{{ $varian->volume }}">
	                            		<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">ml</span>
										</div>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="nicotin" class="col-md-4 control-label">Nicotin</label>

	                            <div class="col-md-8">
	                            	<div class="input-group">
	                            		<input id="nicotin" type="number" step="0.01" min="0" class="form-control" name="nicotin" value="{{ $varian->nicotin }}">
	                            		<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">mg</span>
										</div>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="quantity" class="col-md-4 control-label">Quantity</label>

	                            <div class="col-md-8">
	                                <input id="quantity" type="number" class="form-control" name="quantity" min="0" value="{{ $varian->quantity }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="price" class="col-md-4 control-label">Price</label>
								
	                            <div class="col-md-8">
	                            	<div class="input-group">
	                            		<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">IDR</span>
										</div>
										<input id="price" type="number" class="form-control" name="price" min="0" value="{{ $varian->price }}">
	                            	</div>
	                                
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="image" class="col-md-4 control-label">Image</label>
								
	                            <div class="col-md-8">
	                                <input id="image" type="file" class="form-control" name="image">
	                                <br>
	                                <img id="image-wrapper" src="{{ empty($varian->image) ? asset('image/no_img.png') : asset('upload/'.$varian->image) }}" width="200px" height="200px">
	                            </div>
	                        </div>

							<div class="form-group text-right">
								<button type="submit" class="btn btn-success">Save Data</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')

@section('js')
	<script>
		$(function() {
			function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    
			    reader.onload = function(e) {
			      $('#image-wrapper').attr('src', e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]);
			  }
			}

			$("#image").change(function() {
			  readURL(this);
			});

			initColorSelect();
		});

		function initColorSelect() {
			$('.color-select').select2({
				width: '100%',
				placeholder: "Select Color...",
            	minimumInputLength: 2,
            	ajax: {
	                url: '{{ route('color.find') }}',
	                dataType: 'json',
	                data: function (params) {
	                    return {
	                        q: $.trim(params.term)
	                    };
	                },
	                processResults: function (data) {
	                    return {
	                        results: data
	                    };
	                },
	                cache: true
	            }
			});
		}

	</script>
@stop