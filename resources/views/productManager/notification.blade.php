@extends('productManager.nav_productManager')

@section('title')
Notification
@endsection
@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <h4>Reorder Notifications</h4>



    @foreach ($notifications as $notification)

    @php
    $reorder = $reorders->firstWhere('id', $notification->data['reorder_id']);
    @endphp
    <div class="alert alert-info">
        - {{ $notification->created_at->diffForHumans() }}
        <br>
        <br>
        <strong>Notification:</strong> {{ $notification->data['message'] }}<br>
        <strong>Product:</strong> {{ $notification->data['product_name'] }}<br>
        <strong>Purchasing Price:</strong> {{ $notification->data['p_price'] }}<br>
        <strong>Selling Price:</strong> {{ $notification->data['sell_price'] }}<br>
        <strong>Received Date:</strong> {{ $notification->data['r_date'] ?? 'N/A' }}<br>
        <strong>Supplier:</strong> {{ $notification->data['supplier_name'] ?? 'N/A' }}<br>
        <strong>Supplier Email:</strong> {{ $notification->data['supplier_email'] ?? 'N/A' }}<br>

        <strong>Requested Quantity:</strong> {{ $notification->data['requested_qty'] }}<br>

        @if ($reorder->status === 'Pending')

        <a href="{{route('productManager.reorder')}}" class="btn btn-primary mt-2"
            onclick="return confirm('Do you send to supplier?')">Send
        </a>
        @elseif ($reorder->status === 'Confirmed')
        <span class="badge badge-success">Confirmed</span>
        @else
        <span class="badge badge-danger">Reject</span>
        @endif

        <br><br>
    </div>

    @endforeach

</div>
@endsection