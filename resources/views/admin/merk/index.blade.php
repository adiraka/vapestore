@extends('adminlte::page')

@section('title', 'Merk')

@section('content_header')
    <h1>Merk</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Merk List Table
					<a href="{{ route('merk.detail', ['id' => 0]) }}" class="btn btn-sm btn-default float-right">Add New Data</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table id="merk-table" class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Code</th>
									<th>Name</th>
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
			$('#merk-table').DataTable({
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
				ajax: '{{ route('merk.indexData') }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'code', name: 'code' },
					{ data: 'name', name: 'name' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action' },
				]
			});
		});
	</script>
@stop

