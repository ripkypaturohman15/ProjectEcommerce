<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function history()
    {
        $orders = Auth::user()->orders()->with('orderItems.product')->latest()->paginate(10);
        return view('orders.history', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.'); // Forbidden
        }

        $order->load('orderItems.product'); // Load relasi detail
        return view('orders.show', compact('order'));
    }
}