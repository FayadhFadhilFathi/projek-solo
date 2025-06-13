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

    .orders-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        transform: translateY(20px);
        animation: slideUp 0.6s ease-out forwards;
    }

    .stat-card:nth-child(2) {
        background: linear-gradient(135deg, #4ecdc4, #44a08d);
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(3) {
        background: linear-gradient(135deg, #45b7d1, #96c93d);
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(4) {
        background: linear-gradient(135deg, #f093fb, #f5576c);
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

    .payment-section {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
        text-align: center;
    }

    .payment-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .select-all-btn, .pay-now-btn {
        padding: 12px 24px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .select-all-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
    }

    .select-all-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .pay-now-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .pay-now-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .pay-now-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
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
        border-left: 5px solid #667eea;
        transition: all 0.3s ease;
        animation: fadeInRight 0.6s ease-out forwards;
        opacity: 0;
        transform: translateX(30px);
        position: relative;
    }

    .order-card.selected {
        border-left-color: #00b894;
        background: linear-gradient(135deg, #f8f9ff, #e8f5e8);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .order-card:nth-child(1) { animation-delay: 0.1s; }
    .order-card:nth-child(2) { animation-delay: 0.2s; }
    .order-card:nth-child(3) { animation-delay: 0.3s; }

    .order-checkbox {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 24px;
        height: 24px;
        accent-color: #00b894;
        cursor: pointer;
        transform: scale(1.2);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
        padding-right: 40px;
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

    .status-pending {
        background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
        color: #d63031;
    }

    .status-processing {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        color: white;
    }

    .status-shipped {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
    }

    .status-delivered {
        background: linear-gradient(135deg, #00b894, #55a3ff);
        color: white;
    }

    .status-paid {
        background: linear-gradient(135deg, #00b894, #55a3ff);
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

    .selected-total {
        background: rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 1.2rem;
        font-weight: 600;
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

    /* Success Notification Styles */
    .success-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        z-index: 99999; /* Sangat tinggi untuk memastikan di atas navbar */
        animation: slideInRight 0.5s ease-out;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 300px;
        word-wrap: break-word;
    }

    .success-notification.slide-out {
        animation: slideOutRight 0.5s ease-out;
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

    @keyframes slideInRight {
        from { 
            transform: translateX(100%); 
            opacity: 0; 
        }
        to { 
            transform: translateX(0); 
            opacity: 1; 
        }
    }

    @keyframes slideOutRight {
        from { 
            transform: translateX(0); 
            opacity: 1; 
        }
        to { 
            transform: translateX(100%); 
            opacity: 0; 
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

        .orders-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .payment-controls {
            flex-direction: column;
        }

        .tab-navigation {
            flex-direction: column;
        }

        /* Mobile notification adjustment */
        .success-notification {
            top: 10px;
            right: 10px;
            left: 10px;
            max-width: none;
            font-size: 14px;
        }
    }
</style>

<div class="orders-page">
    <div class="orders-header">
        <h1>🛍️ My Orders</h1>
        <p>Track your purchases and order history</p>
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

        @if($orders->where('status', 'pending')->count() > 0)
            <!-- Stats Section -->
            <div class="orders-stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->count() }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${{ number_format($orders->sum('total_price'), 0) }}</div>
                    <div class="stat-label">Total Value</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $orders->where('status', 'paid')->count() + $orders->where('status', 'delivered')->count() }}</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="payment-section">
                <h3>💳 Payment Center</h3>
                <p>Select orders to pay and complete your purchases</p>
                <div class="payment-controls">
                    <button type="button" class="select-all-btn" onclick="toggleSelectAll()">
                        ✅ Select All Pending
                    </button>
                    <div class="selected-total">
                        Total: $<span id="selectedTotal">0.00</span>
                    </div>
                    <button type="button" class="pay-now-btn" id="payNowBtn" onclick="proceedToPayment()" disabled>
                        💰 Pay Now
                    </button>
                </div>
            </div>

            <!-- Orders List -->
            <div class="orders-grid">
                @foreach($orders->where('status', 'pending') as $order)
                    <div class="order-card" data-order-id="{{ $order->id }}" data-price="{{ $order->total_price }}">
                        @if($order->status === 'pending')
                            <input type="checkbox" class="order-checkbox" onchange="updateSelection()" data-price="{{ $order->total_price }}">
                        @endif
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
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <div class="empty-message">No pending orders!</div>
                <div class="empty-submessage">All your orders have been processed or start shopping to see orders here</div>
                <a href="{{ route('dashboard') }}" class="back-btn">
                    🛒 Start Shopping
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
let selectedOrders = [];

function updateSelection() {
    const checkboxes = document.querySelectorAll('.order-checkbox:checked');
    const totalElement = document.getElementById('selectedTotal');
    const payBtn = document.getElementById('payNowBtn');
    
    selectedOrders = [];
    let total = 0;
    
    checkboxes.forEach(checkbox => {
        const orderCard = checkbox.closest('.order-card');
        const orderId = orderCard.dataset.orderId;
        const price = parseFloat(orderCard.dataset.price);
        
        selectedOrders.push(orderId);
        total += price;
        
        orderCard.classList.add('selected');
    });
    
    // Remove selected class from unchecked cards
    document.querySelectorAll('.order-card').forEach(card => {
        const checkbox = card.querySelector('.order-checkbox');
        if (!checkbox || !checkbox.checked) {
            card.classList.remove('selected');
        }
    });
    
    totalElement.textContent = total.toFixed(2);
    payBtn.disabled = selectedOrders.length === 0;
}

function toggleSelectAll() {
    const checkboxes = document.querySelectorAll('.order-checkbox');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
    });
    
    updateSelection();
}

function proceedToPayment() {
    if (selectedOrders.length === 0) {
        alert('Please select at least one order to pay.');
        return;
    }
    
    // Create form and submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("user.payment.process") }}';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    // Add selected orders
    selectedOrders.forEach(orderId => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'order_ids[]';
        input.value = orderId;
        form.appendChild(input);
    });
    
    document.body.appendChild(form);
    form.submit();
}

// Function untuk menampilkan notifikasi sukses
function showSuccessNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'success-notification';
    notification.innerHTML = `✅ ${message}`;
    
    document.body.appendChild(notification);
    
    // Auto remove setelah 4 detik
    setTimeout(() => {
        notification.classList.add('slide-out');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    }, 4000);
    
    // Click to dismiss
    notification.addEventListener('click', () => {
        notification.classList.add('slide-out');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    });
}
</script>

@if(session('success'))
    <script>
        // Tunggu sampai halaman selesai load
        document.addEventListener('DOMContentLoaded', function() {
            showSuccessNotification('{{ session('success') }}');
        });
    </script>
@endif
@endsection