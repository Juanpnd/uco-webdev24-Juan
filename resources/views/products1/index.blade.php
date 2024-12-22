<x-template title="Daftar Produk">
    <div class="container py-3">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Nama Alternatif</th>
                            <th>Harga</th>
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
                                    <a href="{{ route('products1.create') }}" 
                                       class="btn btn-success btn-sm" 
                                       title="Tambah Produk Baru" 
                                       data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-template>
