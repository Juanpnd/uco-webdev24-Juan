<x-template>
    <div class="container mt-4">
        <!-- Hero Section -->
        <div class="hero bg-light p-5 rounded text-center">
            <h1 class="display-4">Selamat Datang !</h1>
            <p class="lead">Temukan koleksi terbaik dari produk kami dengan penawaran terbaik.</p>
            <a href="{{ route('products.list') }}" class="btn btn-primary btn-lg">Jelajahi Produk</a>
        </div>

        <!-- Featured Categories -->
        <section class="mt-5">
            <h2 class="text-center">Kategori Terpopuler</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('image/Adidas Samba.jpg') }}" class="card-img-top" alt="Shoes">
                        <div class="card-body text-center">
                            <h5 class="card-title">Sepatu</h5>
                            <a href="{{ route('products.shoes') }}" class="btn btn-outline-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('image/T-s pich.jpg') }}" class="card-img-top" alt="T-Shirts">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kaos</h5>
                            <a href="{{ route('products.tshirts') }}" class="btn btn-outline-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('image/Short runing adidas black.jpg') }}" class="card-img-top" alt="Shorts">
                        <div class="card-body text-center">
                            <h5 class="card-title">Celana Pendek</h5>
                            <a href="{{ route('products.shorts') }}" class="btn btn-outline-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Special Offers -->
        <section class="mt-5 bg-primary text-white p-4 rounded">
            <h2 class="text-center">Penawaran Spesial</h2>
            <p class="text-center">Nikmati diskon hingga <strong>50%</strong> untuk produk pilihan! Jangan sampai terlewat.</p>
            <div class="text-center">
                <a href="{{ route('products.list') }}" class="btn btn-light">Lihat Penawaran</a>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="mt-5">
            <h2 class="text-center">Apa Kata Pelanggan?</h2>
            <div id="testimonialsCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="text-center">
                            <p>"Produk sangat bagus dan pengiriman cepat! Sangat puas dengan layanan ini."</p>
                            <p><strong>- Dika</strong></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-center">
                            <p>"Belanja di sini sangat mudah. Pilihannya banyak dan kualitasnya memuaskan."</p>
                            <p><strong>- Sari</strong></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-center">
                            <p>"Harga yang terjangkau dan layanan pelanggan yang sangat ramah."</p>
                            <p><strong>- Rian</strong></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- Newsletter Signup -->
        <section class="mt-5 bg-light p-4 rounded">
            <h2 class="text-center">Berlangganan Newsletter Kami</h2>
            <p class="text-center">Dapatkan informasi terbaru dan penawaran eksklusif langsung di email Anda.</p>
            <form class="row g-3 justify-content-center">
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Masukkan email Anda">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Langganan</button>
                </div>
            </form>
        </section>
    </div>
</x-template>
