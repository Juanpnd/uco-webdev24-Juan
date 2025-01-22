<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product diimpor

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data field 'name1' dari tabel products
        $products = Product::all();

        // Kirim data ke view
        return view('home.index', compact('products'));
    }

    public function show($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirimkan data produk ke view
        return view('products.show1', compact('product'));
    }
}

