@extends('cashier.nav_cashier')

@section('title')
Events
@endsection
@section('content')
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container">
    <h4>Payment Notifications</h4>

    @foreach ($notifications as $notification)
    @php
    $orderId = $notification->data['order_id'] ?? null;
    $order = $orders->firstWhere('id', $orderId);
    @endphp

    @if ($order) <div class="alert alert-info">
        - {{ $notification->created_at->diffForHumans() }}
        <br>
        <br>
        <strong>Notification:</strong> {{ $notification->data['message'] }}<br>
        <strong>Order ID:</strong> {{ $order->id }}<br>
        <strong>Customer:</strong> {{ $order->user_name ?? 'N/A' }}<br>
        <strong>Delivery Address:</strong> {{ $order->user_address ?? 'N/A' }}<br>
        <strong>Delivery Mobile:</strong> {{ $order->phone ?? 'N/A' }}<br>
        <strong>Status:</strong> {{ $order->issue_status }}<br>
        <strong>Confirmed At:</strong> {{ $order->confirmed_at }}<br>
        <strong>Payment Method:</strong> {{ $order->payment_method }}<br>
        <br>
        <a href="{{ route('admin.order-details', ['orderId' => $order->id]) }}" class="btn btn-primary">View
            Order</a>
        <br><br>
        @if($order->payment !== 'Paid')
        <form action="{{ route('cashier.pending') }}" method="POST">
            @csrf
            <button class="btn btn-success">Confirm Payment</button>
        </form>
        @else
        <span class="badge badge-success">Payment Received</span>
        @endif
    </div>
    @else
    <div class="alert alert-warning">
        Order not found for notification: {{ $notification->id }}
    </div>
    @endif
    @endforeach

</div>
@endsection