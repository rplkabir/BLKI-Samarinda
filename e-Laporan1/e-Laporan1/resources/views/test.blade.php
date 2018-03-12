<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{URL::asset('image/logo.png')}}" />
    <title>BLKI SAMARINDA</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<title></title>
</head>
<body>
<a class="button-collapse" href="#" data-activates="slide-out">
                        <img src="{{URL::asset('image/logo.png')}}" height="40" width="40">
                    </a>
                    <ul id="slide-out" class="side-nav">
                            <li><div class="user-view">
                              <div class="background">
                                <img src="images/office.jpg">
                              </div>
                              <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
                              <a href="#!name"><span class="white-text name">John Doe</span></a>
                              <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
                            </div></li>
                            <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
                            <li><a href="#!">Second Link</a></li>
                            <li><div class="divider"></div></li>
                            <li><a class="subheader">Subheader</a></li>
                            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
                          </ul>
                          <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

  <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav(
            {
      menuWidth: 300,
      edge: 'left', 
      closeOnClick: true,
      draggable: true, 
      onOpen: function(el) {},
      onClose: function(el) {  },
        }
            );
    </script>
</body>
</html>
