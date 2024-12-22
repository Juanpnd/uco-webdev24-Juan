<x-template title="Checkout">
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <!-- Alamat Pengiriman -->
            <div class="mb-4">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label class="form-label">Payment Method</label>
                <div>
                    <label class="form-check">
                        <input type="radio" name="payment_method" value="credit_card" class="form-check-input" required>
                        Credit Card
                    </label>
                    <label class="form-check">
                        <input type="radio" name="payment_method" value="bank_transfer" class="form-check-input" required>
                        Bank Transfer
                    </label>
                    <label class="form-check">
                        <input type="radio" name="payment_method" value="e_wallet" class="form-check-input" required>
                        E-Wallet
                    </label>
                </div>
            </div>

            <!-- Total Pembelian -->
            <div class="mb-4">
                <label class="form-label">Total Purchase</label>
                <h5>Rp {{ number_format($total, 2, ',', '.') }}</h5>
                <input type="hidden" name="total" value="{{ $total }}">
            </div>

            <!-- Tombol Checkout -->
            <button type="submit" class="btn btn-success w-100">Place Order</button>
        </form>
    </div>
</x-template>
