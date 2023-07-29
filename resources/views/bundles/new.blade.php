@extends('admin.app')

@section('content')
<a href="/bundles" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Bundle</h4>
        <form method="POST" action="/bundle/create" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name *</label>
                <input class="form-control input-rounded" name="name" required type="text" placeholder="Bundle"
                    value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="price" class="col-form-label">Price *</label>
                <input class="form-control input-rounded" name="price" required type="number" step="0.01"
                    value="{{old('price')}}">
            </div>
            <div class="form-group">
                <label for="image" class="col-form-label">Image</label>
                <input class="form-control input-rounded image" name="image" type="file">
            </div>

            <div class="form-group">
                <img src="{{ asset('assets/images/no_img.png') }}" style="width: 100px"
                    class="img-thumbnail image-preview" alt="">
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <input class="form-control input-rounded" type="text" placeholder="Description" name="description"
                    value="{{old('description')}}">
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection