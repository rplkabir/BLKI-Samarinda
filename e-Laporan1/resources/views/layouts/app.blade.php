<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}">
<head>
    <title></title>
    <title>BLK Samarinda</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="{{URL::asset('image/log.png')}}" />

    <!-- Styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <style type="text/css">
        nav {
            background-color: #2c3e50 !important;
            color: #2c3e50 !important;
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
        .nav-link{
            color: black;
        }

        hr {
            border: 0;
            clear:both;
            display:block;
            width: 96%;
            color: #FFFF00;
            height: 1px;
            }
            .navbar-toggler{
                display: block;
                z-index: 9999;
            }
            .dual-collapse2{

                background-color:  #2c3e50;
            }
        </style>
</head>
<body>

<div class="container">
<nav class="navbar navbar-default navbar-fixed-top" id="defaultNavbar1">    
    <div class="container-fluid">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">            
        
        </ul>
    </div>

     @if (Auth::guest())
                    @else
                    <ul class="nav navbar-nav navbar-left" >
                        <li>
                            <a href="#" data-activates="slide-out" class="button-collapse menu" style="background-color: rgba(190,200,255,0.8) !important;"><i class="material-icons" style=" color: white;">menu</i></a>
                        </li>
                    </ul>
            @endif

    <div class="mx-auto order-0">
        
        <button style="position: top; background-color: white" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".dual-collapse2" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

        <ul class="navbar-nav ml-auto pull-right">
            <li class="nav-item"><a class="navbar-brand mx-auto" href="{{URL('/')}}" style="padding-left: 20px;">BLK Samarinda</a></li>
          @if (Auth::guest())
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/login') }}" >Login UPTD</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.login') }}">Login Admin</a>
                          
                        </div>
                    </li>
         @elseif (Auth::guard('web')->check())
                    <li class="nav-item">
                        <a class="nav-link" onclick="marknotifasreads()" href="{{route('uptd.dokumen')}}"><strong>Pemberitahuan</strong><span class="badge" style="color: pink;"><strong id="load_notif">{{ count(Auth::user()->unreadNotificationsByType ) }}</strong></span></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="{{url('uptd/commentadmin')}}"><strong>Notif Laporan</strong>
                                <span class="badge" style="color: pink;"> <strong id="load_comment">{{ count(Auth::user()->unreadNotificationsnotifcomment ) }}</strong>     </span></a>
                    </li>


                    <li class="nav-item dropdown">
                        <a href="#" style="font-size: 13px; font-weight:bold;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownweb" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownweb">
                            @if(DB::table('profils')->where('users_id','=',Auth::user()->id)->count() > 0)
                                @foreach(DB::table('profils')->where('users_id','=',Auth::user()->id)->get() as $data)
                                <a class="dropdown-item" href="{{ url('/profile/edit/'.$data->id) }}" style="color: grey;"><i class="material-icons">person</i> Edit Profile</a>
                                @endforeach 
                            @else
                                <a class="dropdown-item" href="{{url('profile/tambah')}}" style="color: grey;"><i class="material-icons">person</i>Tambah Profile</a>
                            @endif
                                <a class="dropdown-item" href="{{ url('uptd/editemail/'.Auth::user()->id)}}" style="color: grey;"><i class="material-icons">email</i> Edit Email</a>
                                <a class="dropdown-item" href="{{ url('/uptd/editpass/'.Auth::user()->id) }}" style="color: grey;"><i class="material-icons">lock</i> Ubah Password</a>
                                <a class="dropdown-item" href="{{route('user.logout')}}"><i class="material-icons" style="color: grey;" >power_settings_new</i> Logout</a>
                          
                        </div>
                    </li>
             
         @elseif(Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" onclick="marknotifasread()" href="{{url('admin/dokumenuptd')}}">
                                <span class="badge" style="color: #42f459; font-size: 15px "> <strong id="load_notif">{{ count(Auth::user()->unreadNotificationsuptd ) }}</strong></span><strong>Dokumen Uptd</strong></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="{{url('admin/laporanuptd')}}"><span class="badge" style="color: #42f459; font-size: 15px   "> <strong id="load_notifuptd">{{ count(Auth::user()->unreadNotificationsByAdmin ) }}</strong>     </span><strong>Laporan UPTD</strong></a>
                    </li>

                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownadm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: grey;"> {{Auth::user()->name}} <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownadm">
                            <a class="dropdown-item" href="{{ url('admin/editemail/'.Auth::user()->id)}}" style="color: grey;"><i class="material-icons">email</i> Edit Email</a>
                                    
                            <a class="dropdown-item" href="{{ url('/admin/editpass/'.Auth::user()->id) }}" style="color: grey;"><i class="material-icons">lock</i> Ubah Password</a>
                                    
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="material-icons" style="color: grey;">power_settings_new</i> Logout</a>
                          
                        </div>
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

                                <a href="{{ route('profile')}}"><span class="white-text name"><i class="material-icons">person</i>{{ Auth::user()->name}}</span></a>
                            </div></li>
                            <li><a href=" {{ route('home')}}"><i class="material-icons">dashboard</i>Dashboard</a></li>
                            <li><a href="{{url('uptd/pktp/'.Auth::user()->id)}}"><i class="material-icons">assignment_ind</i>Data Pengelola</a></li>
                            <li><a href="{{route('uptd.renlakgiat')}}"><i class="material-icons">storage</i>Data Renlakgiat</a></li>
                            <li><div class="divider"></div></li>
                            <li><a class="subheader">Other</a></li>
                            <li><a href="{{url('uptd/dokumen/index')}}"><i class="material-icons">attach_file</i><strong>Upload Dokumen</strong></a></li>
                            <li>

                            </li>
                            @endforeach
                        </ul>

                        @endif
        
    </div>
        </div> 
    </nav>
</div>


<div id="app" style="background-color: rgba(255,255,255,0.4) !important;">
            <div class="container" >

            </div>
        </div>
        <br>
        <div class="container" style="padding-top: 50px;">
            <div class="row">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                  </p>
                @endif
                @yield('content')
            </div>
        </div>


<!-- javascripts -->
<!-- javascripts -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('gg/vendor/jquery/jquery.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
     $(function () {
    $('.dropdown-menu').click(function (e) {
        $('.active').removeClass('active');
    });
});
    </script>
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