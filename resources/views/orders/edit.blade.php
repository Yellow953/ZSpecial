@extends('admin.app')

@section('content')

<script src="{{asset('/admin/js/order.js')}}"></script>

<style>
    .table td,
    th {
        width: 100px
    }
</style>

<div class="content-wrapper m-3">

    <section class="content-header d-flex justify-content-between my-3">

        <a href="/orders" class="btn text-secondary">
            <h3>
                < back</h3>
        </a>

        <h1>Edit Order</h1>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-5">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title" style="margin-bottom: 10px">Categories</h3>

                    </div><!-- end of box header -->

                    <div class="box-body row">

                        @foreach ($categories as $category)

                        <div class="panel-group col-md-12">

                            <div class="panel panel-info">

                                <div class="panel-heading">
                                    <h5 class="panel-title mb-2 mx-3">
                                        <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">
                                            {{ucfirst($category->name)}}
                                        </a>
                                    </h5>
                                </div>

                                <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                    <div class="panel-body">

                                        @if ($category->products->count() > 0)

                                        <table class="table table-hover">
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th class="min-width-1">Price</th>
                                                <th>Add</th>
                                            </tr>

                                            @foreach ($category->products as $product)
                                            <tr>
                                                <td class="word-break">{{ ucfirst($product->name) }}</td>
                                                <td>{{ number_format($product->quantity) }}</td>
                                                <td class="min-width-1">
                                                    {{number_format($product->sell_price, 2)}} $
                                                </td>
                                                <td>
                                                    <a href="" id="product-{{ $product->id }}"
                                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->sell_price }}"
                                                        data-rent-price="{{ $product->rent_price }}"
                                                        class="btn btn-success btn-sm add-product-btn">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table><!-- end of table -->

                                        @else
                                        <h5>No Items...</h5>
                                        @endif

                                    </div><!-- end of panel body -->

                                </div><!-- end of panel collapse -->

                            </div><!-- end of panel primary -->

                        </div><!-- end of panel group -->

                        @endforeach

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </div><!-- end of col -->

            <div class="col-md-7">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title">Order</h3>

                    </div><!-- end of box header -->

                    <div class="box-body">

                        <form action="/orders/{{$order->id}}/update" method="post">

                            {{ csrf_field() }}
                            <div class="row my-4">
                                <div class="col-3">
                                    <label for="user_id" class="mt-1">User</label>
                                </div>
                                <div class="col-9">
                                    <select name="user_id" id="user_id" required class="form-control py-0">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{$order->user_id == $user->id ? 'selected' :
                                            ''}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>

                                <tbody class="order-list">

                                    @foreach ($order->products as $product)
                                    <tr>
                                        <td>{{ ucfirst($product->name) }}</td>
                                        <td><input type="number" name="products[{{ $product->id }}][quantity]"
                                                data-price="{{ number_format($product->sell_price, 2) }}"
                                                class="form-control" min="1" value="{{ $product->pivot->quantity }}">
                                        </td>
                                        <td class="product-price">
                                            {{number_format($product->sell_price * $product->pivot->quantity, 2)}} $
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm remove-product-btn"
                                                data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table><!-- end of table -->

                            <div class="d-flex mb-3">
                                <h4 class="my-auto">Total Price :</h4>
                                <input type="number" class="total-price form-control mx-3"
                                    value="{{number_format($order->total_price, 2)}}" style="width: 100px"
                                    name="total_price">
                                <span class="my-auto">$</span>
                            </div>

                            <button class="btn btn-primary btn-block" id="form-btn">Save</button>

                        </form><!-- end of form -->

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->
@endsection