@extends($layout)

@section('title')
Bouquet
@endsection
@section('content')


<form method="POST" action="{{ route('reorders.store') }}">
    @csrf


    <label for="inventory_id">Select Supplier:</label>
    <select name="inventory_id" class="form-control" onchange="updateSupplierId(this)" required>
        <option value="">-- Choose Supplier --</option>
        @foreach ($inventories as $inv)
        <option value="{{ $inv->id }}" data-supplier="{{ $inv->supplier_id }}">
            {{ $inv->supplier->user->name }} - Rs.{{ $inv->sell_price }}
            (Available: {{ $inv->qty - $inv->issue_qty }})
        </option>
        @endforeach
    </select>
    @php
    $first = $inventories->first();
    @endphp

    @if ($first)
    <label>Product: {{ $first->product->name ?? 'N/A' }}</label><br>
    <label>Received Date: {{ $first->r_date ?? 'N/A' }}</label><br>

    <label>Selling Price: {{ $first->sell_price ?? 'N/A' }}</label><br>
    <label>Purchasing Price: {{ $first->p_price ?? 'N/A' }}</label><br>

    <label>Available Quantity: {{ $first->qty - $first->issue_qty}}</label><br>


    @endif

    <input type="hidden" name="supplier_id" id="supplier_id" required>

    <label for="requested_qty">Request Qty:</label>
    <input type="number" name="requested_qty" required min="1"><br>

    <button class="btn btn-primary" type="submit">Send Reorder</button>
</form>

<script>
    function updateSupplierId(select) {
        const supplierId = select.options[select.selectedIndex].dataset.supplier;
        document.getElementById('supplier_id').value = supplierId;
    }
</script>
@endsection