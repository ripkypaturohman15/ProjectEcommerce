@extends('layouts.app')

@section('content')
<h1 class="mb-4"><i class="fa-solid fa-store me-2"></i> Produk Hijab</h1> {{-- Icon untuk judul halaman --}}

<div class="row mb-4">
    <div class="col-md-8">
        <form action="{{ route('home') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request('search') }}">
            <select name="category" class="form-select me-2">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-2"></i> Cari</button> {{-- Icon untuk tombol pencarian --}}
        </form>
    </div>
</div>

@if ($products->isEmpty())
    <div class="alert alert-warning">Tidak ada produk yang ditemukan.</div>
@else
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Image" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ $product->category->name }}</p>
                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text">Stok: {{ $product->stock }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye me-1"></i> Lihat Detail</a> {{-- Icon untuk lihat detail --}}
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    @if ($product->stock == 0)
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Stok Habis
                                    @else
                                        <i class="fa-solid fa-cart-plus me-1"></i> Tambah Keranjang
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endif
@endsection