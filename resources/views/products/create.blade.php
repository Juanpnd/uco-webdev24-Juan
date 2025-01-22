<x-template title="Add New Product">
    <div class="container py-3">
        <h1 class="mb-4">Add New Product</h1>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
    <label for="name1" class="form-label">Kategori</label>
    <select class="form-control" name="name1" id="name1" required>
        <option value="">Pilih Kategori</option>
        <option value="tshirts" >T-Shirts</option>
        <option value="shoes" >Shoes</option>
        <option value="shorts" >Shorts</option>
    </select>
</div>
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</x-template>
