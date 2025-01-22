@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Wishlist</h1>
    
    @if($wishlistProducts->isEmpty())
        <div class="alert alert-info" role="alert">
            Belum ada produk di wishlist Anda.
        </div>
    @else
        <div class="row">
            @foreach($wishlistProducts as $item)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <!-- Menggunakan gambar default jika tidak ada -->
                        <img src="{{ asset($item->product->image ?? 'default-image.jpg') }}" class="card-img-top" alt="{{ $item->product->name ?? 'No Name' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name ?? 'No Name' }}</h5>
                            <p class="card-text">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            <!-- Form untuk menghapus produk dari wishlist -->
                            <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger">Hapus dari Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
