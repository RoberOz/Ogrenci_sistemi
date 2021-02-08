<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Öğrenci Sistemi', 'Öğrenci Sistemi') }}</title>

    <!-- Links -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- <script src="js/scripts.js"></script> -->

    </head>
    <body class="nav-fixed">
      <div id="app">
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

        <div id="layoutSidenav">
          @if (auth()->user() !== null)
          <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-dark">
              <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                  <br>
                  <br>
                  <a class="nav-link" href={{route('home')}}><i class="fas fa-home"></i>&nbsp Anasayfa</a>
                  @if (auth()->user()->hasRole('admin'))
                    <div class="sidenav-menu-heading">Admin Panel</div>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAdminPanel" aria-expanded="false" aria-controls="collapseAdminPanel">
                      <div class="nav-link"><i class="fas fa-users-cog"></i></div>
                        Admin
                      <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                    </a>
                    <div class="collapse" id="collapseAdminPanel" data-parent="#accordionSidenav">
                      <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link" href={{route('school-list')}}><i class="fas fa-clipboard-list"></i>&nbsp Okul Listesi</a>
                        <a class="nav-link" href={{route('user.create')}}><i class="fas fa-plus-circle"></i>&nbsp Kişi Oluştur</a>
                      </nav>
                    </div>
                  @endif
                  @if (auth()->user()->hasRole('teacher||admin'))
                    <div class="sidenav-menu-heading">Öğretmen Panel</div>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseTeacherPanel" aria-expanded="false" aria-controls="collapseTeacherPanel">
                      <div class="nav-link"><i class="fas fa-chalkboard-teacher"></i></div>
                        Öğretmen
                      <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                    </a>
                    <div class="collapse" id="collapseTeacherPanel" data-parent="#accordionSidenav">
                      <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link" href={{route('student-list')}}><i class="fas fa-book-reader"></i></i>&nbsp Öğrenci Listesi</a>
                      </nav>
                    </div>
                  @endif
                  @if (auth()->user()->hasRole('student||admin'))
                    <div class="sidenav-menu-heading">Öğretmen Panel</div>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseStudentPanel" aria-expanded="false" aria-controls="collapseStudentPanel">
                      <div class="nav-link"><i class="fas fa-user-graduate"></i></div>
                        Öğrenci
                      <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                    </a>
                    <div class="collapse" id="collapseStudentPanel" data-parent="#accordionSidenav">
                      <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link" href={{route('student-list')}}><i class="fas fa-book-reader"></i></i>&nbsp Öğrenci Listesi</a>
                      </nav>
                    </div>
                  @endif
                  <!-- Sidenav Link (Charts)-->
                  <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="nav-link-icon" ><i class="fas fa-sign-out-alt"></i></div>
                    Çıkış Yap
                  </a>
                </div>
              </div>

              <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                  <div class="sidenav-footer-subtitle">Logged in as:</div>
                  <div class="sidenav-footer-title">{{auth()->user()->name}}</div>
                </div>
              </div>
            </nav>
          </div>
          @endif

          <div id="layoutSidenav_content" style="background:#EFEFEF">
            <main>
              <header class="page-header page-header-dark pb-10">
                <br>
              </header>
              <!-- Main page content-->
              <div class="container mt-n10">
                <div class="card-body">

                  @yield('content')

                </div>
              </div>
            </main>
            <footer class="footer mt-auto footer-light">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 small" style="color:black">Copyright © Öğrenci Sistemi Sitesi 2021</div>
                  <div class="col-md-6 text-md-right small">
                      <a href="javascript:void(0);" style="color:black">Privacy Policy</a>
                      ·
                      <a href="javascript:void(0);" style="color:black">Terms &amp; Conditions</a>
                  </div>
                </div>
              </div>
            </footer>
          </div>
        </div>

      </div>
    </body>

@stack('javascript')
</html>
