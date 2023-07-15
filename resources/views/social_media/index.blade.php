@extends('admin.app')

@section('content')
<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Post</h4>
        <form method="POST" action="/sm_post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="col-form-label">Title</label>
                <input class="form-control input-rounded" name="title" required type="text" placeholder="Title"
                    value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="image" class="col-form-label">Image</label>
                <input class="form-control input-rounded" name="image" required type="file">
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">POST</button>
            </div>
        </form>
    </div>
</div>
@endsection