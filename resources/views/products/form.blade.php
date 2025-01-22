<x-template title="Add new product">
    <div class="container py-3">
        <h1>{{ $title }}</h1>
        <form class="was-validated" method="post" enctype="multipart/form-data"
            action="{{ isset($product->id) ? route('products.update', ['id' => $product->id]) : route('products.store') }}">
            @csrf
            <div class="mb-3">
    <label for="name1" class="form-label">Kategori</label>
    <select class="form-control" name="name1" id="name1" required>
        <option value="">Pilih Kategori</option>
        <option value="tshirts" {{ (isset($product) && $product->name1 == 'tshirts') ? 'selected' : '' }}>T-Shirts</option>
        <option value="shoes" {{ (isset($product) && $product->name1 == 'shoes') ? 'selected' : '' }}>Shoes</option>
        <option value="shorts" {{ (isset($product) && $product->name1 == 'shorts') ? 'selected' : '' }}>Shorts</option>
    </select>
</div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ $product->name ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description">{{ $product->description ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price"
                    value="{{ $product->price ?? 0 }}" min="1" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" id="stok"
                    value="{{ $product->stok ?? 0 }}" min="1" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if(isset($product->image))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="image" id="image"
                    value="{{ old('image') }}" @unless(isset($product->image)) required @endunless>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</x-template>
