@extends('admin.app')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Backup</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Backup</h6>
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
        style="min-height: 300px; border-radius: 50px; background-repeat: no-repeat; background-size: cover; background-image: url({{asset('admin/images/servers.jpg')}});">
    </div>

    <div class="card card-body mx-1 mx-md-4 mt-n6">
        <p class="text-danger"><u>Note:</u> Please Import in descending order (top to bottom) and do not upload empty
            Excels. Otherwise it will cause errors!</p>
        <h5 class="text-secondary mt-2 text-decoration-underline">Categories</h5>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/categories" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="categories" required
                            class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/categories" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
        <hr>

        <h5 class="text-secondary mt-2 text-decoration-underline">Products</h5>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="products" required
                            class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/products" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
        <hr>

        <h5 class="text-secondary mt-2 text-decoration-underline">Logs</h5>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/logs" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="logs" required class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/logs" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
        <hr>

        <h5 class="text-secondary mt-2 text-decoration-underline">Users</h5>
        <small class="text-danger"><u>Note:</u> all users will have a password of "qwe123" when imported</small>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/users" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="users" required class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/users" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
        <hr>

        <h5 class="text-secondary mt-2 text-decoration-underline">Clients</h5>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/clients" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="users" required class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/clients" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
        <hr>

        <h5 class="text-secondary mt-2 text-decoration-underline">Orders</h5>
        <div class="row my-2 ">
            <div class="col-md-6">
                <form action="/backup/import/orders" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="file" name="orders" required class="form-control input-field border input-rounded">
                        <button type="submit" class="btn btn-info btn-rounded m-2">Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="/backup/export/orders" class="text-center btn btn-info m-2 btn-rounded">
                    Export
                </a>
            </div>
        </div>
    </div>
</div>
@endsection