@extends('admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="d-flex justify-content-between">
                <h4 class="header-title my-auto">Products</h4>
                <div class="d-flex">
                    <a href="/products/new" class="btn btn-info px-3 py-2 btn-custom text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg mr-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Product
                    </a>
                </div>
            </div>
        </div>

        <!-- data table start -->
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="data-tables datatable-dark">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $products as $product )
                                <tr>
                                    <td class="d-flex">
                                        <img class="img-responsive profile-table" src="{{asset($product->image)}}">
                                        <span class="my-auto ml-3">{{ucwords($product->name)}}</span>
                                    </td>
                                    <td>{{ number_format($product->quantity, 2) }}</td>
                                    <td>
                                        Buy Price: {{ number_format($product->buy_price, 2) }}$ <br>

                                        Sell Price: {{ number_format($product->sell_price, 2) }}$ <br>

                                        Profit: {{ $product->profit() }}% <br>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/products/{{$product->id}}/import"
                                                class="btn btn-success btn-custom p-2 text-dark m-1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg></a>
                                            <a href="/products/{{$product->id}}/secondary_images"
                                                class="btn btn-secondary btn-custom p-2 text-dark m-1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                                </svg></a>
                                            <a href="/products/{{$product->id}}/edit"
                                                class="btn btn-warning btn-custom p-2 m-1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg></a>
                                            <form method="GET" action="/products/{{$product->id}}/destroy">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger btn-custom p-2 show_confirm m-1 text-dark"
                                                    data-toggle="tooltip" title='Delete'><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="mx-3">
                                                Category: {{ucwords($product->category->name)}}
                                            </div>
                                            <div class="mx-3">
                                                Description: {{Str::limit($product->description ?? 'No description
                                                yet...', 50, '...')}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
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