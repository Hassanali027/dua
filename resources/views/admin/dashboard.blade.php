@extends('admin.layouts.app')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        background: rgba(220, 198, 182, 0.2);
        color: #1a1a1a;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-icon svg {
        width: 24px;
    }
    .stat-info h4 {
        font-size: 13px;
        color: #888;
        font-weight: 500;
        margin-bottom: 5px;
    }
    .stat-info .value {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
    }
    
    .dashboard-charts {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    .chart-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .chart-card h3 {
        font-size: 16px;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .recent-orders {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .recent-orders h3 {
        font-size: 16px;
        color: #1a1a1a;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    th {
        font-size: 13px;
        color: #888;
        font-weight: 500;
    }
    td {
        font-size: 14px;
        color: #333;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-shipped { background: #cce5ff; color: #004085; }
    .status-delivered { background: #d4edda; color: #155724; }
</style>
@endsection

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="stat-info">
                <h4>Total Revenue</h4>
                <div class="value">Rs. {{ number_format($totalRevenue) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="stat-info">
                <h4>Active Orders</h4>
                <div class="value">{{ number_format($activeOrders) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="stat-info">
                <h4>Total Customers</h4>
                <div class="value">{{ number_format($totalCustomers) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            </div>
            <div class="stat-info">
                <h4>Products</h4>
                <div class="value">{{ number_format($totalProducts) }}</div>
            </div>
        </div>
    </div>

    <div class="dashboard-charts">
        <div class="chart-card">
            <h3>Sales Overview</h3>
            <canvas id="salesChart" height="100"></canvas>
        </div>
        <div class="chart-card">
            <h3>Top Categories</h3>
            <canvas id="categoryChart" height="200"></canvas>
        </div>
    </div>

    <div class="recent-orders">
        <h3>Recent Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>Rs. {{ number_format($order->total_amount) }}</td>
                    <td>
                        @php
                            $badgeClass = 'status-pending';
                            if ($order->status == 'Shipped') $badgeClass = 'status-shipped';
                            elseif ($order->status == 'Delivered' || $order->status == 'Completed') $badgeClass = 'status-delivered';
                        @endphp
                        <span class="status-badge {{ $badgeClass }}">{{ $order->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">No recent orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesChartLabels) !!},
                datasets: [{
                    label: 'Sales (Rs.)',
                    data: {!! json_encode($salesChartData) !!},
                    borderColor: '#1a1a1a',
                    backgroundColor: 'rgba(26, 26, 26, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [2, 4] } },
                    x: { grid: { display: false } }
                }
            }
        });

        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    data: {!! json_encode($categoryData) !!},
                    backgroundColor: ['#1a1a1a', '#dcc6b6', '#888888', '#e0e0e0', '#555555', '#bbbbbb'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } }
                }
            }
        });
    });
</script>
@endsection
