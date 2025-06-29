@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                @if ($product->image)
                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="max-height: 400px; object-fit: contain;">
                @else
                    <img src="https://via.placeholder.com/400x400?text=No+Image" class="card-img-top img-fluid" alt="No Image" style="max-height: 400px; object-fit: contain;">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted mb-2">Kategori: <a href="{{ route('home', ['category' => $product->category->slug]) }}" class="text-decoration-none">{{ $product->category->name ?? 'Tidak Ada' }}</a></p>
            <h3 class="text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>

            <p class="lead">{{ $product->description }}</p>

            <div class="mb-3">
                <strong>Stok Tersedia:</strong>
                @if ($product->stock > 0)
                    <span class="badge bg-success fs-6">{{ $product->stock }}</span>
                @else
                    <span class="badge bg-danger fs-6">Stok Habis</span>
                @endif
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div class="mb-3 d-flex align-items-center">
                    <label for="quantity" class="form-label me-2 mb-0">Kuantitas:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" style="width: 80px;" {{ $product->stock == 0 ? 'disabled' : '' }}>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" {{ $product->stock == 0 ? 'disabled' : '' }}>
                    <i class="fas fa-shopping-cart me-2"></i> Tambahkan ke Keranjang
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Produk</a>
            </div>
        </div>
    </div>
@endsection