<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Product List</h1>
        <!-- Tombol untuk menambah produk baru -->
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        <!-- Daftar produk -->
        @if(count($products) > 0)
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <strong>{{ $product['name'] }}</strong><br>
                        {{ $product['description'] }}<br>
                        <strong>Price: ${{ $product['price'] }}</strong>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No products available.</p>
        @endif
    </div>
</body>
</html>
