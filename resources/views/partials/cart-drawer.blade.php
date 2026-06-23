<!-- Cart Drawer Styles -->
<style>
    .cart-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        z-index: 2000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .cart-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .cart-drawer {
        position: fixed;
        top: 0;
        right: -450px;
        width: 400px;
        max-width: 100vw;
        height: 100vh;
        background: #fff;
        z-index: 2001;
        display: flex;
        flex-direction: column;
        transition: right 0.3s ease;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
    }
    .cart-drawer.open {
        right: 0;
    }
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #e0e0e0;
    }
    .cart-title {
        font-size: 16px;
        font-weight: 700;
        color: #000;
    }
    .cart-close {
        background: none;
        border: none;
        cursor: pointer;
        color: #000;
    }
    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
    }
    .cart-item {
        display: flex;
        gap: 15px;
        margin-bottom: 24px;
    }
    .cart-item-img {
        width: 80px;
        height: 100px;
        object-fit: cover;
    }
    .cart-item-details {
        flex: 1;
    }
    .cart-item-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
    }
    .cart-item-title {
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
        color: #000;
        margin-top: -2px;
    }
    .cart-item-price {
        font-size: 13px;
        font-weight: 800;
        color: #000;
        white-space: nowrap;
    }
    .cart-item-size {
        font-size: 11px;
        color: #555;
        margin-top: 5px;
        margin-bottom: 15px;
    }
    .cart-item-actions {
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
        display: flex;
        align-items: center;
        margin-left: 5px;
    }
    .cart-footer {
        padding: 24px;
        border-top: 1px solid #e0e0e0;
    }
    .cart-subtotal {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 800;
        color: #000;
        margin-bottom: 10px;
    }
    .cart-taxes-note {
        font-size: 11px;
        color: #555;
        margin-bottom: 20px;
    }
    .cart-checkout-btn {
        width: 100%;
        background: #e2d1c3;
        color: #000;
        border: none;
        padding: 15px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        border-radius: 4px;
        margin-bottom: 15px;
        transition: background 0.2s;
    }
    .cart-checkout-btn:hover {
        background: #d6c3b3;
    }
    .cart-view-link {
        display: block;
        text-align: center;
        font-size: 13px;
        color: #000;
        text-decoration: underline;
        font-weight: 600;
    }
</style>

<!-- Cart Drawer Overlay -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- Cart Drawer -->
<div class="cart-drawer" id="cartDrawer">
    <div class="cart-header">
        <h2 class="cart-title">Your Cart</h2>
        <button class="cart-close" id="closeCartBtn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>

    <div id="cartDrawerContent" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
        @include('partials.cart-drawer-items', ['cart' => session('cart')])
    </div>
</div>

<script>
    const cartDrawer = document.getElementById('cartDrawer');
    const cartOverlay = document.getElementById('cartOverlay');
    const closeCartBtn = document.getElementById('closeCartBtn');

    function openCart() {
        cartDrawer.classList.add('open');
        cartOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeCart() {
        cartDrawer.classList.remove('open');
        cartOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if(closeCartBtn) {
        closeCartBtn.addEventListener('click', closeCart);
    }
    if(cartOverlay) {
        cartOverlay.addEventListener('click', closeCart);
    }

    function updateCartQty(key, newQty) {
        if (newQty < 1) {
            removeFromCart(key);
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
            if(data.success) {
                document.getElementById('cartDrawerContent').innerHTML = data.drawer_html;
            }
        });
    }

    function removeFromCart(key) {
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
                document.getElementById('cartDrawerContent').innerHTML = data.drawer_html;
                const cartBadges = document.querySelectorAll('.cart-badge');
                cartBadges.forEach(badge => {
                    badge.innerText = data.cart_count;
                    badge.style.display = data.cart_count > 0 ? 'flex' : 'none';
                });
            }
        });
    }
</script>
