@extends('admin.app')

@section('content')
<a href="/products" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Edit Product</h4>
        <form method="POST" action="/product/{{$product->id}}/update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name * </label>
                <input class="form-control input-rounded" name="name" required type="text" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="buy_price" class="col-form-label">Buy Price *</label>
                <input class="form-control input-rounded" name="buy_price" required type="number" step="0.01"
                    value="{{$product->buy_price}}">
            </div>
            <div class="form-group">
                <label for="sell_price" class="col-form-label">Sell Price *</label>
                <input class="form-control input-rounded" name="sell_price" required type="number" step="0.01"
                    value="{{$product->sell_price}}">
            </div>
            <div class="form-group">
                <label for="barcode" class="col-form-label">Barcode *</label>
                <input class="form-control input-rounded" name="barcode" required type="text"
                    value="{{$product->barcode}}">
            </div>
            <div class="form-group">
                <label for="image" class="col-form-label">Image</label>
                <input class="form-control input-rounded image" name="image" type="file">
            </div>

            <div class="form-group">
                <img src="{{ $product->image }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
            </div>

            <div class="form-group">
                <label for="category_id" class="col-form-label">Category *</label>
                <select class="form-control input-rounded" name="category_id" required>
                    <option>Choose a category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{($product->category_id == $category->id)? 'selected' :
                        ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <input class="form-control input-rounded" type="text" placeholder="Description" name="description"
                    value="{{$product->description}}">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // disable enter key
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
    });
</script>

@endsection