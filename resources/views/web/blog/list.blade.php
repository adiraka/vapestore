@extends('web.template.layout')
 
@section('content')
 
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('web.homePage') }}">Home</a></li>
						<li aria-current="page" class="breadcrumb-item active">Blog</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div id="blog-listing" class="col-lg-12">
				<div class="box">
					<h1>Blog</h1>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.</p>
				</div>

				@foreach ($blogs as $blog)
					<div class="post">
						<h2><a href="{{ route('web.blog.detail', ['id' => $blog->id]) }}">{{ $blog->title }}</a></h2>
						<p class="author-category">
							By Admin
						</p>
						<hr>
						<p class="date-comments">
							<a href="{{ route('web.blog.detail', ['id' => $blog->id]) }}"><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->createdAt)->format('d M Y') }}</a>
							{{-- <a href="{{ route('web.blog.detail', ['id' => $blog->id]) }}"><i class="fa fa-comment-o"></i> 8 Comments</a> --}}
						</p>
						<div class="image">
							<a href="{{ route('web.blog.detail', ['id' => $blog->id]) }}"><img src="{{ asset('upload/'.$blog->thumbnail) }}" alt="Example blog post alt" class="img-fluid"></a>
						</div>
						<p class="intro">{!! $blog->synopsis !!}</p>
						<p class="read-more"><a href="{{ route('web.blog.detail', ['id' => $blog->id]) }}" class="btn btn-primary">Continue reading</a></p>
					</div>
				@endforeach

				<div class="pager d-flex justify-content-between">
					<div class="previous"><a href="#" class="btn btn-outline-primary">← Older</a></div>
					<div class="next disabled"><a href="#" class="btn btn-outline-secondary disabled">Newer →</a></div>
				</div>
			</div>
		</div>
	</div>
 
@endsection