<a href="{{ route('products.show', ['id' => $id]) }}" class="product-card">
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">{{ $name }}</h5>
            <h5 class="card-title">{{ $name1 }}</h5>
            <p class="card-text">Rp {{ number_format($price, 0, ',', '.') }}</p>
            <!-- Wishlist button -->
            <button class="btn btn-outline-danger wishlist-btn" 
                    onclick="toggleWishlist({{ $id }}, this)">
                <i class="fa fa-heart"></i> Wishlist
            </button>
        </div>
    </div>
</a>
