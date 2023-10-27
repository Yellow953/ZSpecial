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
                    <h2 class="font-weight-bolder text-center my-4">New User</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/users/create" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name *</label>
                            <input class="form-control" name="name" required type="text" placeholder="John Doe"
                                value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email *</label>
                            <input class="form-control" name="email" required type="email" placeholder="john@doe.com"
                                value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Telephone *</label>
                            <input class="form-control" name="phone" required type="tel" placeholder="+961 01 234 567"
                                value="{{old('phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Address *</label>
                            <input class="form-control" name="address" required type="text" placeholder="Address..."
                                value="{{old('address')}}">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password *</label>
                            <input type="password" class="form-control" name="password" placeholder="********" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label">Password Confirmation *</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="********" required>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>
                            <select class="custom-select" name="role">
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="w-100 mt-5">
                            <button type="submit" class="btn btn-info w-100">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection