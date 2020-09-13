@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div id="checkout" class="col-lg-12">
                <div class="box text-center">
                    <h3>{{ $message }}</h3>
                    <hr>
                    <a href="{{ route('web.homePage') }}" class="btn btn-primary">Kembali Belanja</a>
                </div>
            </div>
		</div>
	</div>
@endsection

@push('scripts')
@endpush