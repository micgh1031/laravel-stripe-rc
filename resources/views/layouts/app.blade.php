<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title>Train Smart Payment Gateway</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Subscription options for the Train Smart app."/>
  <meta name="keywords" content=""/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Additional Styles -->
  @yield('style')
</head>

<body id="main" data-spy="scroll">
  <!-- .overlay-body -->
  <div class="overlay-body">
  </div>
  <!-- .overlay-body end -->

  <!-- #header -->
  @include('includes.header')
  <!-- #header end -->

  <!-- main content -->
  @yield('content')
  <!-- main content end -->

  <!-- #footer -->
  @include('includes.footer')
  <!-- #footer end -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Additional Scripts -->
  @yield('script')
</body>
</html>
