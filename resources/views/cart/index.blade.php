<x-template title="Shopping Cart">
    <div class="container py-5">
        <h1 class="mb-4">Your Cart</h1>
        @if($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>Rp {{ number_format($item->product->price, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" min="1" required>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
                            <td>
                            <form method="POST" action="{{ route('cart.destroy') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Total -->
             <div class="mt-4 text-end">
                <h5>Total: Rp {{ number_format($total, 2, ',', '.') }}</h5>
            </div>
            <div class="mt-4">
                <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
            </div>
        @endif
    </div>
</x-template>
