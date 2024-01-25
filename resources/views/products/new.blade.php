@extends('admin.app')

@section('content')
<div class="container">
    <a href="/products" class="btn text-secondary">
        <h3>
            < back</h3>
    </a>

    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <div class="card border">
                <div class="card-header bg-info">
                    <h2 class="font-weight-bolder text-center my-4">New Product</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/products/create" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name *</label>
                            <input class="form-control" name="name" required type="text" placeholder="Product"
                                value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-form-label">Quantity *</label>
                            <input class="form-control" name="quantity" required type="number" step="0.01"
                                value="{{old('quantity')}}">
                        </div>
                        <div class="form-group">
                            <label for="buy_price" class="col-form-label">Buy Price *</label>
                            <input class="form-control" name="buy_price" required type="number" step="0.01"
                                value="{{old('buy_price')}}">
                        </div>
                        <div class="form-group">
                            <label for="sell_price" class="col-form-label">Sell Price *</label>
                            <input class="form-control" name="sell_price" required type="number" step="0.01"
                                value="{{old('sell_price')}}">
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-form-label">Category *</label>
                            <select class="custom-select" name="category_id" required>
                                <option value="">Choose a category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id')==$category->id ? 'selected' :
                                    ''}} {{$category->name == "Others" ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-form-label">Image</label>
                            <input class="form-control image" name="image" type="file">
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea name="description" class="form-control" rows="7">{{old('description')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="facebook_link" class="col-form-label">Facebook Link</label>
                            <input class="form-control" type="text" placeholder="Facebook Link" name="facebook_link"
                                value="{{old('facebook_link')}}">
                        </div>
                        <div class="form-group">
                            <label for="instagram_link" class="col-form-label">Instagram Link</label>
                            <input class="form-control" type="text" placeholder="Instagram Link" name="instagram_link"
                                value="{{old('instagram_link')}}">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="mx-4 d-flex">
                                    <input class="form-check-input border" type="checkbox" name="is_bundle"
                                        id="is_bundle" {{ old('is_bundle') ? 'checked' : '' }}>

                                    <label class="form-check-label mx-3" for="is_bundle">
                                        {{ __('Bundle') }}
                                    </label>
                                </div>
                            </div>
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