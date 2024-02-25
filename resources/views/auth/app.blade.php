<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ZSpecial | @yield('title')</title>

    <!-- favicon -->
    <link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/gif" />

    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/themify-icons.css')}}">

    <!-- others css -->
    <link rel="stylesheet" href="{{asset('admin/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>

<body>
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- login area end -->
</body>

</html>