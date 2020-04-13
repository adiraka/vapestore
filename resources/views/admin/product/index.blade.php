@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1>Product</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Product List Table
					<a href="{{ route('product.detail', ['id' => 0]) }}" class="btn btn-sm btn-default float-right">Add New Data</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table id="product-table" class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Code</th>
									<th>Name</th>
									<th>Category</th>
									<th>Type</th>
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
			$('#product-table').DataTable({
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
				ajax: '{{ route('product.indexData') }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'code', name: 'code' },
					{ data: 'name', name: 'name' },
					{ data: 'category', name: 'category' },
					{ data: 'type', name: 'type' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action' },
				]
			});
		});
	</script>
@stop

