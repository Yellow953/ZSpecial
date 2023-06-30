@extends('admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <h4 class="header-title my-auto">Orders</h4>
                <a href="/order/new" class="btn btn-primary btn-rounded my-auto">Add</a>
            </div>
        </div>

        <!-- data table start -->
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="data-tables">
                        <table id="dataTable" class="text-center w-100 border">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Order</th>
                                    <th>User</th>
                                    <th>Products</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $orders as $order )
                                <tr>
                                    <td>
                                        {{$order->id }} <br>
                                    </td>
                                    <td>
                                        {{ucfirst($order->user->name)}} <br>
                                    </td>
                                    <td>
                                        <div class="td-products">
                                            @foreach ($order->products as $product)
                                            {{ucfirst($product->name)}} :
                                            {{number_format($product->pivot->quantity)}}<br>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        @if (Helper::dollar_rate()->usage == true )
                                        {{number_format(Helper::price_to_lbp($order->total_price))}} LBP
                                        @else
                                        {{number_format($order->total_price, 2)}} $
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/order/{{$order->id}}/show"
                                                class="btn btn-primary btn-rounded m-1">Show</a>
                                            @if (Auth::user()->role == "admin")
                                            <a href="/order/{{$order->id}}/edit"
                                                class="btn btn-warning btn-rounded m-1">Edit</a>
                                            <form method="GET" action="/order/{{$order->id}}/destroy">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger btn-rounded show_confirm m-1"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        No Orders yet ...
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection