@extends('stockKeeper.nav_stockKeeper')

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
    <h4>Order Notifications</h4>

    @foreach ($notifications as $notification)
    @php
    $orderId = $notification->data['order_id'] ?? null;
    $order = $orders->firstWhere('id', $orderId);
    @endphp

    @php
    $items = json_decode($order->items, true);
    $outOfStock = false;
    foreach ($items as $item) {
    $inventory = \App\Models\Inventory::find($item['id']);
    $available = $inventory ? $inventory->qty - $inventory->issue_qty : 0;
    if ($available < $item['quantity']) { $outOfStock=true; break; } } @endphp @if ($order) <div
        class="alert alert-info">
        - {{ $notification->created_at->diffForHumans() }}
        <br>
        <br>
        <strong>Notification:</strong> {{ $notification->data['message'] }}<br>
        <strong>Order ID:</strong> {{ $order->id }}<br>
        <strong>Customer:</strong> {{ $order->user_name ?? 'N/A' }}<br>
        <strong>Delivery Address:</strong> {{ $order->user_address ?? 'N/A' }}<br>
        <strong>Delivery Mobile:</strong> {{ $order->phone ?? 'N/A' }}<br>
        <strong>Status:</strong> {{ $order->delivery }}<br>
        <strong>Confirmed At:</strong> {{ $order->confirmed_at }}<br>

        <a href="{{ route('admin.order-details', ['orderId' => $order->id]) }}" class="btn btn-primary">View
            Order</a>
        <br><br>
        <form action="{{route('update_issue_status', ['order' => $order->id] )}}" method="post">
            @csrf
            @method('PUT')
            @if ($order->issue_status !== 'Issued')
            <button type="submit" class="btn btn-success" name="action" value="Issued"
                onclick="return confirm('Are you sure you want to issue these items?')">
                Issue Item
            </button>
            @else
            <span class="badge badge-success ">Items Issued</span>

            @endif

            @if ($outOfStock)
            <div class="text-danger mt-1">⚠️ One or more items are out of stock.</div>
            @endif
        </form>
</div>
@else
<div class="alert alert-warning">
    Order not found for notification: {{ $notification->id }}
</div>
@endif
@endforeach

</div>
@endsection