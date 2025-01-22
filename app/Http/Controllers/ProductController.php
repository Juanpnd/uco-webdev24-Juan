<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product
use App\Models\Wishlist;
use Illuminate\Support\Facades\Storage; // Import Storage

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'title' => 'Add new product'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'name1' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
           'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'stok' => 'required|numeric',
        ]);

       // Handle upload gambar jika ada
$imagePath = null;
if ($request->hasFile('image')) {
    // Tentukan path tujuan
    $destinationPath = public_path('storage/products');
    // Buat folder jika belum ada
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }
    // Pindahkan file ke folder tujuan dan simpan path-nya
    $file = $request->file('image');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move($destinationPath, $fileName);
    $imagePath = 'storage/products/' . $fileName; // Path yang disimpan ke database
}


        // Simpan produk ke database
        $product = Product::create([
            'name1' => $request->name1,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'stok' => $request->stok,
        ]);

        return redirect()->route('products1.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function tshirts()
    {
        $products = Product::where('name1', 'tshirts')->get();
    
        return view('products.index', [
            'title' => 'T-Shirts',
            'products' => $products,
        ]);
    }
    

    public function shoes()
    {
        $products = Product::where('name1', 'shoes')->get();

        return view('products.index', [
            'title' => 'Shoes',
            'products' => $products,
        ]);
    }

    public function shorts()
    {
        $products = Product::where('name1', 'shorts')->get();

        return view('products.index', [
            'title' => 'Shorts',
            'products' => $products,
        ]);
    }

    public function search(Request $request)
{
    // Ambil input pencarian dari request
    $query = $request->input('query');

    // Cari produk berdasarkan name, price, atau description
    $products = Product::where('name', 'LIKE', "%$query%")
        ->orWhere('price', $query)
        ->orWhere('description', 'LIKE', "%$query%")
        ->get();

    // Kirim hasil pencarian ke view
    return view('products.index', [
        'title' => 'Search Results',
        'products' => $products,
    ]);
}


public function filter(Request $request)
{
    $query = Product::query();

    // Periksa apakah `min_price` ada
    if ($request->has('min_price') && $request->min_price !== null) {
        $query->where('price', '>=', $request->min_price);
    }

    // Periksa apakah `max_price` ada
    if ($request->has('max_price') && $request->max_price !== null) {
        $query->where('price', '<=', $request->max_price);
    }

    // Ambil hasil filter
    $products = $query->get();

    // Kirim hasil filter ke view
    return view('products.index', compact('products'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('products.form', [
            'title' => 'Edit product',
            'product' => $product
        ]);
    }

    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'name1' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validasi file gambar
            'stok' => 'required|numeric',
        ]);
    
        // Cari produk berdasarkan ID
        $product = Product::where('id', $id)->firstOrFail();
    
      // Handle upload gambar jika ada
$imagePath = null;
if ($request->hasFile('image')) {
    // Tentukan path tujuan
    $destinationPath = public_path('storage/products');
    
    // Buat folder jika belum ada
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }
    
    // Cek jika produk sudah memiliki gambar sebelumnya dan hapus gambar lama
    if ($product->image) {
        $oldImagePath = public_path($product->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);  // Hapus gambar lama
        }
    }
    
    // Pindahkan file ke folder tujuan dan simpan path-nya
    $file = $request->file('image');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move($destinationPath, $fileName);
    $imagePath = 'storage/products/' . $fileName; // Path yang disimpan ke database
}

    
    
        // Perbarui detail produk
        $product->name1 = $request->name1;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $imagePath;
        $product->stok = $request->stok;
        $product->save();
    
        // Redirect ke halaman detail produk
        return redirect()->route('products1.index', ['id' => $product->id])
            ->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.list')->with('success', 'Product deleted successfully.');
    }


    public function showAddStockForm(Product $product)
    {
        return view('products.add-stock', compact('product'));
    }

    // Handle stock addition logic
    public function addStock(Request $request, Product $product)
    {
        // Validate the input
        $request->validate([
            'stok' => 'required|integer|min:1',
        ]);

        // Add the stock to the existing stock
        $product->stok += $request->input('stok');
        $product->save();

        return redirect()->route('products1.index')->with('success', 'Stock updated successfully.');
    }

    public function toggleWishlist($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        // Eager load wishlists
        $user->load('wishlists');

        // Cek jika produk sudah ada di wishlist
        if ($user->wishlists->contains($product)) {
            $user->wishlists()->detach($product);
            return redirect()->back()->with('success', 'Removed from wishlist.');
        } else {
            $user->wishlists()->attach($product);
            return redirect()->back()->with('success', 'Added to wishlist.');
        }
    }


    /**
     * Tampilkan semua produk dalam wishlist.
     */
    public function wishlist()
    {
        $userId = auth()->id();
        $wishlistProducts = Wishlist::where('user_id', $userId)->with('product')->get();

        return view('products.wishlist', [
            'wishlistProducts' => $wishlistProducts,
        ]);
    }

    public function share($id)
    {
        $product = Product::find($id);

        // Validasi jika produk tidak ditemukan
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Menghasilkan URL untuk produk
        $url = route('products.show', $product->id);  // Ganti dengan 'products.show'

        // Mengembalikan URL untuk Instagram
        return response()->json([
            'url' => "https://www.instagram.com/?url=" . urlencode($url),
        ]);
    }



}
