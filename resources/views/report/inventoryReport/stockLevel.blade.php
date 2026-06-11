@extends('productManager.nav_productManager')

@section('content')
<div class="container py-5">
    <h2>Stock Level Report</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Current Stock</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $value)

            @php
            $availableQty = $value->total_qty - $value->total_issued;
            @endphp
            <tr>
                <td>{{ $value->product->name }}</td>
                <td>{{ $value->product->product_type }}</td>
                <td>{{ $availableQty }}</td>
                <td>{{ $value->product->reorder_level}}</td>
                <td>
                    @if ($availableQty == 0)
                    <span class="badge bg-danger">Out of Stock</span>
                    @elseif ($availableQty <= $value->product->reorder_level)
                        <span class="badge badge-warning">Low Stock</span>
                        @else
                        <span class="badge badge-success">In Stock</span>
                        @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<a href="{{ route('report.inventoryReport.pdf', request()->query()) }}" class="btn btn-danger mb-3">Download PDF</a>
<a href="{{ route('report.inventoryReport.inventoryReport')}}" class="btn btn-secondary mb-3">Go Back</a>

<div>

</div>

@endsection