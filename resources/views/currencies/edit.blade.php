@extends('admin.app')

@section('content')
<div class="container">
    <a href="/app" class="btn text-secondary">
        <h3>
            < back</h3>
    </a>

    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <div class="card border">
                <div class="card-header bg-info">
                    <h2 class="font-weight-bolder text-center my-4">Edit {{ucwords($currency->name)}}</h2>
                </div>
                <div class="card-body">
                    <p class="text-center my-2">Current Rate : {{number_format($currency->rate, 2)}}</p>
                    <form method="POST" action="/currency/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="rate" class="col-form-label">Rate *</label>
                            <input class="form-control input-rounded" name="rate" required type="number"
                                value="{{$currency->rate}}" step="0.1">
                        </div>

                        <div class="w-100 mt-5">
                            <button type="submit" class="btn btn-info w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection