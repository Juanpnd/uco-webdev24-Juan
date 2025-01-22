<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil daftar pesanan berdasarkan pengguna yang sedang login
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
{
    // Pastikan hanya pengguna yang memiliki pesanan dapat melihat detailnya
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Unauthorized access.');
    }

    return view('orders.show', compact('order'));
}
}
?>