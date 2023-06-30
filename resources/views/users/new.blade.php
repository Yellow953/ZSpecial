@extends('admin.app')

@section('content')
<a href="/users" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New User</h4>
        <form method="POST" action="/user/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                <input class="form-control input-rounded" name="name" required type="text" placeholder="John Doe"
                    value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input class="form-control input-rounded" name="email" required type="email" placeholder="john@doe.com"
                    value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="phone" class="col-form-label">Telephone</label>
                <input class="form-control input-rounded" name="phone" required type="tel" placeholder="+961 01 234 567"
                    value="{{old('phone')}}">
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" class="form-control input-rounded" name="password" placeholder="********"
                    required>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-form-label">Password Confirmatison</label>
                <input type="password" class="form-control input-rounded" name="password_confirmation"
                    placeholder="********" required>
            </div>

            <div class="form-group">
                <label for="role" class="col-form-label">Role</label>
                <select class="form-control input-rounded" name="role">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection