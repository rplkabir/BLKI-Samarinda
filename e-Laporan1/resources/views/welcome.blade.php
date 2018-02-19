<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('image/logo.png')}}" />
    <title>BLK Samarinda</title>

    <!-- Bootstrap core CSS -->
    <link href=" {{asset('gg/vendor/bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('gg/css/full-slider.css')}}" rel="stylesheet">
    <style type="text/css">
        .nav-link{
            color: white;
        }
        .navbar-brand{
            color: white;
        }
    </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background: grey;">
      <div class="container">
        <a class="navbar-brand" href="{{URL('/')}}">BLK Samarinda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                @if (Route::has('login'))
                @if (Auth::guard('web')->check())
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                @elseif(Auth::guard('admin')->check())
                    <a href="{{ route('admin') }}" class="nav-link">Home</a>
            </li>
            
                    @else
                            <li class="nav-item">  
                                <a class="waves-effect waves-light btn" href="{{ url('/login') }}" style="color: white">Login UPTD</a>
                            </li>
                            <li>
                                <a class="waves-effect waves-light btn" href="{{ route('admin.login') }}" style="color: white">Login Admin</a>
                            </li>
                         
                    @endif
                @endif
                
        
          </ul>
        </div>
      </div>
    </nav>

    <header>
      
        <div class="carousel">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('image/bg/20171206_102719.jpg')">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
          </div>
      </div>
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
    <script src="{{asset('gg/vendor/bootstrap/js/bootstrap.bundle.min.js')}} "></script>

  </body>

</html>
