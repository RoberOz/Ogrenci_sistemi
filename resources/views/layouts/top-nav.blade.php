<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light" id="sidenavAccordion" style="background:#96CDF1">

    <!-- Sidenav Toggle Button -->
    @if (auth()->user() !== null)
      <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" style="background:#8BBAD9"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></button>
    @endif

    <!-- Main Menu Link -->
    <a class="navbar-brand" href="{{ url('/') }}"><i class="fas fa-graduation-cap"></i>
      {{ config('Öğrenci Sistemi', 'Öğrenci Sistemi') }}
    </a>

    <!-- Top Navbar Items-->
    <ul class="navbar-nav align-items-center ml-auto">
      @guest
        @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" style="color:black">{{ __('Giriş') }}</a>
          </li>
        @endif

        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}" style="color:black">{{ __('Kayıt ol') }}</a>
          </li>
        @endif
      @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
              &nbsp Çıkış Yap
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      @endguest
    </ul>
  </nav>
