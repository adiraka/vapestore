@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3>{{ $message }}</h3>
                <a href="{{ route('web.homePage') }}">Kembali Belanja</a>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
@endpush