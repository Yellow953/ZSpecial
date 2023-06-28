@extends('admin.app')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Notifications</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Notifications</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- End Navbar -->
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4 custom-height"
        style="background-image: url({{asset('/assets/images/POS.png')}});"></div>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-10 mx-auto">
                <div class="p-3">
                    <h3 class="mb-0">Notifications</h3>
                </div>
                @forelse ($notifications as $notification)
                <div class="card mt-4">
                    <div
                        class="alert {{Str::contains($notification, 'Soon') ? 'alert-warning' : ''}} {{Str::contains($notification, 'Urgently') ? 'alert-danger' : ''}} m-0 text-dark text-lg px-5 py-3">
                        {{$notification}}
                    </div>
                </div>
                @empty
                <div class="card mt-4" id="notifications">
                    <div class="m-5 ">
                        No Notifications Found...
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection