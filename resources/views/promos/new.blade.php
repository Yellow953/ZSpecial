@extends('admin.app')

@section('content')
<div class="container">
    <a href="/promos" class="btn text-secondary">
        <h3>
            < back</h3>
    </a>

    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <div class="card border">
                <div class="card-header bg-info">
                    <h2 class="font-weight-bolder text-center my-4">New Promo</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/promos/create" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name *</label>
                            <input class="form-control" name="name" required type="text" placeholder="Promo"
                                value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="value" class="col-form-label">Value *</label>
                            <input class="form-control" name="value" required type="number" placeholder="0 to 100"
                                value="{{old('value')}}">
                        </div>
                        <div class="form-group">
                            <label for="valid_untill" class="col-form-label">Valid Untill</label>
                            <input class="form-control" name="valid_untill" type="date">
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