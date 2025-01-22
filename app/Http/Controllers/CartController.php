<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Terapkan middleware auth pada semua metode dalam controller
    public function __construct()
    {
       
    }

    // Menampilkan isi keranjang
    public function index()
{
    // Get cart items for the logged-in user
    $cartItems = Cart::where('user_id', auth()->id())->get();

    // Calculate total price
    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('cart.index', compact('cartItems', 'total'));
}

    // Menambahkan produk ke keranjang
    public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Add or update the item in the cart
    $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->quantity; // Increase quantity if already in cart
        $cartItem->save();
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    // Redirect to the cart page
    return redirect()->route('products.list')->with('success', 'Product added to cart!');
}


    // Mengupdate kuantitas item di keranjang
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $validated['quantity'];
            $cartItem->save();

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }

    // Menghapus item dari keranjang
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            return redirect()->route('cart.index')->with('success', 'Product removed from the cart.');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in the cart.');
    }
}
