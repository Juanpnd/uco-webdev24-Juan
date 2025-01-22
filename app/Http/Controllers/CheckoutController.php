<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,e_wallet',
        ]);

        // Simpan data pesanan
        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'total' => $request->input('total'),
        ]);

        // Hapus keranjang setelah checkout
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.success', ['order' => $order->id]);
    }
}
?>