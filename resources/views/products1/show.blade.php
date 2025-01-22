<x-template :title="$product->name">
    <div class="d-lg-flex">
        <div class="col-lg-8 bg-light border-lg-end">
        <img class="w-100" src="{{ asset('' . $product->image) }}" width="400px" height="800px" alt="Product Image">
        </div>
        <div class="col-lg-4">
            <div class="container px-lg-5 py-5">
                <h1 class="mb-4">{{ $product->name }}</h1>
                <div class="fw-semibold text-danger mb-4">
                    Rp {{ number_format($product->price, 2, ',', '.') }}
                </div>
                <p>
                    <div class="fst-italic text-muted">Description:</div>
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>

    <div class="dropdown position-fixed bottom-0 end-0 m-3">
        <button class="btn btn-secondary dropdown-toggle btn-lg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-wrench"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{ route('products.edit', ['id' => $product->id]) }}">Edit product</a>
            <form method="POST" action="{{ route('products.destroy', ['id' => $product->id]) }}">
                @csrf
                <button type="submit" class="dropdown-item">Delete product</button>
            </form>
        </div>
    </div>
</x-template>
