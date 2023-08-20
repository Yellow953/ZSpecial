@extends('admin.app')

@section('content')
<a href="/users" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Edit User</h4>
        <form method="POST" action="/user/{{$user->id}}/update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="phone" class="col-form-label">Telephone</label>
                <input class="form-control input-rounded" name="phone" value="{{$user->phone}}" type="tel">
            </div>
            <div class="form-group">
                <label for="address" class="col-form-label">Address</label>
                <input class="form-control input-rounded" name="address" value="{{$user->address}}" type="text">
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection