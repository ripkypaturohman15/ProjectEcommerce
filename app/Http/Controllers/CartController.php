<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "slug" => $product->slug
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');
        $cart = session()->get('cart');

        if (isset($cart[$product->id])) {
            if ($quantity > 0) {
                // Periksa stok saat update
                if ($product->stock < $quantity) {
                    return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk kuantitas yang diminta.');
                }
                $cart[$product->id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Kuantitas keranjang berhasil diperbarui.');
            } else {
                return $this->removeFromCart($product); // Hapus jika kuantitas 0
            }
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}