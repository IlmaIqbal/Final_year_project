@extends('productManager.nav_productManager')

@section('content')
<div class="container py-5">
    <h2>Top Sell Product Report</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Units Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks->sortByDesc('total_issued')->take(5) as $value)
            <tr>
                <td>{{ $value->product->name }}</td>
                <td>{{ $value->product->product_type }}</td>
                <td>{{ $value->total_issued}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<a href="{{ route('report.topSellReport.pdf', request()->query()) }}" class="btn btn-danger mb-3">Download PDF</a>
<a href="{{ route('report.inventoryReport.inventoryReport')}}" class="btn btn-secondary mb-3">Go Back</a>

<div>

</div>

@endsection