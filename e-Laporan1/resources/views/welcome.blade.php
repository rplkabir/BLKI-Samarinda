<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{URL::asset('image/logo.png')}}" />
        <title>BLKI SMD</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background-repeat : no-repeat;
                background-size:cover;
                background-image: url("{{URL::asset('image/bghome.jpg')}}");
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-top position-ref full-height">

            <div class="content">
                <div class="title m-b-md" style="font-size: 60px; color: white">
                    <br>
                    <img src="{{URL::asset('image/logo.png')}}"> <br>
                    <b>
                    BLKI SAMARINDA
                    </b>

                </div>

                <div class="links">
                    @if (Route::has('login'))
                    @if (Auth::guard('web')->check())
                        <a href="{{ url('/home') }}"><span class="material-icons large" style="font-size: 60px; color: white">home</span></a>
                    @elseif(Auth::guard('admin')->check())
                        <a href="{{ route('admin')}}"><span class="material-icons large" style="font-size: 40px; color: white">home</span></a>
                    @else
                        |   <a class="waves-effect waves-light btn" href="{{ url('/login') }}" style="color: white">Login UPTD</a>
                        |   <a class="waves-effect waves-light btn" href="{{ route('admin.login') }}" style="color: white">Login Admin</a>
                        |   
                    @endif
            @endif
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    </body>
</html>
