@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Blog</h1>
@stop

@inject('constant', 'App\Util\Constant')
@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					Blog Detail
					<a href="{{ route('blog.index') }}" class="btn btn-sm btn-default float-right">List Data</a>
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
		                            <label for="title" class="col-md-2 control-label">Title</label>

		                            <div class="col-md-10">
		                                <input id="title" type="text" class="form-control" name="title" value="{{ empty(old('title')) ? $blog->title : old('title') }}">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="name" class="col-md-2 control-label">Synopsis</label>

		                            <div class="col-md-10">
		                                <textarea name="synopsis" class="form-control">{!! empty(old('synopsis')) ? $blog->synopsis : old('synopsis') !!}</textarea>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="name" class="col-md-2 control-label">Content</label>

		                            <div class="col-md-10">
		                                <textarea name="content" id="summernote">{!! empty(old('content')) ? $blog->content : old('content') !!}</textarea>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="code" class="col-md-2 control-label">Status</label>

		                            <div class="col-md-10">
		                            	<select name="status" id="status-select" required>
		                            		<option value="">Select Status...</option>
		                            		@foreach ($constant::BLOG_STATUS_LIST as $key => $value)
		                            			<option value="{{ $key }}" @if ($blog->status == $key) selected @endif>{{ $value }}</option>
		                            		@endforeach
		                            	</select>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="image" class="col-md-2 control-label">Thumbnail</label>
									
		                            <div class="col-md-10">
		                                <input id="image" type="file" class="form-control" name="thumbnail">
		                                <br>
		                                <img id="image-wrapper" src="{{ empty($blog->thumbnail) ? asset('image/no_img.png') : asset('upload/'.$blog->thumbnail) }}" width="200px" height="200px">
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
			$('#summernote').summernote({
				height: 200,
			});

			$('#status-select').select2({
				width: '100%',
				placeholder: "Select Status..."
			});

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

