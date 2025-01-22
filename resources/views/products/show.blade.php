<x-template :title="$product->name">
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-lg-flex">
        <div class="col-lg-8 bg-light border-lg-end">
            <img class="w-100" src="{{ asset($product->image) }}" width="400px" height="800px" alt="Product Image">
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
                
                <!-- Tombol Add to Cart hanya untuk pengguna yang login -->
                @auth
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">Add to Cart</button>
                    </form>

                    <!-- Tombol Add to Wishlist -->
                    @if ($product->isWishlistedBy(auth()->user()))
                        <form action="{{ route('wishlist.toggle', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="fa fa-heart"></i> Wishlisted
                            </button>
                        </form>
                    @else
                        <form action="{{ route('wishlist.toggle', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fa fa-heart"></i> Add to Wishlist
                            </button>
                        </form>
                    @endif

                    <!-- Tombol Share ke Instagram -->
                    <button class="btn btn-info btn-lg w-100 mt-3" id="shareButton">
                        <i class="fa fa-share-alt"></i> Share on Instagram
                    </button>
                @else
                    <!-- Pesan jika pengguna belum login -->
                    <div class="alert alert-warning mt-3" role="alert">
                        Please <a href="{{ route('login') }}" class="alert-link">log in</a> to add products to your cart or wishlist.
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="dropdown position-fixed bottom-0 end-0 m-3">
        <button class="btn btn-secondary dropdown-toggle btn-lg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-wrench"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- Edit Product -->
            <a class="dropdown-item" href="{{ route('products.edit', ['id' => $product->id]) }}">Edit product</a>
    
            <!-- Delete Product Form -->
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')  <!-- This tells Laravel to treat this as a DELETE request -->
                <button type="submit" class="dropdown-item text-danger">Delete</button>
            </form>
        </div>
    </div>
    
</x-template>

<script>
    document.getElementById('shareButton').addEventListener('click', function() {
        // Debugging: Menampilkan log di konsol
        console.log('Share button clicked');

        fetch('{{ route('share', ['id' => $product->id]) }}')
            .then(response => response.json())
            .then(data => {
                // Debugging: Menampilkan URL yang diterima
                console.log('Received URL:', data.url);

                // Redirect ke URL Instagram untuk membagikan produk
                window.open(data.url, '_blank');
            })
            .catch(error => {
                // Debugging: Menampilkan error jika ada
                console.error('Error:', error);
            });
    });
</script>