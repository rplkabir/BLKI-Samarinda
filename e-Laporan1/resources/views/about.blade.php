<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('image/log.png')}}" />
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
        }
    </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav style="background-color: #2c3e50 !important;">
    <div class="nav-wrapper">
      <a class="navbar-brand" href="{{URL('/')}}" style="padding-left: 20px;">BLK Samarinda</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="{{URL('/about')}}" class="nav-link">About</a></li>
        <li><a href="{{URL('/contact')}}" class="nav-link">Contact</a></li>
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
	<div class="container">
		<div class="row">
			<p align="center">
				<img src="{{URL::asset('image/log.png')}}">
				<h4 align="center">
					KEMENTERIAN KETENAGAKERJAAN REPUBLIK INDONESIA
				</h4>
				<h4 align="center">
					DIREKTORAT JENDERAL PEMBINAAN PELATIHAN DAN PRODUKTIVITAS
				</h4>
				<h3 align="center">
					BALAI LATIHAN KERJA SAMARINDA
				</h3>
			</p>
			<br>
			<br>
			<h3 align="center">Visi</h3>
			<p align="center">Menjadi pelopor dalam pengembangan Sumber Daya Manusia untuk kebutuhan dunia usaha dan dunia industri regional.</p>
			<h3 align="center">Misi</h3>
			<p align="center">
				Menyelenggarakan pelatihan secara profesional dalam rangka menghasilkan tenaga kerja yang kompeten untuk mendukung industri regional sesuai dengan perkembangan ilmu pengetahuan dan teknologi.

			</p>
			<h3 align="center">Moto</h3>
			<p align="center"><strong>Cerdas Dalam Produktivitas</strong>. Moto tersebut mengandung makna bahwa dalam menghasilkan sebuah produk layanan harus menggunakan kecerdasan agar mampu memberikan pelayanan yang terbaik kepada masyarakat.</p>
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
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
     $('.dropdown-button').dropdown();
    </script>
  </body>

</html>
