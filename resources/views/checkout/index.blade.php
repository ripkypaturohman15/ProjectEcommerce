@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Checkout</h1>

    @if (empty($cart))
        <div class="alert alert-warning text-center">
            Keranjang belanja Anda kosong. Tidak dapat melanjutkan checkout.
            <a href="{{ route('home') }}" class="alert-link">Mulai belanja</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header">Detail Pengiriman</div>
                    <div class="card-body">
                        <form action="{{ route('checkout.placeOrder') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Alamat Pengiriman Lengkap</label>
                                <textarea class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address', Auth::user()->address ?? '') }}</textarea>
                                @error('shipping_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}" required>
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="COD" {{ old('payment_method') == 'COD' ? 'selected' : '' }}>Cash On Delivery (COD)</option>
                                    <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    {{-- Tambahkan metode pembayaran lain di sini --}}
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success w-100">Buat Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Ringkasan Pesanan</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach ($cart as $id => $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['name'] }} ({{ $item['quantity'] }}x)</span>
                                    <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                <span>Total Keseluruhan:</span>
                                <span class="text-primary fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <small class="text-muted">Pastikan detail pengiriman Anda benar sebelum melanjutkan.</small>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection