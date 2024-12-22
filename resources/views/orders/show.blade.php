<x-template title="Order Details">
    <div class="container py-5">
        <h1 class="mb-4">Order Details</h1>

        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total, 2, ',', '.') }}</p>

        <h2 class="mt-5">Ordered Products</h2>
        <ul>
            <!-- Jika Anda memiliki relasi produk di model Order -->
            @foreach($order->items as $item)
                <li>
                    {{ $item->product->name }} ({{ $item->quantity }}) - 
                    Rp {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}
                </li>
            @endforeach
        </ul>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </div>
</x-template>
