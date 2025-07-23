@extends('productManager.nav_productManager')

@section('content')

<div class="container py-5">
    <h2>Inentory Report</h2>

    <!-- 🔽 Dropdown to select chart type and show relevant inputs -->
    <form method="GET" action="{{ route('report.inventoryReport.redirect') }}">
        <div class="mb-4">
            <label for="reportType">Select Report Type:</label>
            <select name="type" id="reportType" class="form-select" onchange="showDateInputs()">
                <option value="">Choose.....</option>
                <option value="stockLevel">Stock Level</option>
                <option value="topSellProduct">Top Sell Product</option>
                <option value="reorder">Restock</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <!-- Table to Export -->


</div>

<style>
    .chart-box {
        display: none;
    }

    .chart-box.active {
        display: block;
    }
</style>

<script>
    document.getElementById('reportType').addEventListener('change', function() {
        const selected = this.value;

        //Hide all chart
        Object.values(chartBoxes).forEach(box => {
            box.classList.remove('active');
            box.classList.add('d-none');
        });

        chartBoxes[selected].classList.add('active');
        chartBoxes[selected].classList.remove('d-none');

    });
</script>

@endsection