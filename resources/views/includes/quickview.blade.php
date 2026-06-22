
<style>
.hover-eye {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 8px;
            color: black;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            cursor: pointer;
        }

        .hover-eye-text {
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            width: 0;
            transition: all 0.3s ease;
            overflow: hidden;
            margin-right: 0;
            color: #000;
        }

        .hover-eye:hover {
            width: 115px;
        }

        .hover-eye:hover .hover-eye-text {
            opacity: 1;
            width: auto;
            margin-right: 4px;
            margin-left: 12px;
        }

        .hover-add-to-cart {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: white;
            text-align: center;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            opacity: 0;
            transform: translateY(100%);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .hover-add-to-cart:hover {
            background: rgba(255, 255, 255, 0.1);
        }
.product-card-wrap:hover .hover-eye {
    opacity: 1;
    transform: translateY(0);
}
.product-card-wrap:hover .hover-add-to-cart {
    opacity: 1;
    transform: translateY(0);
}
.quickview-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.6);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .quickview-overlay.active {
            display: flex;
        }

        .quickview-modal {
            background: #fff;
            width: 90%;
            max-width: 950px;
            max-height: 90vh;
            border-radius: 4px;
            position: relative;
            display: flex;
            overflow: hidden;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .quickview-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #fff;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            z-index: 10;
            color: #000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            line-height: 1;
        }

        .quickview-close:hover {
            background: #f0f0f0;
        }

        .quickview-content {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .quickview-gallery {
            flex: 1.1;
            display: flex;
            gap: 15px;
            padding: 25px;
            height: 90vh;
            overflow-y: auto;
            scrollbar-width: none;
        }
        
        .quickview-gallery::-webkit-scrollbar {
            display: none;
        }

        .quickview-thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 80px;
        }

        .quickview-thumbnails img {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 4px;
            transition: border-color 0.2s;
        }
        .quickview-thumbnails img.active {
            border-color: #000;
        }

        .quickview-main-img {
            flex: 1;
            height: 100%;
            background: #f5f5f5;
            border-radius: 4px;
            overflow: hidden;
        }

        .quickview-main-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .quickview-details {
            flex: 1;
            padding: 30px 40px 30px 20px;
            overflow-y: auto;
            max-height: 90vh;
        }

        .qv-title {
            font-size: 22px;
            font-weight: 700;
            color: #000;
            margin: 0;
            margin-right: 15px;
            line-height: 1.3;
        }

        .qv-in-stock {
            background-color: #e5f5eb;
            color: #008a3c;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .qv-price {
            font-size: 22px;
            font-weight: 800;
            color: #000;
            margin: 15px 0;
        }

        .qv-color {
            font-size: 15px;
            color: #000;
            margin-bottom: 15px;
        }

        .qv-size-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .qv-size-guide {
            font-size: 12px;
            color: #000;
            text-decoration: underline;
            font-weight: 700;
        }

        .qv-size-options {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .qv-size-btn {
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 45px;
            text-align: center;
            border-radius: 4px;
        }

        .qv-size-btn:hover, .qv-size-btn.active {
            border-color: #000;
            background: #000;
            color: #fff;
        }

        .qv-quantity {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .qv-qty-selector {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .qv-qty-btn {
            background: #fff;
            border: none;
            padding: 8px 15px;
            font-size: 18px;
            cursor: pointer;
            color: #666;
        }

        .qv-qty-btn:hover {
            background: #f5f5f5;
            color: #000;
        }

        .qv-qty-input {
            width: 50px;
            border: none;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            outline: none;
        }

        .qv-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .qv-btn-add, .qv-btn-buy {
            flex: 1;
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
            text-align: center;
        }

        .qv-btn-add {
            background: #e6d7c8;
            color: #000;
            border: none;
        }

        .qv-btn-add:hover {
            background: #d4c3b3;
        }

        .qv-btn-buy {
            background: #fff;
            color: #000;
            border: 1px solid #000;
        }

        .qv-btn-buy:hover {
            background: #000;
            color: #fff;
        }

        .qv-accordions {
            border-top: 1px solid #eee;
        }

        .qv-accordion {
            border-bottom: 1px solid #eee;
        }

        .qv-accordion-header {
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: #000;
        }

        .qv-accordion-body {
            padding-bottom: 15px;
            font-size: 13px;
            color: #333;
            line-height: 1.6;
            display: none;
        }

        @media (max-width: 768px) {
            .quickview-modal {
                overflow-y: auto;
            }
            .quickview-content {
                flex-direction: column;
                height: auto;
            }
            .quickview-gallery {
                flex: none;
                height: auto;
                max-height: none;
                padding-bottom: 10px;
            }
            .quickview-thumbnails {
                width: 60px;
            }
            .quickview-details {
                padding: 20px;
                overflow-y: visible;
                max-height: none;
            }
        }
    </style>

<div id="quickview-container">
        @foreach($modalProducts as $prod)
            <div class="quickview-overlay" id="qv-{{ $prod->id }}" onclick="closeQuickView(event, {{ $prod->id }})">
                <div class="quickview-modal" onclick="event.stopPropagation()">
                    <button class="quickview-close" onclick="closeQuickView(event, {{ $prod->id }})">&times;</button>
                    <div class="quickview-content">
                        <div class="quickview-gallery">
                            <div class="quickview-thumbnails">
                                @if($prod->image_path)
                                    <img src="{{ asset($prod->image_path) }}" alt="Thumb" class="qv-thumb active" onclick="changeQvMainImage(this, '{{ asset($prod->image_path) }}', {{ $prod->id }})">
                                @else
                                    <img src="{{ asset('images/product.png') }}" alt="Thumb" class="qv-thumb active" onclick="changeQvMainImage(this, '{{ asset('images/product.png') }}', {{ $prod->id }})">
                                @endif
                                @if($prod->images && $prod->images->count() > 0)
                                    @foreach($prod->images as $img)
                                        <img src="{{ asset($img->image_path) }}" alt="Thumb" class="qv-thumb" onclick="changeQvMainImage(this, '{{ asset($img->image_path) }}', {{ $prod->id }})">
                                    @endforeach
                                @endif
                            </div>
                            <div class="quickview-main-img">
                                <img id="qv-main-img-{{ $prod->id }}" src="{{ $prod->image_path ? asset($prod->image_path) : asset('images/product.png') }}" alt="{{ $prod->name }}">
                            </div>
                        </div>
                        <div class="quickview-details">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <h2 class="qv-title">{{ $prod->name }}</h2>
                                @if($prod->quantity > 0)
                                    <span class="qv-in-stock">In Stock</span>
                                @else
                                    <span class="qv-in-stock" style="background-color: #fde8e8; color: #dc2626;">Out of Stock</span>
                                @endif
                            </div>
                            
                            <div class="qv-price">
                                @if($prod->is_on_sale && $prod->sale_price)
                                    <span style="text-decoration: line-through; color: #9ca3af; font-size: 18px; margin-right: 10px;">Rs {{ number_format($prod->price) }}</span>
                                    <span>Rs {{ number_format($prod->sale_price) }}</span>
                                @else
                                    Rs {{ number_format($prod->price) }}
                                @endif
                            </div>
                            
                            @if($prod->color)
                            <div class="qv-color">
                                <span style="font-weight: 600;">Color:</span> {{ $prod->color }}
                            </div>
                            @endif
                            
                            @if($prod->size)
                            <div class="product-size" style="margin-bottom: 20px;">
                                <div class="qv-size-header">
                                    <div><span style="font-weight: 600;">Size:</span> <span id="qv-size-{{ $prod->id }}">None</span></div>
                                    <a href="#" class="qv-size-guide" onclick="openSizeGuide(event)">Size Guide</a>
                                </div>
                                <div class="qv-size-options">
                                    @php
                                        $sizes = is_string($prod->size) ? explode(',', $prod->size) : (is_array($prod->size) ? $prod->size : []);
                                    @endphp
                                    @foreach($sizes as $index => $size)
                                        <button class="qv-size-btn {{ $index === 0 ? 'active' : '' }}" onclick="selectQvSize(this, '{{ trim($size) }}', {{ $prod->id }})">{{ trim($size) }}</button>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <div class="qv-quantity">
                                <span style="font-weight: 600;">Quantity:</span>
                                <div class="qv-qty-selector">
                                    <button class="qv-qty-btn" onclick="let input = this.nextElementSibling; if(input.value > 1) input.value--;">-</button>
                                    <input type="text" value="1" class="qv-qty-input">
                                    <button class="qv-qty-btn" onclick="let input = this.previousElementSibling; input.value++;">+</button>
                                </div>
                            </div>
                            
                            <div class="qv-actions">
                                @if($prod->quantity > 0)
                                    <button class="qv-btn-add" onclick="qvAddToCart(this, {{ $prod->id }})">Add to Cart</button>
                                    <button class="qv-btn-buy" onclick="qvBuyItNow(this, {{ $prod->id }})">Buy it Now</button>
                                @else
                                    <button class="qv-btn-add" disabled style="background: rgba(200,0,0,0.7); cursor: not-allowed; color: white;">Out of Stock</button>
                                    <button class="qv-btn-buy" disabled style="background: #f5f5f5; border-color: #ddd; color: #999; cursor: not-allowed;">Unavailable</button>
                                @endif
                            </div>
                            
                            <div class="qv-accordions">
                                <div class="qv-accordion">
                                    <div class="qv-accordion-header" onclick="toggleQvAccordion(this)">Product Details <span>+</span></div>
                                    <div class="qv-accordion-body">
                                        {!! nl2br(e($prod->product_details ?? $prod->product_detail ?? 'No details available.')) !!}
                                    </div>
                                </div>
                                <div class="qv-accordion">
                                    <div class="qv-accordion-header" onclick="toggleQvAccordion(this)">Product Care <span>+</span></div>
                                    <div class="qv-accordion-body">
                                        {!! nl2br(e($prod->product_care ?? 'Dry clean only. Do not bleach.')) !!}
                                    </div>
                                </div>
                                <div class="qv-accordion">
                                    <div class="qv-accordion-header" onclick="toggleQvAccordion(this)">Shipping <span>+</span></div>
                                    <div class="qv-accordion-body">
                                        {!! nl2br(e($prod->shipping ?? 'Standard delivery takes 3-5 business days.')) !!}
                                    </div>
                                </div>
                                <div class="qv-accordion">
                                    <div class="qv-accordion-header" onclick="toggleQvAccordion(this)">Return & Exchange <span>+</span></div>
                                    <div class="qv-accordion-body">
                                        {!! nl2br(e($prod->return_exchange ?? 'Returns accepted within 14 days.')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<script>
        function openQuickView(id) {
            document.getElementById('qv-' + id).classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeQuickView(e, id) {
            if (e) {
                e.preventDefault();
            }
            document.getElementById('qv-' + id).classList.remove('active');
            document.body.style.overflow = '';
        }
        
        function changeQvMainImage(thumbElement, imageUrl, id) {
            document.getElementById('qv-main-img-' + id).src = imageUrl;
            const container = thumbElement.parentElement;
            container.querySelectorAll('.qv-thumb').forEach(thumb => thumb.classList.remove('active'));
            thumbElement.classList.add('active');
        }
        
        function selectQvSize(btn, size, id) {
            const container = btn.parentElement;
            container.querySelectorAll('.qv-size-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const sizeEl = document.getElementById('qv-size-' + id);
            if(sizeEl) sizeEl.innerText = size;
        }
        
        function toggleQvAccordion(headerElement) {
            const accordion = headerElement.parentElement;
            const body = accordion.querySelector('.qv-accordion-body');
            const icon = accordion.querySelector('span');
            
            if (body.style.display === 'block') {
                body.style.display = 'none';
                icon.innerText = '+';
            } else {
                body.style.display = 'block';
                icon.innerText = '-';
            }
        }
        
        // Initialize first size for each modal
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.quickview-modal').forEach(modal => {
                const firstSize = modal.querySelector('.qv-size-btn.active');
                if (firstSize) {
                    const idMatch = modal.parentElement.id.match(/qv-(\d+)/);
                    if (idMatch && idMatch[1]) {
                        const sizeTextEl = document.getElementById('qv-size-' + idMatch[1]);
                        if (sizeTextEl) {
                            sizeTextEl.innerText = firstSize.innerText;
                        }
                    }
                }
            });
        });

        // Add to Cart from Home Page logic
        function addToCartFromHome(event, productId) {
            event.preventDefault();
            event.stopPropagation();
            
            const btn = event.target;
            
            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartContent = document.getElementById('cartDrawerContent');
                    if (cartContent) {
                        cartContent.innerHTML = data.drawer_html;
                    }
                    if (typeof openCart === 'function') {
                        openCart();
                    }
                    const cartBadge = document.getElementById('cart-badge');
                    if (cartBadge) {
                        cartBadge.innerText = data.cart_count;
                        cartBadge.style.display = 'flex';
                    }
                } else {
                    alert('Error adding product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding product to cart.');
            });
        }

        function qvAddToCart(btn, productId) {
            const container = btn.closest('.quickview-details');
            
            let size = null;
            const activeSizeBtn = container.querySelector('.qv-size-btn.active');
            if (activeSizeBtn) {
                size = activeSizeBtn.innerText;
            }

            let qty = 1;
            const qtyInput = container.querySelector('.qv-qty-input');
            if (qtyInput) {
                qty = parseInt(qtyInput.value) || 1;
            }

            btn.disabled = true;

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    size: size,
                    quantity: qty
                })
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                if (data.success) {
                    const cartContent = document.getElementById('cartDrawerContent');
                    if (cartContent) {
                        cartContent.innerHTML = data.drawer_html;
                    }
                    if (typeof closeQuickView === 'function') {
                        closeQuickView(null, productId);
                    }
                    if (typeof openCart === 'function') {
                        openCart();
                    }
                    const cartBadge = document.getElementById('cart-badge');
                    if (cartBadge) {
                        cartBadge.innerText = data.cart_count;
                        cartBadge.style.display = 'flex';
                    }
                } else {
                    alert('Error adding product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.disabled = false;
                alert('Error adding product to cart.');
            });
        }

        function qvBuyItNow(btn, productId) {
            const container = btn.closest('.quickview-details');
            
            let size = null;
            const activeSizeBtn = container.querySelector('.qv-size-btn.active');
            if (activeSizeBtn) {
                size = activeSizeBtn.innerText;
            }

            let qty = 1;
            const qtyInput = container.querySelector('.qv-qty-input');
            if (qtyInput) {
                qty = parseInt(qtyInput.value) || 1;
            }

            btn.disabled = true;

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    size: size,
                    quantity: qty
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = '{{ route('checkout') }}';
                } else {
                    btn.disabled = false;
                    alert('Error adding product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.disabled = false;
                alert('Error adding product to cart.');
            });
        }
    </script>
