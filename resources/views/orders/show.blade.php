@extends('layouts.app')

@section('content')
    <h1 class="mb-4"><i class="fa-solid fa-receipt me-2"></i> Detail Pesanan #{{ $order->order_number }}</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fa-solid fa-circle-info me-2"></i>Status & Informasi Umum</div>
                <div class="card-body">
                    <p><strong><i class="fa-solid fa-hashtag me-2"></i>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
                    <p><strong><i class="fa-solid fa-calendar-alt me-2"></i>Tanggal Pesan:</strong> {{ $order->created_at->format('d F Y, H:i') }}</p>
                    <p><strong><i class="fa-solid fa-info-circle me-2"></i>Status:</strong>
                        <span class="badge fs-6 {{
                            $order->status == 'pending' ? 'bg-warning text-dark' :
                            ($order->status == 'processing' ? 'bg-info' :
                            ($order->status == 'shipped' ? 'bg-primary' :
                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                        }}">{{ ucfirst($order->status) }}</span>
                    </p>
                    <p><strong><i class="fa-solid fa-credit-card me-2"></i>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fa-solid fa-truck me-2"></i>Detail Pengiriman</div>
                <div class="card-body">
                    <p><strong><i class="fa-solid fa-user me-2"></i>Nama Penerima:</strong> {{ $order->user->name ?? '-' }}</p>
                    <p><strong><i class="fa-solid fa-location-dot me-2"></i>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                    <p><strong><i class="fa-solid fa-phone me-2"></i>Nomor Telepon:</strong> {{ $order->phone_number }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="fa-solid fa-boxes-stacked me-2"></i>Produk Dipesan</div>
        <div class="card-body">
            @if ($order->orderItems->isEmpty())
                <p>Tidak ada item dalam pesanan ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga Satuan</th>
                                <th>Kuantitas</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                            @else
                                                <img src="https://via.placeholder.com/50x50?text=No+Img" alt="No Image" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                            @endif
                                            <div>
                                                @if($item->product)
                                                    <a href="{{ route('products.show', $item->product->slug) }}" target="_blank" class="text-decoration-none text-dark">{{ $item->product->name }}</a>
                                                @else
                                                    {{ $item->product_name ?? 'Produk Dihapus' }}
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price * $item->quantity }}</td> {{-- Ini sudah dikoreksi sebelumnya untuk format Rupiah, tapi Anda bisa menggantinya jika ingin format berbeda di sini --}}
                                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h4 class="text-end mt-3">Total Pesanan: <span class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></h4>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('orders.history') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Riwayat Pesanan</a>
    </div>
@endsection