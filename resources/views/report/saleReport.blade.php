@extends('productManager.nav_productManager')

@section('content')

<div class="container py-5">
    <h2>Sales Report</h2>

    <!-- 🔽 Dropdown to select chart type and show relevant inputs -->
    <form method="GET" action="{{ route('report.saleReport.view') }}">
        <div class="mb-4">
            <label for="reportType">Select Report Type:</label>
            <select name="type" id="reportType" class="form-select" onchange="showDateInputs()">
                <option value="#">Choose.....</option>
                <option value="daily" {{ request('type') === 'daily' ? 'selected' : '' }}>Daily Sales</option>
                <option value="monthly" {{ request('type') === 'monthly' ? 'selected' : '' }}>Monthly Sales</option>
                <option value="yearly" {{ request('type') === 'yearly' ? 'selected' : '' }}>Yearly Sales</option>
                <option value="category" {{ request('type') === 'category' ? 'selected' : '' }}>Category Sales
                </option>
                <option value="region" {{ request('type') === 'region' ? 'selected' : '' }}>Region Sales</option>
            </select>
        </div>

        <!-- Input fields that appear based on dropdown -->
        <div id="dailyInput" class="date-input d-none">
            <label for="date">Select Date:</label>
            <input type="date" name="date" class="form-control mb-3" value="{{ request('date') }}">
        </div>

        <div id="monthlyInput" class="date-input d-none">
            <label for="month">Select Month:</label>
            <input type="month" name="month" class="form-control mb-3" value="{{ request('month') }}">
        </div>

        <div id="yearlyInput" class="date-input d-none">
            <label for="year">Select Year:</label>
            <input type="number" name="year" class="form-control mb-3" value="{{ request('year') }}" min="2000"
                max="{{ now()->year }}">
        </div>


        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <!-- Table to Export -->


    <div id="dailyChartBox" class="chart-box"> <canvas id="dailyChart" height="100"></canvas></div>
    <div id="monthlyChartBox" class="chart-box"> <canvas id="monthlyChart" height="100"></canvas></div>
    <div id="yearlyChartBox" class="chart-box"> <canvas id="yearlyChart" height="100"></canvas></div>
    <div id="categoryChartBox" class="chart-box"> <canvas id="categoryChart" height="100"></canvas></div>
    <div id="regionChartBox" class="chart-box"> <canvas id="regionChart" height="100"></canvas></div>

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
    const chartBoxes = {
        daily: document.getElementById('dailyChartBox'),
        monthly: document.getElementById('monthlyChartBox'),
        yearly: document.getElementById('yearlyChartBox'),
        category: document.getElementById('categoryChartBox'),
        region: document.getElementById('regionChartBox'),
    };

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
    // Daily Sales Chart
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dailySales->pluck('date')); ?>,
            datasets: [{
                label: 'Daily Sales',
                data: <?php echo json_encode($dailySales->pluck('total')); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false
            }]
        }
    });

    // Monthly Sales Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($monthlySales->pluck('month')); ?>,
            datasets: [{
                label: 'Sales by Month',
                data: <?php echo json_encode($monthlySales->pluck('total')); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        }
    });

    // Yearly Sales Chart
    const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
    new Chart(yearlyCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($yearlySales->pluck('year')); ?>,
            datasets: [{
                label: 'Yearly Sales',
                data: <?php echo json_encode($yearlySales->pluck('total')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        }
    });

    // Category Sales Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($categorySales->pluck('product_type')); ?>,
            datasets: [{
                label: 'Sales by Category',
                data: <?php echo json_encode($categorySales->pluck('total')); ?>,
                backgroundColor: ['#f39c12', '#00c0ef', '#dd4b39']
            }]
        }
    });

    // Region Sales Chart
    const regionCtx = document.getElementById('regionChart').getContext('2d');
    new Chart(regionCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($regionSales->keys()); ?>,
            datasets: [{
                label: 'Sales by Region',
                data: <?php echo json_encode($regionSales->values()); ?>,
                backgroundColor: ['#8e44ad', '#27ae60', '#c0392b', '#f39c12', '#00c0ef', '#dd4b39']
            }]
        }
    });

    function showDateInputs() {
        let type = document.getElementById('reportType').value;
        document.querySelectorAll('.date-input').forEach(div => div.classList.add('d-none'));
        if (type === 'daily') document.getElementById('dailyInput').classList.remove('d-none');
        if (type === 'monthly') document.getElementById('monthlyInput').classList.remove('d-none');
        if (type === 'yearly') document.getElementById('yearlyInput').classList.remove('d-none');

    }

    // Run on page load
    document.addEventListener('DOMContentLoaded', showDateInputs);
</script>

@endsection