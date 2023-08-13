@extends('admin.app')

@section('content')
<a href="/variables" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Variable</h4>
        <form method="POST" action="/variable/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="col-form-label">Title *</label>
                <input class="form-control input-rounded" name="title" required type="text" placeholder="Title"
                    value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="value" class="col-form-label">Value *</label>
                <input class="form-control input-rounded" name="value" required type="text" placeholder="Value"
                    value="{{old('value')}}">
            </div>
            <div class="form-group">
                <label for="type" class="col-form-label">Type*</label>
                <select class="form-control input-rounded" name="type" required>
                    <option value="Bundle Title" selected>Bundle Title</option>
                </select>
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Create</button>
            </div>
        </form>
    </div>
</div>


@endsection