@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Keranjang Belanja Anda</h1>

    @if (empty($cart))
        <div class="alert alert-info text-center">
            Keranjang belanja Anda kosong. <a href="{{ route('home') }}">Mulai belanja sekarang!</a>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item['image'])
                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                                            @else
                                                <img src="https://via.placeholder.com/60x60?text=No+Img" alt="No Image" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                                            @endif
                                            <div>
                                                <a href="{{ route('products.show', $item['slug'] ?? '#') }}" class="text-decoration-none text-dark fw-bold">
                                                    {{ $item['name'] }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width: 70px;" onchange="this.form.submit()">
                                            {{-- <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button> --}}
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
            <h4 class="mb-0">Total Belanja:</h4>
            <h4 class="mb-0 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</h4>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('home') }}" class="btn btn-secondary me-md-2">Lanjutkan Belanja</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
@endsection