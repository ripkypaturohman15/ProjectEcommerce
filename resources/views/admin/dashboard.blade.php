@extends('layouts.admin')

@section('admin_content')
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-3">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="card-text fs-3">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Pending</h5>
                    <p class="card-text fs-3">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="card-text fs-3">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Pesanan Terbaru</div>
        <div class="card-body">
            @if ($recentOrders->isEmpty())
                <p>Tidak ada pesanan terbaru.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Pengguna</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td><span class="badge {{
                                    $order->status == 'pending' ? 'bg-warning' :
                                    ($order->status == 'processing' ? 'bg-info' :
                                    ($order->status == 'shipped' ? 'bg-primary' :
                                    ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                                }}">{{ ucfirst($order->status) }}</span></td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-link">Lihat Semua Pesanan</a>
                </div>
            @endif
        </div>
    </div>
@endsection