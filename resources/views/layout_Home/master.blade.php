<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <script src="{{ asset('dist/js/demo.js') }}"></script>

</head>
<body class="hold-transition skin-purple sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- =============================================== -->

  @include('layout_home.header')
  @include('layout_home.sidebar')

  <!-- =============================================== -->

  <div class="content-wrapper">

    @yield('PetControl')

  </div>

  <div class="control-sidebar-bg"></div>
</div>

</body>
</html>
