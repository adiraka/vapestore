<header class="header mb-5">
  <div id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offer mb-3 mb-lg-0"></div>
        <div class="col-lg-6 text-center text-lg-right">
          <ul class="menu list-inline mb-0">
            <li class="list-inline-item"><a href="contact.html">Contact</a></li>
            @if (Auth::check())
              <li class="list-inline-item"><a href="#">My Account</a></li>
              <li class="list-inline-item"><a href="{{ route('web.logout') }}">Logout</a></li>
            @else
              <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
              <li class="list-inline-item"><a href="{{ route('web.registerPage') }}">Register</a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Customer Login</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('web.login') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <input id="email-modal" type="text" name="email" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input id="password-modal" type="password" name="password" placeholder="Password" class="form-control">
              </div>
              <p class="text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in"></i> Log in</button>
              </p>
            </form>
            <p class="text-center text-muted">
              Not registered yet? 
              <a href="register.html"><strong>Register now</strong></a>!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a href="{{ route('web.homePage') }}" class="navbar-brand home">
        <img src="{{ asset('web/img/logo.png') }}" alt="Obaju logo" class="d-none d-md-inline-block">
        <img src="{{ asset('web/img/logo-small.png') }}" alt="Obaju logo" class="d-inline-block d-md-none">
        <span class="sr-only">Obaju - go to homepage</span>
      </a>
      <div class="navbar-buttons">
        <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-align-justify"></i>
        </button>
        <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler">
          <span class="sr-only">Toggle search</span>
          <i class="fa fa-search"></i>
        </button>
        <a href="basket.html" class="btn btn-outline-secondary navbar-toggler">
          <i class="fa fa-shopping-cart"></i>
        </a>
      </div>
      <div id="navigation" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a href="{{ route('web.homePage') }}" class="nav-link">Home</a></li>
          <li class="nav-item dropdown menu-large">
            <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">
              Category <b class="caret"></b>
            </a>
            <ul class="dropdown-menu megamenu">
              <li>
                <div class="row">
                  @foreach ($constant::CATEGORY_LIST as $categoryCode => $category)
                    <div class="col-md-6 col-lg-3">
                      <h5>{{ $category }}</h5>
                      <ul class="list-unstyled mb-3">
                        @if (count($constant::CATEGORY_TYPE_LIST[$categoryCode]) > 0)
                          @foreach ($constant::CATEGORY_TYPE_LIST[$categoryCode] as $typeCode => $type)
                            <li class="nav-item"><a href="{{ route('web.category.list', ['category' => $typeCode]) }}" class="nav-link">{{ $type }}</a></li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  @endforeach
                </div>
              </li>
            </ul>
          </li>
          <li class="nav-item"><a href="{{ route('web.blog.list') }}" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="#" class="nav-link">About</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
        <div class="navbar-buttons d-flex justify-content-end">
          <div id="search-not-mobile" class="navbar-collapse collapse"></div>
          <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
            <span class="sr-only">Toggle search</span>
            <i class="fa fa-search"></i>
          </a>
          <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
            <a href="basket.html" class="btn btn-primary navbar-btn">
              <i class="fa fa-shopping-cart"></i>
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div id="search" class="collapse">
    <div class="container">
      <form role="search" class="ml-auto">
        <div class="input-group">
          <input type="text" placeholder="Search" class="form-control">
          <div class="input-group-append">
            <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</header>