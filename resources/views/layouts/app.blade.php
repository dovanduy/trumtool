<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>TrumTool</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.min.css') }}">
     
    <meta itemprop="url" content="{{url('/')}}" />
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
   
    @yield('content')


  <script src="{{ asset('assets/dashboard/js/app.js') }}"></script>
  @yield('script')
</body>
</html>
