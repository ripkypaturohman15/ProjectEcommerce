@extends('layouts.admin')

@section('admin_content')
    <h1 class="mb-4">Daftar Pesanan</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan yang masuk.</div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name ?? 'Pengguna Dihapus' }}</td> {{-- Handle jika user dihapus --}}
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>
                                        <span class="badge {{
                                            $order->status == 'pending' ? 'bg-warning text-dark' :
                                            ($order->status == 'processing' ? 'bg-info' :
                                            ($order->status == 'shipped' ? 'bg-primary' :
                                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                                        }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection