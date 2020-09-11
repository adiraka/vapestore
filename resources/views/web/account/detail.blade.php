@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">Account</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="card sidebar-menu">
					<div class="card-header">
						<h3 class="h4 card-title">Customer</h3>
					</div>
					<div class="card-body">
						<ul class="nav nav-pills flex-column">
							<a href="{{ route('web.account.detail') }}" class="nav-link active"><i class="fa fa-user"></i> My account</a>
							<a href="customer-orders.html" class="nav-link"><i class="fa fa-list"></i> My orders</a>
							<a href="{{ route('web.logout') }}" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a>
						</ul>
					</div>
				</div>
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>My account</h1>
                <p class="lead">Change your personal details or your password here.</p>
                <div class="col-lg-12">
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
				</div>
                <h3>Change password</h3>
                <form method="POST" action="{{ route('web.changePassword') }}">
                	{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
						  	<div class="form-group">
						    	<label for="password_old">Old password</label>
						    	<input id="password_old" name="password_old" type="password" class="form-control">
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						  	<div class="form-group">
						    	<label for="password">New password</label>
						    	<input id="password" name="password" type="password" class="form-control">
						  	</div>
						</div>
						<div class="col-md-6">
						  	<div class="form-group">
						    	<label for="password_confirmation">Retype new password</label>
						    	<input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
						  	</div>
						</div>
                  	</div>
                  	<div class="col-md-12 text-center">
                    	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                  	</div>
                </form>
                <h3 class="mt-5">Personal details</h3>
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="company">Company</label>
                        <input id="company" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="street">Street</label>
                        <input id="street" type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="city">Company</label>
                        <input id="city" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="zip">ZIP</label>
                        <input id="zip" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="state">State</label>
                        <select id="state" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phone">Telephone</label>
                        <input id="phone" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
		</div>
	</div>
 
@endsection