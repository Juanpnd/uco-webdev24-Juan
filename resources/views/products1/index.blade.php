<x-template title="Daftar Produk">
    <div class="container py-3">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                <a href="{{ route('products1.create') }}" 
                                       class="btn btn-success btn-sm" 
                                       title="Tambah Produk Baru" 
                                       data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->name1 }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
    @if ($product->stok == 0)
        <span class="badge bg-danger">Stok Habis</span>
        <a href="{{ route('products.add-stock', $product->id) }}" class="btn btn-warning btn-sm">Tambah Stok</a>
    @elseif ($product->stok < 5)
        <span class="badge bg-warning text-dark">Stok Menipis ({{ $product->stok }})</span>
        <a href="{{ route('products.add-stock', $product->id) }}" class="btn btn-warning btn-sm">Tambah Stok</a>
    @else
        {{ number_format($product->stok) }}
    @endif
</td>

                                <td>
                                    <!-- Create Button -->
                                    

                                    <!-- Edit Button -->
                                    <a href="{{ route('products1.edit', $product->id) }}" 
                                       class="btn btn-primary btn-sm" 
                                       title="Edit Produk" 
                                       data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('products1.destroy', $product->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                title="Hapus Produk" 
                                                data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-template>
