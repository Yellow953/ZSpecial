<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZSpecial Admin') }}</title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}" type="image/x-icon">

    {{-- Template --}}
    <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/slicknav.min.css') }}">

    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />

    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('/admin/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/responsive.css') }}">

    <!-- modernizr css -->
    <script src="{{ asset('/admin/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    {{-- Switch --}}
    <link rel="stylesheet" href="{{asset('/assets/css/switch.min.css')}}">
    <script src="{{asset('/assets/js/switch.min.js')}}"></script>

    {{-- Sweet Alert --}}
    <script src="{{asset('/assets/js/sweetalert.min.js')}}"></script>

    {{-- JQuery --}}
    <script src="{{asset('/admin/js/jquery.min.js')}}"></script>
</head>

<body>
    <div id="app">
        <!-- page container area start -->
        <div class="page-container">
            @include('admin._navbar')

            <!-- main content area start -->
            <div class="main-content">
                @include('admin._header')

                @include('admin._flash')

                @yield('content')
            </div>
            <!-- main content area end -->

            @include('admin._footer')
        </div>
        <!-- page container area end -->

    </div>

    <!-- jquery latest version -->
    <script src="{{ asset('/admin/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/admin/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.slicknav.min.js') }}"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="{{ asset('/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('/admin/js/scripts.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="{{asset('/assets/js/sweetalert.min.js')}}">
    </script>

    {{-- Delete Confirmation --}}
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>