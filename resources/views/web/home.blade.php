@extends('web.template.layout')
 
@section('content')
 
	@include('web.template.parts.slider-section', ['some' => 'data'])
	@include('web.template.parts.advantage-section', ['some' => 'data'])
	@include('web.template.parts.hot-section', ['some' => 'data'])
	@include('web.template.parts.blog-section', ['some' => 'data'])
 
@endsection