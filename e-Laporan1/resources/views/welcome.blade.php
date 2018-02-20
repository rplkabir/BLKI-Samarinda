<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('image/logo.png')}}" />
    <title>BLK Samarinda</title>


    <!-- materialize css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
      <!--Import materialize.css-->
    <style type="text/css">
        .nav-link{
            color: white;
        }
        .navbar-brand{
            color: white;
        }
        body {
          background-size: 100%;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;
          background-image: url({{ asset('image/bg/20171206_102719.jpg') }});
        }
    </style>
  </head>

  <body style="background-image: ">

    <!-- Navigation -->
    <nav style="background-color: #2c3e50 !important;">
    <div class="nav-wrapper">
      <a class="navbar-brand" href="{{URL('/')}}" style="padding-left: 20px;">BLK Samarinda</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="#" class="nav-link">About</a></li>
        <li><a href="#" class="nav-link">Contact</a></li>
        <li>
          @if (Route::has('login'))
                @if (Auth::guard('web')->check())
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                @elseif(Auth::guard('admin')->check())
                    <a href="{{ route('admin') }}" class="nav-link">Home</a>
                
                @else
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Login<i class="material-icons right">arrow_drop_down</i></a></li>
                @endif
          @endif
        </li>
      </ul>
    </div>
  </nav>

        <ul id="dropdown1" class="dropdown-content" style="background-color: #2c3e50;">
            <li><a class="waves-effect waves-light" href="{{ url('/login') }}" style="color: white">Login UPTD</a></li>
            <li><a class="waves-effect waves-light" href="{{ route('admin.login') }}" style="color: white">Login Admin</a></li>
          </ul>
<header>
</header>
    <!-- Footer -->
    <footer class="footer" style=" position: fixed; bottom: 0; width: 100%; background-color: #2c3e50;">
          <div class="footer-copyright" >
            <div class="container" style="color: white">
                <p align="center">
                    © Copyright BLK Samarinda 2018 | Powered By: D'canteen Corp
                </p>
            
            
            </div>
          </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('gg/vendor/jquery/jquery.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
     $('.dropdown-button').dropdown();
    </script>
  </body>

</html>
