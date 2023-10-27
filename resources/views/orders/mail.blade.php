<br><br>
You have a new Order from {{ ucwords($order->user->name) }}
<br><br>

click here to see it
<a href="{{ route('orders.show', $order->id) }}">View</a>

<br><br>