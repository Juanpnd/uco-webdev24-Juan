<x-template title="Daftar Produk">
    <div class="container py-3">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <x-product-display 
                                :name1="$product->name1" 
                                :name="$product->name" 
                                :price="$product->price" 
                                :id="$product->id">
                            </x-product-display>
                            
                            <div class="mb-2">
                                @if ($product->stok == 0)
                                    <span class="badge bg-danger">Stok Habis</span>
                                @elseif ($product->stok < 5)
                                    <span class="badge bg-warning text-dark">Stok Menipis ({{ $product->stok }})</span>
                                @else
                                    <span class="badge bg-success">Stok: {{ $product->stok }}</span>
                                @endif
                            </div>
                            
                            @auth
                                <p class="text-success">Anda sudah login!</p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Add to Cart</button>
                                </form>
                            @else
                                <p class="text-danger">Login untuk menyimpan ke keranjang.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @auth
        <a href="{{ route('products1.index') }}" 
           class="btn btn-lg btn-success position-fixed bottom-0 end-0 m-3" 
           title="Daftar Produk" 
           data-bs-toggle="tooltip">
            <i class="fa-solid fa-list"></i>
        </a>
    @endauth
</x-template>
