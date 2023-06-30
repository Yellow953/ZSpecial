@extends('admin.app')

@section('content')
<a href="/app" class="btn text-secondary">
    <h3>
        < back</h3>
</a>

<div class="card m-3">
    <div class="card-body">
        <h4 class="header-title">Edit Dollar Rate</h4>
        <p class="text-right my-2">Current Dollar Rate : {{number_format($dollar_rate->lbp, 2)}}</p>
        <form method="POST" action="/dollar_rate/update" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lbp" class="col-form-label">LBP *</label>
                <input class="form-control input-rounded" name="lbp" required type="number"
                    value="{{$dollar_rate->lbp}}" step="0.1">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection