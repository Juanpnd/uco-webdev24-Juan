<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('products.form', [
            'title' => 'Add new product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validate image file
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the image in the 'products' directory and get its path
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            // Default image if no image is uploaded
            $imagePath = 'storage/products/default.jpg';
        }

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('products.show', ['id' => $product->id]);
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
        $products = Product::where('name', 'LIKE', '%T-S%')->get();

        return view('products.index', [
            'title' => 'T-Shirts',
            'products' => $products,
        ]);
    }

    public function shoes()
    {
        $products = Product::where('name', 'LIKE', '%Sh%')->get();

        return view('products.index', [
            'title' => 'Shoes',
            'products' => $products,
        ]);
    }

    public function shorts()
    {
        $products = Product::where('name', 'LIKE', '%Sr%')->get();

        return view('products.index', [
            'title' => 'Shorts',
            'products' => $products,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('price', $query)
            ->get();

        return view('products.index', [
            'title' => 'Search Results',
            'products' => $products,
        ]);
    }

    public function filter(Request $request)
    {
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', PHP_INT_MAX);
        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validate image file
        ]);

        // Find the product
        $product = Product::where('id', $id)->firstOrFail();

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            // Store the new image and update its path
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update the product details
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('products.show', ['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        // Delete the product's image if it exists
        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.list');
    }
}
