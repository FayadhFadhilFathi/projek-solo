@extends('layouts.app')

@section('content')
<style>
    .orders-page {
        min-height: 100vh;
        padding: 20px 0;
    }

    .orders-header {
        text-align: center;
        margin-bottom: 40px;
        color: white;
    }

    .orders-header h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease-out;
    }

    .orders-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .orders-container {
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .history-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        transform: translateY(20px);
        animation: slideUp 0.6s ease-out forwards;
    }

    .stat-card:nth-child(2) {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(3) {
        background: linear-gradient(135deg, #fd79a8, #e84393);
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(4) {
        background: linear-gradient(135deg, #fdcb6e, #e17055);
        animation-delay: 0.3s;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* Tab Navigation */
    .tab-navigation {
        display: flex;
        gap: 0;
        margin-bottom: 30px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .tab-btn {
        flex: 1;
        padding: 15px 20px;
        background: white;
        color: #666;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .tab-btn:hover:not(.active) {
        background: #f8f9ff;
    }

    .history-filters {
        background: linear-gradient(135deg, #f8f9ff, #e8edff);
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #666;
    }

    .filter-select, .filter-input {
        padding: 8px 12px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus, .filter-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .orders-grid {
        display: grid;
        gap: 20px;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        animation: fadeInRight 0.6s ease-out forwards;
        opacity: 0;
        transform: translateX(30px);
        position: relative;
    }

    .order-card.paid {
        border-left: 5px solid #00b894;
    }

    .order-card.delivered {
        border-left: 5px solid #74b9ff;
    }

    .order-card.shipped {
        border-left: 5px solid #fdcb6e;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .order-card:nth-child(1) { animation-delay: 0.1s; }
    .order-card:nth-child(2) { animation-delay: 0.2s; }
    .order-card:nth-child(3) { animation-delay: 0.3s; }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .product-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-paid {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
    }

    .status-processing {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        color: white;
    }

    .status-shipped {
        background: linear-gradient(135deg, #fdcb6e, #e17055);
        color: white;
    }

    .status-delivered {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        color: white;
    }

    .order-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .detail-item {
        text-align: center;
        padding: 15px;
        background: #f8f9ff;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .detail-item:hover {
        background: #e8edff;
        transform: scale(1.05);
    }

    .detail-label {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .price-value {
        color: #00b894;
        font-size: 1.3rem;
    }

    .payment-info {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 0.9rem;
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-message {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .empty-submessage {
        opacity: 0.7;
        margin-bottom: 20px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 768px) {
        .orders-header h1 {
            font-size: 2rem;
        }

        .orders-container {
            padding: 20px;
            margin: 0 10px;
        }

        .order-details {
            grid-template-columns: 1fr 1fr;
        }

        .history-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .history-filters {
            flex-direction: column;
            align-items: stretch;
        }

        .tab-navigation {
            flex-direction: column;
        }
    }
</style>

<div class="orders-page">
    <div class="orders-header">
        <h1>📜 Order History</h1>
        <p>View your completed and processed orders</p>
    </div>

    <div class="orders-container">
        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="{{ route('user.order.index') }}" class="tab-btn {{ request()->routeIs('user.order.index') ? 'active' : '' }}">
                📋 Pending Orders
            </a>
            <a href="{{ route('user.order.history') }}" class="tab-btn {{ request()->routeIs('user.order.history') ? 'active' : '' }}">
                📜 Order History
            </a>
        </div>

        @if($orders->whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->count() > 0)
            <!-- History Stats -->
            <div class="history-stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->count() }}</div>
                    <div class="stat-label">Completed Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${{ number_format($orders->whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sum('total_price'), 0) }}</div>
                    <div class="stat-label">Total Paid</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->where('status', 'delivered')->count() }}</div>
                    <div class="stat-label">Delivered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->whereIn('status', ['processing', 'shipped'])->count() }}</div>
                    <div class="stat-label">In Transit</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="history-filters">
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter" onchange="filterOrders()">
                        <option value="">All Status</option>
                        <option value="paid">Paid</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Date Range</label>
                    <select class="filter-select" id="dateFilter" onchange="filterOrders()">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Search Product</label>
                    <input type="text" class="filter-input" id="searchFilter" placeholder="Search by product name..." onkeyup="filterOrders()">
                </div>
            </div>

            <!-- Orders List -->
            <div class="orders-grid" id="ordersGrid">
                @foreach($orders->whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sortByDesc('updated_at') as $order)
                    <div class="order-card {{ $order->status }}" 
                         data-status="{{ $order->status }}" 
                         data-date="{{ $order->updated_at->format('Y-m-d') }}"
                         data-product="{{ strtolower($order->product->name) }}">
                        <div class="order-header">
                            <div class="product-name">
                                🎮 {{ $order->product->name }}
                            </div>
                            <div class="status-badge status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="detail-item">
                                <div class="detail-label">Quantity</div>
                                <div class="detail-value">{{ $order->quantity }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Total Price</div>
                                <div class="detail-value price-value">${{ number_format($order->total_price, 2) }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Order Date</div>
                                <div class="detail-value">{{ $order->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Order ID</div>
                                <div class="detail-value">#{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                        
                        @if($order->status === 'paid')
                            <div class="payment-info">
                                💳 Payment completed on {{ $order->updated_at->format('M d, Y \a\t H:i') }}
                            </div>
                        @elseif($order->status === 'processing')
                            <div class="payment-info">
                                📦 Your order is being processed
                            </div>
                        @elseif($order->status === 'shipped')
                            <div class="payment-info">
                                🚚 Your order has been shipped
                            </div>
                        @elseif($order->status === 'delivered')
                            <div class="payment-info">
                                ✅ Order delivered on {{ $order->updated_at->format('M d, Y') }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">📜</div>
                <div class="empty-message">No order history yet!</div>
                <div class="empty-submessage">Complete some purchases to see your order history here</div>
                <a href="{{ route('user.order.index') }}" class="back-btn">
                    📋 View Pending Orders
                </a>
            </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ route('dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</div>

<script>
function filterOrders() {
    const statusFilter = document.getElementById('statusFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    const orders = document.querySelectorAll('.order-card');
    
    orders.forEach(order => {
        let showOrder = true;
        
        // Status filter
        if (statusFilter && order.dataset.status !== statusFilter) {
            showOrder = false;
        }
        
        // Search filter
        if (searchFilter && !order.dataset.product.includes(searchFilter)) {
            showOrder = false;
        }
        
        // Date filter
        if (dateFilter) {
            const orderDate = new Date(order.dataset.date);
            const now = new Date();
            let showByDate = false;
            
            switch(dateFilter) {
                case 'today':
                    showByDate = orderDate.toDateString() === now.toDateString();
                    break;
                case 'week':
                    const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                    showByDate = orderDate >= weekAgo;
                    break;
                case 'month':
                    showByDate = orderDate.getMonth() === now.getMonth() && orderDate.getFullYear() === now.getFullYear();
                    break;
                case 'year':
                    showByDate = orderDate.getFullYear() === now.getFullYear();
                    break;
            }
            
            if (!showByDate) {
                showOrder = false;
            }
        }
        
        order.style.display = showOrder ? 'block' : 'none';
    });
}
</script>

@if(session('success'))
    <script>
        // Modern notification
        const notification = document.createElement('div');
        notification.innerHTML = `
            <div style="position: fixed; top: 20px; right: 20px; background: linear-gradient(135deg, #00b894, #00cec9); color: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); z-index: 1000; animation: slideInRight 0.5s ease-out;">
                ✅ {{ session('success') }}
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.5s ease-out';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    </script>

    <style>
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>
@endif
@endsection