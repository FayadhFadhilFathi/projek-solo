@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
</div>
<div class="container">
    <h1 class="mb-4">Analytics Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Today Sales</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($todaySales, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Weekly Sales</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($weeklySales, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Monthly Sales</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($monthlySales, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Best Selling Products</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($bestSellingProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge bg-primary rounded-pill">{{ $product->total_orders }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Active Customers</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($activeCustomers as $customer)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $customer->name }}
                                <span class="badge bg-success rounded-pill">{{ $customer->order_count }} orders</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Monthly Sales (Last 6 Months)</h5>
        </div>
        <div class="card-body">
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_column($monthlySalesData, 'month')),
            datasets: [{
                label: 'Total Sales (Rp)',
                data: @json(array_column($monthlySalesData, 'total')),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection