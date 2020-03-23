@extends('adminlte::page')

@section('title', 'Merk')

@section('content_header')
    <h1>Merk</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					Merk Detail
					<a href="{{ route('merk.index') }}" class="btn btn-sm btn-default float-right">List Data</a>
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

							<form action=""  role="form" method="POST" enctype="multipart/form-data">
								{{ csrf_field() }}


								<div class="form-group row">
		                            <label for="code" class="col-md-4 control-label">Merk Code</label>

		                            <div class="col-md-8">
		                                <input id="code" type="text" class="form-control" name="code" value="{{ empty(old('code')) ? $merk->code : old('code') }}">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="name" class="col-md-4 control-label">Merk Name</label>

		                            <div class="col-md-8">
		                                <input id="name" type="text" class="form-control" name="name" value="{{ empty(old('name')) ? $merk->name : old('name') }}">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="image" class="col-md-4 control-label">Merk Image</label>
									
		                            <div class="col-md-8">
		                                <input id="image" type="file" class="form-control" name="image">
		                                <br>
		                                <img id="image-wrapper" src="{{ empty($merk->image) ? asset('image/no_img.png') : asset('upload/'.$merk->image) }}" width="200px" height="200px">
		                            </div>
		                        </div>

								<div class="form-group text-right">
									<button type="submit" class="btn btn-success">Save Data</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
		});
	</script>
@stop

