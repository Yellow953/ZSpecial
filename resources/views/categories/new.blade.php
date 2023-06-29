@extends('admin.app')

@section('content')
<a href="/categories" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Category</h4>
        <form method="POST" action="/category/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name *</label>
                <input class="form-control input-rounded" name="name" required type="text" placeholder="Category Name"
                    value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <input class="form-control input-rounded" name="description" type="text"
                    placeholder="Category Description" value="{{old('description')}}">
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection