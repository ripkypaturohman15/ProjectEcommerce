@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Riwayat Pesanan Anda</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-info text-center">
            Anda belum memiliki riwayat pesanan.
            <a href="{{ route('home') }}" class="alert-link">Mulai belanja sekarang!</a>
        </div>
    @else
        <div class="list-group">
            @foreach ($orders as $order)
                <a href="{{ route('orders.show', $order->id) }}" class="list-group-item list-group-item-action mb-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Pesanan #{{ $order->order_number }}</h5>
                        <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <p class="mb-1">
                        Total: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </p>
                    <p class="mb-1">
                        Status:
                        <span class="badge {{
                            $order->status == 'pending' ? 'bg-warning text-dark' :
                            ($order->status == 'processing' ? 'bg-info' :
                            ($order->status == 'shipped' ? 'bg-primary' :
                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                        }}">{{ ucfirst($order->status) }}</span>
                    </p>
                    <small class="text-muted">Klik untuk melihat detail pesanan.</small>
                </a>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif
@endsection