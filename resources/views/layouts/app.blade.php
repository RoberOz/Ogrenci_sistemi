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
    <link href="css/styles.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    </head>
    <body class="nav-fixed">
      <div id="app">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light" id="sidenavAccordion" style="background:#96CDF1">

          <!-- Sidenav Toggle Button -->
          <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></button>

          <!-- Main Menu Link -->
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/graduation-hat.svg" width="32" height="32" class="d-inline-block align-top" alt="">
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
                <a id="navbarDropdown" class="nav-link" href="/admin/dashboard" role="button" aria-haspopup="true" aria-expanded="false" style="color:black" v-pre>
                  {{ __('Admin Panel') }}
                </a>
              </li>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black" v-pre>
                  {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background:#C3D6D7">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Çıkış') }}
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
          <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-dark">
              <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                  <!-- Sidenav Menu Heading (Core)-->
                  <div class="sidenav-menu-heading">Core</div>
                  <!-- Sidenav Accordion (Dashboard)-->
                  <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></div>
                    Dashboards
                    <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                  </a>
                  <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                      <a class="nav-link" href="index.html">
                        Default
                        <span class="badge badge-primary-soft text-primary ml-auto">Updated</span>
                      </a>
                      <a class="nav-link" href="dashboard-2.html">Multipurpose</a>
                      <a class="nav-link" href="dashboard-3.html">Affiliate</a>
                    </nav>
                  </div>
                  <!-- Sidenav Heading (App Views)-->
                  <div class="sidenav-menu-heading">App Views</div>
                  <!-- Sidenav Accordion (Pages)-->
                  <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></div>
                    Pages
                    <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                  </a>
                  <div class="collapse" id="collapsePages" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                      <!-- Nested Sidenav Accordion (Pages -> Account)-->
                      <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseAccount" aria-expanded="false" aria-controls="pagesCollapseAccount">
                        Account
                        <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                      </a>
                      <div class="collapse" id="pagesCollapseAccount" data-parent="#accordionSidenavPagesMenu">
                        <nav class="sidenav-menu-nested nav">
                          <a class="nav-link" href="account-profile.html">Profile</a>
                          <a class="nav-link" href="account-billing.html">Billing</a>
                          <a class="nav-link" href="account-security.html">Security</a>
                          <a class="nav-link" href="account-notifications.html">Notifications</a>
                        </nav>
                      </div>
                      <!-- Nested Sidenav Accordion (Pages -> Authentication)-->
                      <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                      </a>
                      <div class="collapse" id="pagesCollapseAuth" data-parent="#accordionSidenavPagesMenu">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesAuth">
                          <!-- Nested Sidenav Accordion (Pages -> Authentication -> Basic)-->
                          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseAuthBasic" aria-expanded="false" aria-controls="pagesCollapseAuthBasic">
                            Basic
                            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuthBasic" data-parent="#accordionSidenavPagesAuth">
                            <nav class="sidenav-menu-nested nav">
                              <a class="nav-link" href="auth-login-basic.html">Login</a>
                              <a class="nav-link" href="auth-register-basic.html">Register</a>
                              <a class="nav-link" href="auth-password-basic.html">Forgot Password</a>
                            </nav>
                          </div>
                          <!-- Nested Sidenav Accordion (Pages -> Authentication -> Social)-->
                          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseAuthSocial" aria-expanded="false" aria-controls="pagesCollapseAuthSocial">
                            Social
                            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuthSocial" data-parent="#accordionSidenavPagesAuth">
                            <nav class="sidenav-menu-nested nav">
                              <a class="nav-link" href="auth-login-social.html">Login</a>
                              <a class="nav-link" href="auth-register-social.html">Register</a>
                              <a class="nav-link" href="auth-password-social.html">Forgot Password</a>
                            </nav>
                          </div>
                        </nav>
                      </div>
                      <!-- Nested Sidenav Accordion (Pages -> Error)-->
                      <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                      </a>
                      <div class="collapse" id="pagesCollapseError" data-parent="#accordionSidenavPagesMenu">
                        <nav class="sidenav-menu-nested nav">
                          <a class="nav-link" href="error-400.html">400 Error</a>
                          <a class="nav-link" href="error-401.html">401 Error</a>
                          <a class="nav-link" href="error-403.html">403 Error</a>
                          <a class="nav-link" href="error-404-1.html">404 Error 1</a>
                          <a class="nav-link" href="error-404-2.html">404 Error 2</a>
                          <a class="nav-link" href="error-500.html">500 Error</a>
                          <a class="nav-link" href="error-503.html">503 Error</a>
                          <a class="nav-link" href="error-504.html">504 Error</a>
                        </nav>
                      </div>
                      <!-- Nested Sidenav Accordion (Pages -> Knowledge Base)-->
                      <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#pagesCollapseKnowledgeBase" aria-expanded="false" aria-controls="pagesCollapseKnowledgeBase">
                        Knowledge Base
                        <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
                      </a>
                      <div class="collapse" id="pagesCollapseKnowledgeBase" data-parent="#accordionSidenavPagesMenu">
                        <nav class="sidenav-menu-nested nav">
                          <a class="nav-link" href="knowledge-base-home-1.html">Home 1</a>
                          <a class="nav-link" href="knowledge-base-home-2.html">Home 2</a>
                          <a class="nav-link" href="knowledge-base-category.html">Category</a>
                          <a class="nav-link" href="knowledge-base-article.html">Article</a>
                        </nav>
                      </div>
                      <a class="nav-link" href="pricing.html">Pricing</a>
                      <a class="nav-link" href="invoice.html">Invoice</a>
                    </nav>
                  </div>
                  <!-- Sidenav Heading (Addons)-->
                  <div class="sidenav-menu-heading">Plugins</div>
                  <!-- Sidenav Link (Charts)-->
                  <a class="nav-link" href="charts.html">
                    <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg></div>
                    Charts
                  </a>
                  <!-- Sidenav Link (Tables)-->
                  <a class="nav-link" href="tables.html">
                    <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg></div>
                    Tables
                  </a>
                </div>
              </div>
              <!-- Sidenav Footer-->
              <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                  <div class="sidenav-footer-subtitle">Logged in as:</div>
                  <div class="sidenav-footer-title">Valerie Luna</div>
                </div>
              </div>
            </nav>
          </div>

          <div id="layoutSidenav_content" style="background:#C9CBCC">
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
                  <div class="col-md-6 small">Copyright © Öğrenci Sistemi Sitesi 2021</div>
                  <div class="col-md-6 text-md-right small">
                      <a href="javascript:void(0);">Privacy Policy</a>
                      ·
                      <a href="javascript:void(0);">Terms &amp; Conditions</a>
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
