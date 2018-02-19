<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('image/logo.png')}}" />
    <title>BLKI Provinsi Kalimantan Timur</title>

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
        <a class="navbar-brand" href="#"><img src="{{asset('image/logo.png')}}" width="35" height="35"> BLK</a>
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
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('image/bg/20171206_102719.jpg')">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('image/bg/20171206_102846.jpg')">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('image/bg/20171206_103012.jpg')">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <p align="center"><img src="{{asset('image/logo.png')}}" ></p>
        <H2 align="center">KEMENTERIAN KETENAGAKERJAAN REPUBLIK INDONESIA</H2>
        <h2 align="center">DIREKTORAT JENDERAL PEMBINAAN PELATIHAN DAN PRODUKTIVITAS</h2>
        <h1 align="center">BALAI LATIHAN KERJA SAMARINDA</h1>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; BLK Samarinda 2018 | Powered By: D'Canteen Coworking</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('gg/vendor/jquery/jquery.min.js')}} "></script>
    <script src="{{asset('gg/vendor/bootstrap/js/bootstrap.bundle.min.js')}} "></script>

  </body>

</html>
