@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
</div>
@endif

@if ($message = Session::get('danger'))
<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
    </button>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif