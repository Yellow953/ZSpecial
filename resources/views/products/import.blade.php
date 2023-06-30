@extends('admin.app')

@section('content')
<a href="/products" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Import Product</h4>
        <form method="POST" action="/product/{{$product->id}}/save" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="quantity" class="col-form-label">Quantity *</label>
                <input class="form-control input-rounded" name="quantity" required type="number" step="0.1">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection