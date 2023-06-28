@extends('admin.app')

@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Logs</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Logs</h6>
        </nav>
        <div class="ms-md-auto pe-md-3 flex align-items-center">
            <div class="input-group input-group-outline">
                <form action="/logs" method="get">
                    <div class="input-group input-group-outline">
                        <label for="filter_start" class="mx-1 my-3">From:</label>
                        <input type="date" class="form-control mx-1 rounded" name="filter_start"
                            value="{{request()->query('filter_start')}}" placeholder="From...">
                        <label for="filter_end" class="mx-1 my-3">To:</label>
                        <input type="date" class="form-control mx-1 rounded" name="filter_end"
                            value="{{request()->query('filter_end')}}" placeholder="To...">
                        <input type="text" class="form-control mx-1 rounded" name="search"
                            value="{{request()->query('search')}}" placeholder="Type here...">
                        <button type="submit" class="btn btn-primary m-1 btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                class="bi bi-search mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- End Navbar -->
<div class="container-fluid px-2 px-md-4">
    <div class="page-header border-radius-xl mt-4"
        style="min-height: 300px; border-radius: 50px; background-repeat: no-repeat; background-size: cover; background-image: url({{asset('admin/images/archives.png')}});">
    </div>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-10 mx-auto">
                <div class="p-3">
                    <h3 class="mb-0">Logs</h3>
                </div>

                @forelse ($logs as $l)
                <div class="card mt-4">
                    <div class="alert alert-secondary m-0 text-dark text-lg px-5 py-3">
                        {{$l->text}}
                    </div>
                </div>
                @empty
                <div class="card mt-4" id="logs">
                    <div class="m-5 ">
                        No Logs Found
                    </div>
                </div>
                @endforelse
                <div class="w-50">
                    {{ $logs->appends(['search' => request()->query('search'), 'filter_start' =>
                    request()->query('filter_start'), 'filter_end' =>
                    request()->query('filter_end')])->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection