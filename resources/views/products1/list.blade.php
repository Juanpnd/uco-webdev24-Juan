<x-template title="Daftar Produk">
    <div class="container py-3">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <x-product-display :name1="$product->name1" :name="$product->name" :price="$product->price" :id="$product->id"></x-product-display>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('products1.create') }}" class="btn btn-lg btn-success position-fixed bottom-0 end-0 m-3"
        title="Add new product" data-bs-toggle="tooltip">
        <i class="fa-solid fa-plus"></i>
    </a>
</x-template>
