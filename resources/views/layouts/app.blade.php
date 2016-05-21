<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EHSQ | Bienvenido </title>
  <!-- Bootstrap core CSS -->
  <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
  <!-- Custom styling plus plugins -->
  <link href="{{ URL::asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">
  <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
  <!--[if lt IE 9]>
  <script src="assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>

<body style="background:#0074A2;">

    @yield('content')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
