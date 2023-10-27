@extends('admin.app')

@section('content')

<a href="/orders" class="btn text-secondary m-3">
    <h3>
        < Back</h3>
</a>

<div class="container">
    <div class="card border">
        <div class="card-header">
            Order: {{ $order->id }} <br />
            <strong>Date: {{ $order->created_at->format('d/m/Y') }}</strong>
            <span class="float-right"> <strong>Status:</strong> {{ ucwords($order->status) }}</span>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>ZSpecial</strong>
                    </div>
                    <div>Lebanon, Beirut</div>
                    <div>Email: z.special2022@gmail.com</div>
                    <div>Phone: +961 81 495 312</div>
                </div>

                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>{{ ucwords($order->user->name) }}</strong>
                    </div>
                    <div>{{ $order->user->address }}</div>
                    <div>Email: {{ $order->user->email }}</div>
                    <div>Phone: {{ $order->user->phone }}</div>
                </div>
            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Unit Cost</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $index => $product)
                        <tr>
                            <td class="center">{{ $index }}</td>
                            <td class="left strong">{{ ucwords($product->name) }}</td>
                            <td class="right">${{ number_format($product->sell_price, 2) }}</td>
                            <td class="center">{{ $product->pivot->quantity }}</td>
                            <td class="right">${{ number_format($product->sell_price * $product->pivot->quantity, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Subtotal</strong>
                                </td>
                                <td class="right">${{ number_format($sub_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>${{ number_format($order->total_price)
                                        }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection