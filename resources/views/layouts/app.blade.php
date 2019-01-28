<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SisVentas</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/assets/css/_all-skins.min.css') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/img/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}">
</head>
<body class="hold-transition login-page">

    <main class="py-4">
        @yield('content')
    </main>

<script src="{{ asset('/assets/js/jQuery-2.1.4.min.js') }}"></script>   
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/assets/js/app.min.js') }}"></script>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
