@extends('web.template.layout')
 
@section('content')
 	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">New Account</li>
					</ol>
				</nav>
			</div>
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@elseif(Session::has('success'))
				<div class="alert alert-success">
			        {{ Session::get('success') }}
			    </div>
			@elseif(Session::has('error'))
				<div class="alert alert-danger">
			        {{ Session::get('error') }}
			    </div>
			@endif
			<div class="col-lg-6">
				<div class="box">
					<h1>New account</h1>
					<p class="lead">Not our registered customer yet?</p>
					<hr>
					<form action="{{ route('web.register') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" name="name" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" name="email" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" name="password" type="password" class="form-control">
						</div>

						<div class="form-group">
							<label for="password_confirmation ">Password Confirmation</label>
							<input id="password_confirmation " name="password_confirmation" type="password" class="form-control">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
						</div>
					</form>
				</div>
            </div>
            <div class="col-lg-6">
				<div class="box">
					<h1>Login</h1>
					<p class="lead">Already our customer?</p>
					<hr>
					<form action="{{ route('web.login') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" name="email" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" name="password" type="password" class="form-control">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
						</div>
					</form>
				</div>
            </div>
		</div>
	</div>
 
@endsection