@inject('constant', 'App\Util\Constant')

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vapestore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
	@include('web.template.parts.css-section')
	@stack('styles')
  </head>
  <body>

	@include('web.template.parts.header-section')

    <div id="all">
      <div id="content">
        
        @yield('content')

      </div>
    </div>

    @include('web.template.parts.footer-section', ['some' => 'data'])
    @include('web.template.parts.copyright-section', ['some' => 'data'])
    @include('web.template.parts.js-section')
	@stack('scripts')
  </body>
</html>