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
			<div class="col-lg-6">
				<div class="box">
					<h1>New account</h1>
					<p class="lead">Not our registered customer yet?</p>
					<hr>
					<form action="customer-orders.html" method="post">
						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control">
						</div>

						<div class="form-group">
							<label for="passwordConfirmation">Password Confirmation</label>
							<input id="passwordConfirmation" type="passwordConfirmation" class="form-control">
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
					<form action="customer-orders.html" method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control">
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