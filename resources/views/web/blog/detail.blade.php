@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('web.blog.list') }}">Blog</a></li>
						<li aria-current="page" class="breadcrumb-item active">{{ $blog->title }}</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div id="blog-post" class="col-lg-12">
              <div class="box">
                <h1>{{ $blog->title }}</h1>
                <p class="author-date">By Admin |  {{ \Carbon\Carbon::parse($blog->createdAt)->format('d M Y') }}</p>
                <div id="post-content">{!! $blog->content !!}</div>
              </div>
            </div>
		</div>
	</div>
 
@endsection