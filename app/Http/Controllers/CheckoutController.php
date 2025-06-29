<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{


    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang belanja Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'payment_method' => 'required|string|in:COD,Bank Transfer', // Contoh metode pembayaran
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang belanja Anda kosong. Tidak dapat membuat pesanan.');
        }

        DB::beginTransaction(); // Memulai transaksi database
        try {
            $totalAmount = 0;
            // Verifikasi stok dan hitung total sebelum membuat pesanan
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if (!$product || $product->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Stok untuk produk "' . ($product ? $product->name : 'ID ' . $productId) . '" tidak mencukupi.');
                }
                $totalAmount += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Nomor pesanan unik
                'total_amount' => $totalAmount,
                'status' => 'pending', // Status awal
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'phone_number' => $request->phone_number,
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'], // Simpan harga saat dipesan
                ]);

                // Kurangi stok produk
                Product::find($productId)->decrement('stock', $item['quantity']);
            }

            session()->forget('cart'); // Hapus keranjang setelah pesanan dibuat

            DB::commit(); // Konfirmasi transaksi
            return redirect()->route('orders.history')->with('success', 'Pesanan Anda berhasil dibuat! Nomor pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika ada error
            // Untuk debugging, Anda bisa log $e->getMessage()
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }
}