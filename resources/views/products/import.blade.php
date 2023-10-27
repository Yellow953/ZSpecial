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
                    <h2 class="font-weight-bolder text-center my-4">Import</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/products/{{$product->id}}/save" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="quantity" class="col-form-label">Quantity *</label>
                            <input class="form-control" name="quantity" required type="number">
                        </div>

                        <div class="w-100 mt-5">
                            <button type="submit" class="btn btn-info w-100">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection