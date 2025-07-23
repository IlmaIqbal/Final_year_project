@extends('supplier.nav_supplier')

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
    $reorder = $reorders->firstWhere('id', $notification->data['reorder_id']);
    @endphp

    <div class="alert alert-info">
        - {{ $notification->created_at->diffForHumans() }}
        <br>
        <strong>Notification:</strong> {{ $notification->data['message']  ?? 'N/A' }}
        <p>From Beautiful Celebration</p>
        <strong>Product:</strong> {{ $notification->data['product_name']  ?? 'N/A' }}<br>
        <strong>Detail of the product:</strong> {{ $notification->data['product_detail']  ?? 'N/A' }}<br>
        <strong>Previous Purchased price:</strong> {{ $notification->data['purchase_price']  ?? 'N/A' }}<br>
        <strong>Reorder date:</strong> {{ $notification->data['reorder_date']  ?? 'N/A' }}<br>
        <strong>Last order received date:</strong> {{ $notification->data['received_date']  ?? 'N/A' }}<br>
        <strong>Request Quantity:</strong> {{ $notification->data['requested_qty']  ?? 'N/A' }}<br>

        @if ($reorder->supplier_approved === '0')
        <a href="{{route('supplier.reorder')}}" class="btn btn-primary mt-2">View Request
        </a>
        @elseif ($reorder->supplier_approved === '1')
        <span class="badge badge-success">Approved</span>
        @else
        <span class="badge badge-danger">Not Approved</span>
        @endif

        <br><br>
    </div>

    @endforeach

</div>
@endsection