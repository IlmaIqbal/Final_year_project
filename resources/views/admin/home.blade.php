@extends('admin.navbar')

@section('content')
<div class="content">
    <!-- Cards Row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Users</h5>
                    <p class="card-text">Total Users: 4</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Performance</h5>
                    <p class="card-text">Overall Performance: 78%</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Notification</h5>
                    <p class="card-text">Notifications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Overview</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Revenue Breakdown</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Row -->

</div>
@endsection