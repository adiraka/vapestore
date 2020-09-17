@extends('adminlte::page')

@section('title', 'Customer')

@section('content_header')
    <h1>Customer</h1>
@stop

@inject('constant', 'App\Util\Constant')
@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					Customer Detail
					<a href="{{ route('customer.index') }}" class="btn btn-sm btn-default float-right">List Data</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">User Id</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->id }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Email</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->email }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Name</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->name }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Gender</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->gender }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Date Of Birth</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($user->detail->dateOfBirt)->format('d M Y') }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Phone</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->phone }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Address</label>
	                            <div class="col-md-10">
	                                <textarea class="form-control" disabled>{!! $user->detail->address !!}</textarea>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Village</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->subdistrict }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Subdistrict</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->district }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">City</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ \App\Service\RajaOngkirService::GetCityName($user->detail->city) }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Province</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ \App\Service\RajaOngkirService::GetProvinceName($user->detail->province) }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Postal Code</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->detail->postalCode }}">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-2 control-label">Created At</label>
	                            <div class="col-md-10">
	                                <input type="text" class="form-control" disabled value="{{ $user->created_at }}">
	                            </div>
	                        </div>
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

