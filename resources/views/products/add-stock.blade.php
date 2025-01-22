<x-template title="Add Stock to Product">
    <div class="container py-3">
        <h1 class="mb-4">Add Stock to Product: {{ $product->name }}</h1>
        <form action="{{ route('products.add-stock.submit', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Display Product Category (Optional) -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" value="{{ $product->category }}" disabled>
            </div>
            
            <!-- Display Product Name (Optional) -->
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" value="{{ $product->name }}" disabled>
            </div>

            <!-- Input to Add Stock -->
            <div class="mb-3">
                <label for="stok" class="form-label">Add Stock</label>
                <input type="number" class="form-control" id="stok" name="stok" required min="1">
            </div>

            <!-- Optional: Show the current stock -->
            <div class="mb-3">
                <label for="current_stok" class="form-label">Current Stock</label>
                <input type="number" class="form-control" id="current_stok" value="{{ $product->stok }}" disabled>
            </div>

            <button type="submit" class="btn btn-success">Add Stock</button>
        </form>
    </div>
</x-template>
