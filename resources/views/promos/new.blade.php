@extends('admin.app')

@section('content')
<a href="/promos" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Promo</h4>
        <form method="POST" action="/promo/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name *</label>
                <input class="form-control input-rounded" name="name" required type="text" placeholder="Promo"
                    value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="value" class="col-form-label">Value *</label>
                <input class="form-control input-rounded" name="value" required type="number" placeholder="0.1"
                    step="0.1" value="{{old('value')}}">
            </div>
            <div class="form-group">
                <label for="valid_untill" class="col-form-label">Valid Untill</label>
                <input class="form-control input-rounded" name="valid_untill" type="date">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Create</button>
            </div>
        </form>
    </div>
</div>


@endsection