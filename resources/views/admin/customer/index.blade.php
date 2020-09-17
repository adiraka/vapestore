@extends('adminlte::page')

@section('title', 'Customer')

@section('content_header')
    <h1>Customer</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Customer List Table
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table id="blog-table" class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Email</th>
									<th>Name</th>
									<th>Created At</th>
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
				ajax: '{{ route('customer.indexData') }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'email', name: 'email' },
					{ data: 'name', name: 'name' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'action', name: 'action' },
				]
			});
		});
	</script>
@stop

