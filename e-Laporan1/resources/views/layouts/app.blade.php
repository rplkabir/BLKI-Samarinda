<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{URL::asset('image/log.png')}}" />
    <title>BLK Samarinda</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        nav {
            color: white !important;
        }

     html, body {
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background-blend-mode: true;
                background-size:100%;
                background-color: #bdc3c7;
                height: 100%;
                width: 100%;
                overflow: scroll;
                overflow-x: hidden;
            }
            ::-webkit-scrollbar {
            display: none;
            -ms-overflow-style: none;
            }

        input{
            font-size: 15px !important;
        }
        a{
            font-size: 14px !important;
        }
        label{
            font-size: 15px !important;
        }
        .dropdown{
            color: white;
        }

        hr {
            border: 0;
            clear:both;
            display:block;
            width: 96%;
            color: #FFFF00;
            height: 1px;
            }
        </style>
</head>
<body>
        <nav class="navbar navbar-fixed-top" style=" background-color: #2c3e50; " >
            <div class="nav-wrapper">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::guest())
                    @else
                    <ul class="nav navbar-nav navbar-left" >
                        <li>
                            <a href="#" data-activates="slide-out" class="button-collapse menu" style="background-color: rgba(190,200,255,0.8) !important;"><i class="material-icons" style=" color: white;">dehaze</i></a>
                        </li>
                    </ul>
                    @endif
                    <a href="/">
                    <img class="brand-logo center" src="{{ asset('image/logo.png') }}" height="60" style="padding-top: 5"></a>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" style="padding-right: 30px">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li class="dropdown">
                                <a href="#"  style="font-size: 15px; font-weight:bold;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Login <span class="caret"></span>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('login')}}">Login as UPTD</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{route('admin.login')}}">Login as Admin</a></li>
                                    </ul>
                                </a>
                        </li>

                        @elseif (Auth::guard('web')->check())
                        <li>
                            <a onclick="marknotifasreads()" href="{{route('uptd.dokumen')}}"><span class="badge" style="color: pink; "><strong id="load_notif">{{ count(Auth::user()->unreadNotificationsByType ) }}</span>Pemberitahuan</strong></a>
                        </li>
                        <li>
                                <a href="{{url('uptd/commentadmin')}}">
                                <span class="badge" style="color: pink;    "> <strong id="load_comment">{{ count(Auth::user()->unreadNotificationsnotifcomment ) }}</strong>     </span><strong>Notif Laporan</strong></a>
                        </li>
                            <li class="dropdown">
                                <a href="#" style="font-size: 13px; font-weight:bold;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                @if(DB::table('profils')->where('users_id','=',Auth::user()->id)->count() > 0)
                                   <li>
                                        @foreach(DB::table('profils')->where('users_id','=',Auth::user()->id)->get() as $data)
                                            <a href="{{ url('/profile/edit/'.$data->id) }}"><i class="material-icons">person</i> Edit Profile</a>
                                        </li>
                                        @endforeach
                                @else
                                        <li>
                                            <a href="{{url('profile/tambah')}}"><i class="material-icons">person</i>Tambah Profile</a>
                                        </li>
                                @endif
                                    <li>
                                      <a href="{{ url('uptd/editemail/'.Auth::user()->id)}}"><i class="material-icons">email</i> Edit Email</a>
                                    </li>
                                    <li>
                                       <a href="{{ url('/uptd/editpass/'.Auth::user()->id) }}"><i class="material-icons">lock</i> Ubah Password</a>
                                    </li>
                                    <li>
                                       <a href="{{route('user.logout')}}"><i class="material-icons">power_settings_new</i> Logout</a>
                                    </li>
                                </ul>
                            </li>

                        @elseif(Auth::guard('admin')->check())
                            <li>
                                <a onclick="marknotifasread()" href="{{url('admin/dokumenuptd')}}">
                                <span class="badge" style="color: #42f459; font-size: 15px"> <strong id="load_notif">{{ count(Auth::user()->unreadNotificationsuptd ) }}</strong></span><strong>Dokumen Uptd</strong></a>
                            </li>

                            <li>
                                <a href="{{url('admin/laporanuptd')}}"><span class="badge" style="color: #42f459; font-size: 15px"> <strong id="load_notifuptd">{{ count(Auth::user()->unreadNotificationsByAdmin ) }}</strong></span><strong>Laporan UPTD</strong></a>
                            </li>

                            <li class="dropdown">
                                <a style="font-size: 15px; font-weight:bold;"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Admin <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      <a href="{{ url('admin/editemail/'.Auth::user()->id)}}"><i class="material-icons">email</i> Edit Email</a>
                                    </li>
                                    <li>
                                       <a href="{{ url('/admin/editpass/'.Auth::user()->id) }}"><i class="material-icons">lock</i> Ubah Password</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.logout')}}"><i class="material-icons">power_settings_new</i> Logout</a>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>


                        @if(Auth::guard('admin')->check())
                          <ul id="slide-out" class="side-nav">
                            <li><div class="user-view">
                              <div class="background">
                                <img src="{{ URL::asset('image/bghome.jpg') }}">
                              </div>
                              <a href="#!user"><img class="circle" src="https://www.knowmuhammad.org/img/noavatarn.png"></a>
                              <a href="#!name"><span class="white-text name"><i class="material-icons">person</i>Admin</span></a>
                            </div></li>
                            <li><a href=" {{ route('admin')}}"><i class="material-icons">dashboard</i>Dashboard</a></li>
                            <li><a href="{{route('admin.renlakgiat')}}"><i class="material-icons">description</i>Data Renlakgiat</a></li>
                            <li><a href="{{route('admin.user')}}"><i class="material-icons">wc</i>Data User</a></li>
                            <li><a href="{{route('admin.profile')}}"><i class="material-icons">work</i>Data UPTD</a></li>
                            <li><div class="divider"></div></li>
                            <li><a class="subheader">Other</a></li>
                            <li><a href="{{route('dokumen')}}"><i class="material-icons">list</i> Upload Dokumen Khusus</a></li>


                        @elseif (Auth::guard('web')->check())

                        <ul id="slide-out" class="side-nav">
                            @foreach(DB::table('profils')->where('users_id','=',Auth::user()->id)->get() as $data)
                            <li><div class="user-view">
                              <div class="background">
                                <img src="{{asset('upload/'.$data->foto_gedung)}}">
                              </div>
                              <a href="#!user"><img class="circle" src="{{asset('upload/'.$data->foto_pimpinan)}}"></a>

                                <a href="{{ route('profile')}}"><span class="white-text name"><i class="material-icons">person</i>{{ $data->nama_lembaga }}</span></a>
                            </div></li>
                            <li><a href=" {{ route('home')}}"><i class="material-icons">dashboard</i>Dashboard</a></li>
                            <li><a href="{{url('uptd/pktp/'.Auth::user()->id)}}"><i class="material-icons">assignment_ind</i>Data Pengelola</a></li>
                            <li><a href="{{route('uptd.renlakgiat')}}"><i class="material-icons">storage</i>Data Renlakgiat</a></li>
                            <li><div class="divider"></div></li>
                            <li><a class="subheader">Other</a></li>
                            <li><a href="{{url('uptd/dokumen/index')}}"><strong>Upload Dokumen</strong></a></li>
                            <li>

                            </li>
                            @endforeach
                        </ul>

                        @endif
            </div>
        </nav>
       <div id="app" style="background-color: rgba(255,255,255,0.4) !important;">
            <div class="container" >

            </div>
        </div>
        <br>
        <div class="container" style="padding-top: 50px;">
            <div class="row">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    <footer class="footer" style=" position: fixed; bottom: 0; width: 100%; background-color: #2c3e50;">
          <div class="footer-copyright" >
            <div class="container" style="color: white">
                <p align="center">
                    &copy Copyright BLK Samarinda 2018 | Powered By: D'canteen Corp
                </p>


            </div>
          </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav({
              menuWidth: 300,
              edge: 'left',
              closeOnClick: true,
              draggable: true,
              onOpen: function(el) {},
              onClose: function(el) {  },
        });
    </script>
</body>
</html>
