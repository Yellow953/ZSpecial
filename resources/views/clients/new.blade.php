@extends('admin.app')

@section('content')
<a href="/clients" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Edit Client</h4>
        <form method="POST" action="/client/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name *</label>
                <input class="form-control input-rounded" name="name" required type="text" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Email *</label>
                <input class="form-control input-rounded" name="email" required type="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="phone" class="col-form-label">Phone *</label>
                <input class="form-control input-rounded" name="phone" required type="tel" value="{{old('phone')}}">
            </div>
            <div class="form-group">
                <label for="address" class="col-form-label">Address</label>
                <input class="form-control input-rounded" name="address" type="text" value="{{old('address')}}">
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection