<div class="cart-body">
    @if(isset($cart) && count($cart) > 0)
        @foreach($cart as $key => $item)
        <div class="cart-item">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img">
            <div class="cart-item-details">
                <div class="cart-item-title-row">
                    <h3 class="cart-item-title">{{ $item['name'] }}</h3>
                    <span class="cart-item-price">Rs {{ number_format($item['price'] * $item['quantity']) }}</span>
                </div>
                <p class="cart-item-size">Size: <strong>{{ $item['size'] }}</strong></p>
                <div class="cart-item-actions">
                    <div class="cart-qty">
                        <button class="qty-btn" onclick="this.disabled=true; this.nextElementSibling.value={{ $item['quantity'] - 1 }}; updateCartQty('{{ $key }}', {{ $item['quantity'] - 1 }})">-</button>
                        <input type="text" value="{{ $item['quantity'] }}" readonly class="qty-input">
                        <button class="qty-btn" onclick="this.disabled=true; this.previousElementSibling.value={{ $item['quantity'] + 1 }}; updateCartQty('{{ $key }}', {{ $item['quantity'] + 1 }})">+</button>
                    </div>
                    <button class="cart-item-delete" onclick="removeFromCart('{{ $key }}')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 15px;"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <p>Your cart is currently empty.</p>
            <button onclick="window.location.href='{{ route('allcategories') }}'" style="margin-top: 15px; background: #1a1a1a; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Continue Shopping</button>
        </div>
    @endif
</div>

<div class="cart-footer">
    <div class="cart-subtotal">
        <span>Estimated Total:</span>
        <span>Rs {{ isset($cart) ? number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; })) : 0 }}</span>
    </div>
    <p class="cart-taxes-note">Taxes, discounts and shipping calculated at checkout.</p>
    @if(isset($cart) && count($cart) > 0)
        <a href="{{ route('checkout') }}" class="cart-checkout-btn" style="display: block; text-align: center; text-decoration: none; box-sizing: border-box;">Check out</a>
    @else
        <button class="cart-checkout-btn" disabled style="opacity: 0.5; cursor: not-allowed;">CHECKOUT</button>
    @endif
    <a href="{{ route('cart') }}" class="cart-view-link">View Cart</a>
</div>
