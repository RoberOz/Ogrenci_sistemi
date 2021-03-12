<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Öğrenci Sistemi', 'Öğrenci Sistemi') }}</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

  </head>
  <body class="nav-fixed">

    <div id="app">
      @include('layouts.top-nav')

      <div id="layoutSidenav">
        @if (auth()->user())
          @include('layouts.side-nav')
        @endif
        <div id="layoutSidenav_content" style="background:#EFEFEF">
          <main>
            @include('layouts.header')
            @yield('content')
          </main>
        </div>
      </div>
    </div>

    @include('layouts.footer')

    @stack('user-delete-javascript')
    @stack('lecture-delete-javascript')
    @stack('department-delete-javascript')
    @stack('department-head-delete-javascript')
    @stack('department-lecture-delete-javascript')
    @stack('department-user-delete-javascript')
    @stack('department-lecture-exam-date-delete-javascript')
    @stack('exam-javascripts')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>

  </body>
</html>
