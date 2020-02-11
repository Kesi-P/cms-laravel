<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>
      @yield('title')
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
  </head>

  <body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
      <div class="container">

        <div class="navbar-left">
          <button class="navbar-toggler" type="button">&#9776;</button>
          <a class="navbar-brand" href="/">
            <img class="logo-dark" src="../assets/img/logo-dark.png" alt="logo">
            <img class="logo-light" src="../assets/img/logo-light.png" alt="logo">
          </a>
        </div>



        <a class="btn btn-xs btn-round btn-success" href="{{route ('login')}}">Login</a>

      </div>
    </nav><!-- /.navbar -->


    <!-- Header -->
    @yield('header')
  <!-- /.header -->


    <!-- Main Content -->
   @yield('content')


    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row gap-y align-items-center">

          <div class="col-6 col-lg-3">
            <a href="../index.html"><img src="../assets/img/logo-dark.png" alt="logo"></a>
          </div>


        </div>
      </div>
    </footer><!-- /.footer -->


    <!-- Scripts -->
    <script src="{{ asset('js/page.min.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>

  </body>
</html>
