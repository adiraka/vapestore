@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Blog</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Blog List Table
					<a href="{{ route('blog.detail', ['id' => 0]) }}" class="btn btn-sm btn-default float-right">Add New Data</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table id="blog-table" class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Title</th>
									<th>Created At</th>
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
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')

@section('js')
	<script>
		$(function() {
			$('#blog-table').DataTable({
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
				ajax: '{{ route('blog.indexData') }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'title', name: 'title' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action' },
				]
			});
		});
	</script>
@stop

