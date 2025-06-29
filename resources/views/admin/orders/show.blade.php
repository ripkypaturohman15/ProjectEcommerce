@extends('layouts.admin')

@section('admin_content')
    <h1 class="mb-4">Detail Pesanan #{{ $order->order_number }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Detail Pelanggan & Pengiriman</div>
                <div class="card-body">
                    <p><strong>Nama Pelanggan:</strong> {{ $order->user->name ?? 'Pengguna Dihapus' }}</p>
                    <p><strong>Email Pelanggan:</strong> {{ $order->user->email ?? '-' }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $order->phone_number ?? '-' }}</p>
                    <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Produk Dipesan</div>
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
                                                @if($item->product)
                                                    <a href="{{ route('products.show', $item->product->slug) }}" target="_blank">{{ $item->product->name }}</a>
                                                @else
                                                    {{ $item->product_name ?? 'Produk Dihapus' }}
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h5 class="text-end mt-3">Total Pesanan: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Status Pesanan</div>
                <div class="card-body">
                    <p>Status Saat Ini:
                        <span class="badge fs-6 {{
                            $order->status == 'pending' ? 'bg-warning text-dark' :
                            ($order->status == 'processing' ? 'bg-info' :
                            ($order->status == 'shipped' ? 'bg-primary' :
                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                        }}">{{ ucfirst($order->status) }}</span>
                    </p>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    </div>
@endsection