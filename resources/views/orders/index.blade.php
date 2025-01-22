<x-template title="My Orders">
    <div class="container py-5">
        <h1 class="mb-4">My Orders</h1>

        @if($orders->isEmpty())
            <p class="text-muted">You haven't made any purchases yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Shipping Address</th>
                            <th>Payment Method</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                <td>Rp {{ number_format($order->total, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-template>
