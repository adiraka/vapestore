@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1>Product</h1>
@stop

@inject('constant', 'App\Util\Constant')
@section('content')
<form action=""  role="form" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-5 col-sm-12">
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
	                            		@if (!empty($product->id))
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
		@if (!empty($product->id))
			<div class="col-md-7 col-sm-12">
				<div class="card">
					<div class="card-header">
						List Varian
						<a href="{{ route('varian.detail', ['id' => 0, 'productId' => $product->id]) }}" class="btn btn-sm btn-success float-right">Add Varian</a>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<table id="varian-table" class="table table-bordered table-hover">
									<thead>
										<th>ID</th>
										<th>Size/Desc</th>
										<th>Qty</th>
										<th>Price</th>
										<th>Status</th>
										<th>Action</th>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
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
		var catridgeList = {!! json_encode($constant::CATRIDGE_TYPE_LIST) !!};
		var deviceList = {!! json_encode($constant::DEVICE_TYPE_LIST) !!};
		var cottonList = {!! json_encode($constant::COTTON_TYPE_LIST) !!};
		var coilList = {!! json_encode($constant::COIL_TYPE_LIST) !!};
		var automizerList = {!! json_encode($constant::AUTOMIZER_TYPE_LIST) !!};
		var dripTipList = {!! json_encode($constant::DRIP_TIP_TYPE_LIST) !!};
		var productType = '{{ $product->type }}';

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

			$('#varian-table').DataTable({
				dom: 'Bfrtip',
				processing: true,
				serverSide: true,
				responsive: true,
				// language: {
				// 	url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
				// },
				buttons: [
		            'csv', 'excel', 'pdf', 'print'
		        ],
				ajax: '{{ route('varian.indexData', ['productId' => $product->id]) }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'size', name: 'size' },
					{ data: 'quantity', name: 'quantity' },
					{ data: 'price', name: 'price' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action' },
				]
			});

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
			
			initTypeSelect();

			if (productType != '') {
				setProductType();
				$('#type-select').val(productType).trigger('change');	
			}
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
					optionHtml = generateTypeOption(catridgeList);
				} else if(category == 'COIL') {
					optionHtml = generateTypeOption(coilList);
				} else if(category == 'DRIP_TIP') {
					optionHtml = generateTypeOption(dripTipList);
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
	</script>
@stop

