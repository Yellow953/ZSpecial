<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - ZSpecial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('admin/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('admin/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('admin/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-form-head"
                        style="border-radius: 25px 25px 0 0; border: 1px black solid; border-bottom: none;">
                        <h4>Login</h4>
                    </div>
                    <div class="login-form-body"
                        style="border-radius: 0 0 25px 25px; border: 1px black solid; border-top: none;">
                        <div class="form-gp">
                            <label for="email" class="text-dark">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-gp">
                            <label for="password" class="text-dark">Password *</label>
                            <input type="password" id="password" name="password" required autofocus>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="/register">Sign up</a></p>
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" class="bg-primary text-white">Login <i
                                    class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="{{asset('admin/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slicknav.min.js')}}"></script>

    <!-- others plugins -->
    <script src="{{asset('admin/js/plugins.js')}}"></script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
</body>

</html>