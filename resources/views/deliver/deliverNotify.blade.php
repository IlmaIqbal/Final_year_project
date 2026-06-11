@extends('deliver.nav_deliver')

@section('title')
Order
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
        <strong>Status:</strong> {{ $order->payment_method }}<br>
        <strong>Status:</strong> {{ $order->delivery }}<br>
        <strong>Confirmed At:</strong> {{ $order->confirmed_at }}<br>

        @if ($order->delivery === 'Processing')
        <form action="{{route('update_delivery', ['order' => $order->id] )}}" method="post">
            @csrf
            @method('PUT')

            <label for="start_date" class="form-label">Estimate Date</label>
            <input type="datetime-local" class="form-control  @error('estimate_date') is-invalid @enderror"
                id="estimate_date" name="estimate_date" value="{{ old('estimate_date') }}" required>
            <label for="vehicle_no" class="form-label"> Vehicle Number</label>
            <input type="text" class="form-control  @error('vehicle_no') is-invalid @enderror" id="vehicle_no"
                name="vehicle_no" value="{{ old('vehicle_no') }}" required>
            <br>
            <button type="submit" class="btn btn-success" name="action" value="outForDelivery"
                onclick="return confirm('Are you sure you want to accept these items?')">
                Accept Delivery
            </button>
        </form>
        @elseif ($order->delivery === 'outForDelivery')
        <form action="{{route('order_delivered', ['order' => $order->id] )}}" method="post">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success" name="action" value="Delivered"
                onclick="return confirm('Are you delivered?')">
                Delivered
            </button>
            @else
            <span class="badge badge-success">Delivered</span>
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