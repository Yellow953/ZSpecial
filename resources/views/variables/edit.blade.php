@extends('admin.app')

@section('content')
<div class="container">
    <a href="/variables" class="btn text-secondary">
        <h3>
            < back</h3>
    </a>

    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <div class="card border">
                <div class="card-header bg-info">
                    <h2 class="font-weight-bolder text-center my-4">Edit Variable</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/variable/{{$variable->id}}/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title *</label>
                            <input class="form-control" name="title" required type="text" placeholder="Title"
                                value="{{ $variable->title }}">
                        </div>
                        <div class="form-group">
                            <label for="value" class="col-form-label">Value *</label>
                            <input class="form-control" name="value" required type="text" placeholder="Value"
                                value="{{ $variable->value }}">
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-form-label">Type*</label>
                            <select class="custom-select" name="type" required>
                                <option value="bundle_title" {{ $variable->type == 'bundle_title' ? 'selected' : ''
                                    }}>Bundle Title</option>
                                <option value="shipping_cost" {{ $variable->type == 'bundle_title' ? 'selected' : ''
                                    }}>Shipping Cost</option>
                            </select>
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