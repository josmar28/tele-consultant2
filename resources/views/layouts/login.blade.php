<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/plugin/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-login-style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/login.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('public/css/login-style.css') }}">
    <link rel="icon" href="{{ asset('public/img/dohro12logo2.png') }}">
    <link href="{{ asset('public/plugin/select2/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/plugin/Lobibox/lobibox.css') }}">

    <title>DOH CHD XII – Tele Consultation</title>
    @yield('css')
    <style>
      .select2 {
          width:100%!important;
      }
    </style>
  </head>
  <body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('public/js/login/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/js/login/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/login/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/login/main.js') }}"></script>  
    <script src="{{ asset('public/plugin/select2/select2.min.js') }}?v=1"></script>
    <script src="{{ asset('public/plugin/Lobibox/Lobibox.js') }}?v=1"></script>
    <script src="{{ asset('public/assets/js/jquery.form.min.js') }}"></script>
    @yield('js')
  </body>
</html>