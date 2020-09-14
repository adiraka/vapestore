@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
    <h1>Order</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Order List Table
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table id="invoice-table" class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Invoice Number</th>
									<th>Customer Name</th>
									<th>Date</th>
									<th>Amount</th>
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
			$('#invoice-table').DataTable({
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
				ajax: '{{ route('order.indexData') }}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'order_number', name: 'order_number' },
					{ data: 'customer_name', name: 'customer_name' },
					{ data: 'order_date', name: 'order_date' },
					{ data: 'total_amount', name: 'total_amount' },
					{ data: 'status', name: 'status' },
					{ data: 'action', name: 'action' },
				]
			});
		});
	</script>
@stop

