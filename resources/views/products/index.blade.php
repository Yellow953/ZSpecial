@extends('admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <h4 class="header-title my-auto">Products</h4>
                <a href="/product/new" class="btn btn-primary btn-rounded my-auto">Add</a>
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
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Buy Price</th>
                                    <th>Sell Price</th>
                                    <th>Profit</th>
                                    <th>Description</th>
                                    @if (Auth::user()->role == "admin")
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $products as $product )
                                <tr>
                                    <td class="d-flex">
                                        <img class="img-responsive profile-table" src="{{asset($product->image)}}">
                                        <span class="my-auto ml-3">{{ucfirst($product->name)}}</span>
                                    </td>
                                    <td>
                                        {{number_format($product->quantity, 2)}}
                                    </td>
                                    <td>
                                        @if (Helper::dollar_rate()->usage == true )
                                        {{number_format(Helper::price_to_lbp($product->buy_price))}} LBP
                                        @else
                                        {{number_format($product->buy_price, 2)}} $
                                        @endif
                                    </td>
                                    <td>
                                        @if (Helper::dollar_rate()->usage == true )
                                        {{number_format(Helper::price_to_lbp($product->sell_price))}} LBP
                                        @else
                                        {{number_format($product->sell_price, 2)}} $
                                        @endif
                                    </td>
                                    <td>
                                        {{$product->getProfit()}}%
                                    </td>
                                    <td>
                                        {{$product->barcode}}<br>
                                        {{ucfirst($product->category->name)}}<br>
                                        {{$product->description}}
                                    </td>
                                    @if (Auth::user()->role == "admin")
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/product/{{$product->id}}/import"
                                                class="btn btn-success btn-rounded m-1">Import</a>
                                            <a href="/product/{{$product->id}}/edit"
                                                class="btn btn-warning btn-rounded m-1">Edit</a>
                                            <form method="GET" action="/product/{{$product->id}}/destroy">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger btn-rounded show_confirm m-1"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        No Products yet...
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