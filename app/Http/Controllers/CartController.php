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
        $this->middleware('auth');
    }

    // Menampilkan isi keranjang
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Hitung subtotal dan total pembelian
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Menambahkan produk ke keranjang
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Tambahkan atau perbarui item di keranjang
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitas
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika produk belum ada, tambahkan item baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
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