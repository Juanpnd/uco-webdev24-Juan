<x-template title="Order Success">
    <div class="container py-5 text-center">
        <h1 class="text-success">Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <a href="{{ route('products.list') }}" class="btn btn-primary">Continue Shopping</a>
    </div>
</x-template>
