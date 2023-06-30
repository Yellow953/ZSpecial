@extends('admin.app')

@section('content')
<a href="/" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Change Password</h4>
        <form method="POST" action="/password/update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="password" class="col-form-label">Password *</label>
                <input class="form-control input-rounded" name="password" required type="password">
            </div>
            <div class="form-group">
                <label for="new_password" class="col-form-label">New Password *</label>
                <input class="form-control input-rounded" name="new_password" required type="password">
            </div>
            <div class="form-group">
                <label for="confirm_password" class="col-form-label">Confirm Password *</label>
                <input class="form-control input-rounded" name="confirm_password" required type="password">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection