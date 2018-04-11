<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>BLK Samarinda</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('image/log.png')}}" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        .nav-item{
        	background-color: grey;
        }
        body {
          background-size: 100%;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;
          background-image: url({{ asset('image/bg/20171206_102719.jpg') }});
			-webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">            
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="{{URL('/')}}" style="padding-left: 20px;">BLK Samarinda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
           
            <li class="nav-item">
          @if (Route::has('login'))
                @if (Auth::guard('web')->check())
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                @elseif(Auth::guard('admin')->check())
                    <a href="{{ route('admin') }}" class="nav-link">Home</a>
             </li>
                @else
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                    	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				         	<a class="dropdown-item" href="{{ url('/login') }}" >Login UPTD</a>
				         	<div class="dropdown-divider"></div>
            				<a class="dropdown-item" href="{{ route('admin.login') }}">Login Admin</a>
				          
				        </div>
                    </li>
                @endif
          @endif
        
        </ul>
        
    </div>
         
</nav>


<!-- Footer -->
    <footer class="footer" style=" position: fixed; bottom: 0; width: 100%; background-color: #2c3e50;">
          <div class="footer-copyright" >
            <div class="container" style="color: white">
                <p align="center">
                    © Copyright BLK Samarinda 2018
                </p>
            
            
            </div>
          </div>
    </footer>


<!-- javascripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('gg/vendor/jquery/jquery.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
     $('.dropdown-button').dropdown();
    </script>
</body>
</html>