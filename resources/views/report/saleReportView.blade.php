@extends('productManager.nav_productManager')

@section('content')
<div class="container py-5">
    <h2>{{ ucfirst($type) }} Sales Report</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ ucfirst($type) }}</th>
                <th>Total Quantity</th>
                <th>Total Revenue (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $label => $data)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['quantity'] }}</td>
                <td>Rs. {{ number_format($data['revenue'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    <a href="{{ route('report.saleReport.pdf', request()->query()) }}" class="btn btn-danger mb-3">Download PDF</a>
    <a href="{{ route('report.saleReport')}}" class="btn btn-secondary mb-3">Go Back</a>

</div>

@endsection