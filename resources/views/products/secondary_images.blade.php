@extends('admin.app')

@section('content')
<a href="/products" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Secondary Images <small class="mx-3 text-danger">(click to remove)</small></h4>
        <div class="d-flex justify-content-center">
            @forelse ($secondary_images as $secondary_image)
            <form method="GET" action="/secondary_image/{{$secondary_image->id}}/destroy">
                @csrf
                <a class="image-wrapper show_confirm">
                    <img src="{{asset($secondary_image->image)}}" alt="" class="img-fluid m-1"
                        style="width:150px; height:150px">
                    <span class="delete-overlay text-danger">Delete</span>
                </a>
            </form>
            @empty
            No secondary Images yet...
            @endforelse
        </div>
    </div>
</div>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">New Secondary Image</h4>
        <form method="POST" action="/secondary_image/create" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">

            <div class="form-group">
                <label for="images[]" class="col-form-label">Images*</label>
                <input class="form-control input-rounded image" name="images[]" type="file" multiple required>
            </div>

            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Upload</button>
            </div>
        </form>
    </div>
</div>

@endsection