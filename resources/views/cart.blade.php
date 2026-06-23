@include('includes.header')

<style>
    .cart-page-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }
    .cart-breadcrumb {
        font-size: 14px;
        color: #555;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .cart-breadcrumb a {
        color: #555;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .cart-page-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 40px;
    }
    .cart-page-title {
        font-size: 32px;
        font-weight: 700;
        color: #000;
    }
    .continue-shopping {
        font-size: 14px;
        color: #000;
        text-decoration: underline;
    }
    
    .cart-content {
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }
    
    .cart-items-section {
        flex: 1;
    }
    
    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }
    .cart-table th {
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #000;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
        text-transform: uppercase;
    }
    .cart-table td {
        padding: 30px 0;
        border-bottom: 1px solid #e0e0e0;
        vertical-align: top;
    }
    
    .cart-product-info {
        display: flex;
        gap: 20px;
    }
    .cart-product-img {
        width: 100px;
        height: 125px;
        object-fit: cover;
    }
    .cart-product-details h3 {
        font-size: 14px;
        font-weight: 600;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    .cart-product-details p {
        font-size: 12px;
        color: #555;
        margin-bottom: 8px;
    }
    .cart-product-details .cart-item-price {
        font-size: 14px;
        font-weight: 600;
        color: #000;
    }
    
    .cart-qty-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .cart-qty {
        display: flex;
        border: 1px solid #ccc;
        height: 36px;
        border-radius: 2px;
    }
    .cart-qty .qty-btn {
        width: 36px;
        background: none;
        border: none;
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
    }
    .cart-qty .qty-input {
        width: 40px;
        border: none;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        text-align: center;
        font-size: 14px;
        padding: 0;
        color: #000;
    }
    .cart-item-delete {
        background: none;
        border: none;
        cursor: pointer;
        color: #000;
    }
    
    .cart-item-total {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }
    
    /* Summary Section */
    .cart-summary-section {
        width: 340px;
        border: 1px solid #e0e0e0;
        padding: 30px;
        border-radius: 4px;
    }
    .cart-summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .cart-summary-label {
        font-size: 16px;
        font-weight: 700;
        color: #000;
    }
    .cart-summary-value {
        font-size: 18px;
        font-weight: 700;
        color: #000;
    }
    .cart-summary-note {
        font-size: 12px;
        color: #555;
        margin-bottom: 25px;
        line-height: 1.5;
    }
    .cart-checkout-btn {
        width: 100%;
        background: #e2d1c3;
        color: #000;
        border: none;
        padding: 15px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.2s;
    }
    .cart-checkout-btn:hover {
        background: #d6c3b3;
    }
    
    @media (max-width: 768px) {
        .cart-content {
            flex-direction: column;
        }
        .cart-summary-section {
            width: 100%;
        }
        .cart-table th {
            display: none;
        }
        .cart-table td {
            display: block;
            border: none;
            padding: 10px 0;
        }
        .cart-table tr {
            border-bottom: 1px solid #e0e0e0;
            display: block;
            padding: 20px 0;
        }
    }
</style>

<div class="cart-page-container">
    <div class="cart-breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        <span>&rsaquo;</span>
        <span>Cart</span>
    </div>

    <div class="cart-page-header">
        <h1 class="cart-page-title">Your Cart</h1>
        <a href="{{ route('allcategories') }}" class="continue-shopping">Continue Shopping</a>
    </div>

    <div class="cart-content">
        <div class="cart-items-section">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 50%;">PRODUCT</th>
                        <th style="width: 30%;">QUANTITY</th>
                        <th style="width: 20%; text-align: right;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @if(session('cart') && count(session('cart')) > 0)
                        @foreach(session('cart') as $key => $item)
                        <tr id="cart-row-{{ $key }}">
                            <td>
                                <div class="cart-product-info">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-product-img">
                                    <div class="cart-product-details">
                                        <h3>{{ $item['name'] }}</h3>
                                        <p>Size: <strong>{{ $item['size'] }}</strong></p>
                                        <div class="cart-item-price">Rs {{ number_format($item['price']) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="cart-qty-wrapper">
                                    <div class="cart-qty">
                                        <button class="qty-btn" onclick="this.disabled=true; this.nextElementSibling.value={{ $item['quantity'] - 1 }}; updateMainCartQty(this, '{{ $key }}', {{ $item['quantity'] - 1 }})">-</button>
                                        <input type="text" value="{{ $item['quantity'] }}" readonly class="qty-input" id="qty-input-{{ $key }}">
                                        <button class="qty-btn" onclick="this.disabled=true; this.previousElementSibling.value={{ $item['quantity'] + 1 }}; updateMainCartQty(this, '{{ $key }}', {{ $item['quantity'] + 1 }})">+</button>
                                    </div>
                                    <button class="cart-item-delete" onclick="removeMainCartItem('{{ $key }}')">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/></svg>
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div class="cart-item-total" id="item-total-{{ $key }}">Rs {{ number_format($item['price'] * $item['quantity']) }}</div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 40px 0;">
                                <p style="color: #6b7280; font-size: 16px;">Your cart is currently empty.</p>
                                <a href="{{ route('allcategories') }}" style="display: inline-block; margin-top: 15px; background: #1a1a1a; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">Continue Shopping</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div class="cart-summary-section">
            <div class="cart-summary-row">
                <div class="cart-summary-label">Estimated Total:</div>
                <div class="cart-summary-value" id="cart-summary-total">Rs {{ session('cart') ? number_format(collect(session('cart'))->sum(function($item) { return $item['price'] * $item['quantity']; })) : 0 }}</div>
            </div>
            <p class="cart-summary-note">Taxes and shipping calculated at checkout.</p>
            @if(session('cart') && count(session('cart')) > 0)
                <a href="{{ route('checkout') }}" class="cart-checkout-btn" style="display: block; text-align: center; text-decoration: none; box-sizing: border-box;">Check out</a>
            @else
                <button class="cart-checkout-btn" disabled style="opacity: 0.5; cursor: not-allowed;">Check out</button>
            @endif
        </div>
    </div>
</div>

<script>
    function updateMainCartQty(btnElement, key, newQty) {
        if (newQty < 1) {
            removeMainCartItem(key);
            return;
        }
        
        fetch('{{ route('cart.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                cart_key: key,
                quantity: newQty
            })
        })
        .then(response => response.json())
        .then(data => {
            btnElement.disabled = false;
            
            if(data.success) {
                let itemTotalEl = document.getElementById('item-total-' + key);
                if (itemTotalEl) itemTotalEl.innerText = data.item_total_formatted;
                
                let cartSummaryTotalEl = document.getElementById('cart-summary-total');
                if (cartSummaryTotalEl) cartSummaryTotalEl.innerText = data.cart_total_formatted;

                let cartDrawerContent = document.getElementById('cartDrawerContent');
                if (cartDrawerContent) cartDrawerContent.innerHTML = data.drawer_html;
                
                // Update onclick handlers with newQty to prevent stale state
                let wrapper = document.getElementById('cart-row-' + key);
                if(wrapper) {
                    let buttons = wrapper.querySelectorAll('.qty-btn');
                    if(buttons.length === 2) {
                        buttons[0].setAttribute('onclick', `this.disabled=true; this.nextElementSibling.value=${newQty - 1}; updateMainCartQty(this, '${key}', ${newQty - 1})`);
                        buttons[1].setAttribute('onclick', `this.disabled=true; this.previousElementSibling.value=${newQty + 1}; updateMainCartQty(this, '${key}', ${newQty + 1})`);
                    }
                }
            }
        })
        .catch(() => btnElement.disabled = false);
    }

    function removeMainCartItem(key) {
        fetch('{{ route('cart.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                cart_key: key
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                if(data.cart_count === 0) {
                    window.location.reload();
                } else {
                    let row = document.getElementById('cart-row-' + key);
                    if (row) row.remove();
                    
                    let cartSummaryTotalEl = document.getElementById('cart-summary-total');
                    if (cartSummaryTotalEl) cartSummaryTotalEl.innerText = data.cart_total_formatted;

                    let cartDrawerContent = document.getElementById('cartDrawerContent');
                    if (cartDrawerContent) cartDrawerContent.innerHTML = data.drawer_html;
                    
                    const cartBadge = document.getElementById('cart-badge');
                    if(cartBadge) {
                        cartBadge.innerText = data.cart_count;
                        cartBadge.style.display = 'flex';
                    }
                }
            }
        });
    }
</script>

@include('includes.footer')
