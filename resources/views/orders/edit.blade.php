@extends('admin.app')

@section('content')

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

            <div class="col-md-7">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title" style="margin-bottom: 10px">Categories</h3>

                    </div><!-- end of box header -->

                    <div class="box-body row">

                        @foreach ($categories as $category)

                        <div class="panel-group col-md-5">

                            <div class="panel panel-info">

                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">
                                            <img src="{{asset($category->image)}}" alt="" class="cat-icon">
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
                                                <td>{{ ucfirst($product->name) }}</td>
                                                <td>{{ number_format($product->quantity) }}</td>
                                                <td class="min-width-1">
                                                    {{number_format($product->sell_price, 2)}} $
                                                </td>

                                                <td>
                                                    <a href="" id="product-{{ $product->id }}"
                                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->sell_price }}"
                                                        class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn' }} btn-sm">
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

            <div class="col-md-5">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title">Order</h3>

                    </div><!-- end of box header -->

                    <div class="box-body">

                        <form action="/order/{{$order->id}}/update" method="post">

                            {{ csrf_field() }}

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
                                                class="form-control input-sm product-quantity" min="1"
                                                value="{{ $product->pivot->quantity }}"></td>
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

                            <h4>Total Price : <span class="total-price">
                                    {{number_format($order->total_price, 2)}} $
                                </span></h4>
                            <h4>Total Price in LBP : <span class="total-price">
                                    {{number_format(Helper::price_to_lbp($order->total_price))}} LBP
                                </span></h4>

                            <button class="btn btn-primary btn-block" id="form-btn">Save</button>

                        </form><!-- end of form -->

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

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