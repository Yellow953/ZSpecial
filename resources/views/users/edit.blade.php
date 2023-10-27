@extends('admin.app')

@section('content')
<div class="container">
    <a href="/users" class="btn text-secondary">
        <h3>
            < back</h3>
    </a>

    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <div class="card border">
                <div class="card-header bg-info">
                    <h2 class="font-weight-bolder text-center my-4">Edit User</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/users/{{$user->id}}/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input class="form-control" name="name" value="{{$user->name}}" type="text">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-form-label">Telephone</label>
                            <input class="form-control" name="phone" value="{{$user->phone}}" type="tel">
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-form-label">Address *</label>
                            <input class="form-control" name="address" required type="text" placeholder="Address..."
                                value="{{ $user->address }}">
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>
                            <select class="custom-select" name="role">
                                <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>User</option>
                                <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                            </select>
                        </div>

                        <div class="w-100 mt-5">
                            <button type="submit" class="btn btn-info w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection