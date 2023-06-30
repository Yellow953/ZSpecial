@extends('admin.app')

@section('content')
<a href="/users" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Edit User</h4>
        <form method="POST" action="/user/update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name *</label>
                <input class="form-control input-rounded" name="name" required value="{{$user->name}}" type="text"
                    placeholder="John Doe">
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Email *</label>
                <input class="form-control input-rounded" name="email" required value="{{$user->email}}" type="email"
                    placeholder="john@doe.com">
            </div>
            <div class="form-group">
                <label for="phone" class="col-form-label">Telephone</label>
                <input class="form-control input-rounded" name="phone" value="{{$user->phone}}" type="tel"
                    placeholder="+961 01 234 567">
            </div>


            {{-- <div class="form-group">
                <label for="role" class="col-form-label">Role</label>
                <select class="form-control input-rounded" name="role" value="{{$user->role}}">
                    <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>User</option>
                    <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                </select>
            </div> --}}
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection