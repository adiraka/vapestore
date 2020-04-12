@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1>Product</h1>
@stop

@inject('constant', 'App\Util\Constant')
@section('content')
<form action=""  role="form" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					Product Detail
					<a href="{{ route('product.index') }}" class="btn btn-sm btn-default float-right">List Data</a>
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
	                            <label for="code" class="col-md-4 control-label">Category</label>

	                            <div class="col-md-8">
	                            	<select name="category" id="category-select" required>
	                            		<option value="">Select Category...</option>
	                            		@foreach ($constant::CATEGORY_LIST as $category => $name)
	                            			<option value="{{ $category }}" @if ($product->category == $category) selected @endif>{{ $name }}</option>
	                            		@endforeach
	                            	</select>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="code" class="col-md-4 control-label">Type</label>

	                            <div class="col-md-8">
	                            	<select name="type" id="type-select" required>
	                            		<option value="">Select Type...</option>
	                            	</select>
	                            </div>
	                        </div>

							<div class="form-group row">
	                            <label for="code" class="col-md-4 control-label">Merk</label>

	                            <div class="col-md-8">
	                            	<select name="merk_id" id="merk-select" required>
	                            		@if (!empty($id))
	                            			<option value="{{ $product->merk->id }}" selected>{{ $product->merk->name }}</option>
	                            		@endif
	                            	</select>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 control-label">Product Code</label>

	                            <div class="col-md-8">
	                                <input id="name" type="text" class="form-control" name="code" value="{{ $product->code }}">
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 control-label">Product Name</label>

	                            <div class="col-md-8">
	                                <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}">
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 control-label">Product Description</label>

	                            <div class="col-md-8">
	                            	<textarea name="description" class="form-control">{{ $product->description }}</textarea>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="image" class="col-md-4 control-label">Product Thumbnail</label>
								
	                            <div class="col-md-8">
	                                <input id="image" type="file" class="form-control" name="thumbnail">
	                                <br>
	                                <img id="image-wrapper" src="{{ empty($product->thumbnail) ? asset('image/no_img.png') : asset('upload/'.$product->thumbnail) }}" width="200px" height="200px">
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
		<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					Product Varian
					<buttont class="btn btn-success btn-sm float-right" id="add-varian-btn" type="button">Add Varian</buttont>
				</div>
				<div class="card-body">
					<div class="row varian-list">
						<div class="col-md-12">
							<div class="card">
						      	<div class="card-body">
						        	<div class="row">
						        		<div class="col-md-12">
					                        <div class="form-group row">
					                            <label for="size" class="col-md-4 control-label">Color</label>

					                            <div class="col-md-8">
					                                <select name="color[]" id="" class="form-control color-select">
					                                	
					                                </select>
					                            </div>
					                        </div>
						        			<div class="form-group row">
					                            <label for="size" class="col-md-4 control-label">Size</label>

					                            <div class="col-md-8">
					                                <input id="size" type="text" class="form-control" name="size[]" value="">
					                            </div>
					                        </div>
					                        <div class="form-group row">
					                            <label for="volume" class="col-md-4 control-label">Volume</label>

					                            <div class="col-md-8">
					                            	<div class="input-group">
					                            		<input id="volume" type="number" step="0.01" min="0" class="form-control" name="volume[]" value="">
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
					                            		<input id="nicotin" type="number" step="0.01" min="0" class="form-control" name="nicotin[]" value="">
					                            		<div class="input-group-append">
															<span class="input-group-text" id="basic-addon2">mg</span>
														</div>
					                            	</div>
					                            </div>
					                        </div>
					                        <div class="form-group row">
					                            <label for="quantity" class="col-md-4 control-label">Quantity</label>

					                            <div class="col-md-8">
					                                <input id="quantity" type="number" class="form-control" name="quantity[]" value="">
					                            </div>
					                        </div>
					                        <div class="form-group row">
					                            <label for="image" class="col-md-4 control-label">Image</label>
												
					                            <div class="col-md-8">
					                                <input type="file" class="form-control" name="image[]">
					                            </div>
					                        </div>
						        		</div>
						        	</div>
						      	</div>
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
		var liquidList = {!! json_encode($constant::LIQUID_TYPE_LIST) !!};
		var deviceList = {!! json_encode($constant::DEVICE_TYPE_LIST) !!};
		var cottonList = {!! json_encode($constant::COTTON_TYPE_LIST) !!};
		var coilList = {!! json_encode($constant::COIL_TYPE_LIST) !!};
		var automizerList = {!! json_encode($constant::AUTOMIZER_TYPE_LIST) !!};
		var dripTipList = {!! json_encode($constant::DRIP_TIP_TYPE_LIST) !!};

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

			$('#category-select').select2({
				width: '100%',
				placeholder: "Select Category..."
			});

			$('#category-select').on('change', function(){
				setProductType();
			});

			$('#merk-select').select2({
				width: '100%',
				placeholder: "Select Merk...",
            	minimumInputLength: 2,
            	ajax: {
	                url: '{{ route('merk.find') }}',
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

			initColorSelect();
			initTypeSelect();

			$('#add-varian-btn').on('click', function() {
				$('.varian-list').append(generateVarianDetail()).on('click', '.btn-remove', function() {
					removeVarian($(this));
				});
				setProductType();
				initColorSelect();
			});
		});

		function setProductType() {
			let category = $('#category-select').val();
			let optionHtml = '';

			if (category.length > 0) {
				if (category == 'LIQUID') {
					optionHtml = generateTypeOption(liquidList);
				} else if(category == 'DEVICE') {
					optionHtml = generateTypeOption(deviceList);
				} else if(category == 'COTTON') {
					optionHtml = generateTypeOption(cottonList);
				} else if(category == 'AUTOMIZER') {
					optionHtml = generateTypeOption(automizerList);
				} else if(category == 'CATRIDGE') {
					optionHtml = '<option value="">No Type..</option>';
				} else if(category == 'COIL') {
					optionHtml = generateTypeOption(coilList);
				}
			}
			$('#type-select').empty();
			$('#type-select').append(optionHtml);
			initTypeSelect();
		}

		function generateTypeOption(obj) {
			var datas = Object.entries(obj);

			let string = '';

			datas.forEach(function(index, el) {
				string += '<option value="'+index[0]+'">'+index[1]+'</option>';		
			});

			return string;
		}

		function generateVarianDetail() {
			let string = '<div class="col-md-12 varian-detail">' +
				'<div class="card">' +
			      	'<div class="card-body">' +
			        	'<div class="row">' +
			        		'<div class="col-md-12">' +
		                        '<div class="form-group row">' +
		                            '<label for="size" class="col-md-4 control-label">Color</label>' +

		                            '<div class="col-md-8">' +
		                                '<select name="color[]" id="" class="form-control color-select">' +
		                                	
		                                '</select>' +
		                            '</div>' +
		                        '</div>' +
			        			'<div class="form-group row">' +
		                            '<label for="size" class="col-md-4 control-label">Size</label>' +

		                            '<div class="col-md-8">' +
		                                '<input id="size" type="text" class="form-control" name="size[]" value="">' +
		                            '</div>' +
		                        '</div>' +
		                        '<div class="form-group row">' +
		                            '<label for="volume" class="col-md-4 control-label">Volume</label>' +

		                            '<div class="col-md-8">' +
		                            	'<div class="input-group">' +
		                            		'<input id="volume" type="number" step="0.01" min="0" class="form-control" name="volume[]" value="">' +
		                            		'<div class="input-group-append">' +
												'<span class="input-group-text" id="basic-addon2">ml</span>' +
											'</div>' +
		                            	'</div>' +
		                            '</div>' +
		                        '</div>' +
		                        '<div class="form-group row">' +
		                            '<label for="nicotin" class="col-md-4 control-label">Nicotin</label>' +

		                            '<div class="col-md-8">' +
		                            	'<div class="input-group">' +
		                            		'<input id="nicotin" type="number" step="0.01" min="0" class="form-control" name="nicotin[]" value="">' +
		                            		'<div class="input-group-append">' +
												'<span class="input-group-text" id="basic-addon2">mg</span>' +
											'</div>' +
		                            	'</div>' +
		                            '</div>' +
		                        '</div>' +
		                        '<div class="form-group row">' +
		                            '<label for="quantity" class="col-md-4 control-label">Quantity</label>' +

		                            '<div class="col-md-8">' +
		                                '<input id="quantity" type="number" class="form-control" name="quantity[]" value="">' +
		                            '</div>' +
		                        '</div>' +
		                        '<div class="form-group row">' +
		                            '<label for="image" class="col-md-4 control-label">Image</label>' +
									
		                            '<div class="col-md-8">' +
		                                '<input type="file" class="form-control" name="image[]">' +
		                            '</div>' +
		                        '</div>' +
		                        '<div class="form-group row">' +
		                        	'<div class="col-md-12 text-right">' +
		                        		'<button type="button" class="btn btn-danger btn-remove">Remove</button>' +
		                        	'</div>' +
		                        '</div>' +
			        		'</div>' +
			        	'</div>' +
			      	'</div>' +
				'</div>' +
			'</div>';

			return string;
		}

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

		function initTypeSelect() {
			$('#type-select').select2({
				width: '100%',
				placeholder: "Select Type..."
			});
		}

		function removeVarian($this) {
			let parent = $this.closest('.varian-detail');
			parent.remove();
		}
	</script>
@stop

