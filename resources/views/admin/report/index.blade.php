@extends('adminlte::page')

@section('title', 'Report')

@section('content_header')
    <h1>Report</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<strong>ORDER MONTHLY REPORT</strong>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form action="{{ route('report.order.monthly') }}" method="post" target="_blank">
								{{ csrf_field() }}
								<div class="form-group">
									<label>Month</label>
									<select class="form-control" name="month" required>
										<option value=""></option>
										@foreach (\App\Util\Constant::MONTH_LABEL as $key => $month)
											<option value="{{ $key }}">{{ $month }}</option>
										@endforeach
									</select>
								</div>	
								<div class="form-group">
									<label>Year</label>
									<input class="form-control" name="year" required></input>
								</div>
								<br>
								<div class="form-group text-center">
									<button type="submit" class="btn btn-block btn-primary">
										<strong>GENERATE REPORT</strong>
									</button>
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

@section('js')
	<script>
		$(function() {
			
		});
	</script>
@stop

