@include('includes.header')

<style>
    .product-page-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
        margin-bottom: 40px;
    }

    .breadcrumb a {
        color: #000;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .breadcrumb svg {
        width: 16px;
        height: 16px;
    }

    .product-layout {
        display: flex;
        gap: 50px;
        align-items: flex-start;
    }

    /* Gallery */
    .product-gallery {
        flex: 1.2;
        display: flex;
        gap: 20px;
    }

    .thumbnail-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 80px;
    }

    .thumbnail-list img {
        width: 100%;
        aspect-ratio: 4 / 5;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.2s;
    }

    .thumbnail-list img.active {
        border-color: #000;
    }

    .main-image {
        flex: 1;
        position: relative;
        background: #f5f5f5;
        overflow: hidden;
        cursor: crosshair;
    }

    .main-image img {
        width: 100%;
        height: auto;
        display: block;
        aspect-ratio: 4 / 5;
        object-fit: cover;
        transition: transform 0.1s ease-out;
        transform-origin: center center;
    }
    
    .main-image:hover img {
        transform: scale(2.5);
    }

    .zoom-btn {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* Details */
    .product-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .product-title {
        font-size: 24px;
        font-weight: 700;
        color: #000;
        margin: 0;
        line-height: 1.3;
    }

    .in-stock-badge {
        background-color: #e5f5eb;
        color: #008a3c;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .product-price {
        font-size: 22px;
        font-weight: 800;
        color: #000;
    }

    .product-color {
        font-size: 15px;
        color: #000;
    }

    .product-size {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .size-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 15px;
    }

    .size-guide {
        font-size: 12px;
        color: #000;
        text-decoration: underline;
        font-weight: 700;
    }

    .size-options {
        display: flex;
        gap: 10px;
    }

    .size-btn {
        background: #fff;
        border: 1px solid #ddd;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 45px;
        text-align: center;
    }

    .size-btn:hover {
        border-color: #000;
    }

    .size-btn.active {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .product-quantity {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 15px;
        font-weight: 600;
    }

    .quantity-selector {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .qty-btn {
        background: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 18px;
        cursor: pointer;
        color: #666;
    }

    .qty-btn:hover {
        background: #f5f5f5;
        color: #000;
    }

    .qty-input {
        width: 50px;
        border: none;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        text-align: center;
        font-size: 15px;
        font-weight: 600;
        outline: none;
    }

    .product-actions {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .btn-add-cart, .btn-buy-now {
        flex: 1;
        padding: 18px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .btn-add-cart {
        background: #d6c6b8; /* Approximate tan/gold from screenshot */
        color: #000;
        border: none;
    }

    .btn-add-cart:hover {
        background: #c5b2a2;
    }

    .btn-buy-now {
        background: #fff;
        color: #000;
        border: 1px solid #000;
    }

    .btn-buy-now:hover {
        background: #000;
        color: #fff;
    }

    /* Accordions */
    .product-accordions {
        margin-top: 20px;
        border-top: 1px solid #eee;
    }

    .prod-accordion {
        border-bottom: 1px solid #eee;
    }

    .prod-accordion-header {
        padding: 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        color: #000;
    }

    .prod-accordion-header span {
        font-size: 18px;
        font-weight: 400;
        transition: transform 0.3s;
    }

    .prod-accordion.active .prod-accordion-header span {
        transform: rotate(45deg); /* Turns + into x */
    }

    .prod-accordion-body {
        padding-bottom: 20px;
        font-size: 14px;
        color: #000;
        line-height: 1.6;
        display: none;
    }

    .prod-accordion.active .prod-accordion-body {
        display: block;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .product-layout {
            flex-direction: column;
        }
        .product-gallery, .product-details {
            width: 100%;
            flex: none;
        }
    }

    @media (max-width: 768px) {
        .category-page-container {
            padding: 20px;
        }
        .product-gallery {
            flex-direction: column-reverse;
        }
        .thumbnail-list {
            flex-direction: row;
            width: 100%;
            overflow-x: auto;
        }
        .thumbnail-list img {
            width: 80px;
        }
        .product-actions {
            flex-direction: column;
        }
    }
    /* Reviews Section */
    .reviews-section {
        margin: 0 auto;
        padding-top: 40px;
        max-width: 900px;
    }
    
    .reviews-title {
        text-align: center;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 30px;
        color: #000;
    }
    
    .reviews-summary {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-bottom: 40px;
        padding-bottom: 40px;
        
    }
    
    .reviews-left {
        text-align: center;
        padding-right: 60px;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .rating-big {
        font-size: 36px;
        font-weight: 800;
        color: #000;
        margin-bottom: 5px;
    }
    
    .rating-big span {
        font-size: 14px;
        color: #666;
        font-weight: 400;
    }
    
    .stars-outer {
        color: #f8c146;
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .review-count {
        font-size: 13px;
        color: #666;
        font-weight: 600;
    }
    
    .reviews-right {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 300px;
    }
    
    .rating-bar-row {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 12px;
        font-weight: 700;
        color: #000;
    }
    
    .rating-bar-wrap {
        flex: 1;
        height: 6px;
        background: #e0e0e0;
        border-radius: 3px;
        overflow: hidden;
    }
    
    .rating-bar-fill {
        height: 100%;
        background: #000;
        border-radius: 3px;
    }
    
    .reviews-list-header {
        margin-bottom: 30px;
    }
    
    .sort-reviews {
        background: #f5f5f5;
        border: 1px solid #ddd;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #000;
    }
    
    .review-item {
        margin-bottom: 40px;
    }
    
    .review-user-info {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .review-user-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .review-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .review-user-details h4 {
        margin: 0 0 5px 0;
        font-size: 13px;
        font-weight: 700;
        color: #000;
    }
    
    .review-user-details .stars {
        color: #f8c146;
        font-size: 11px;
    }
    
    .review-date {
        font-size: 11px;
        color: #999;
    }
    
    .review-text {
        font-size: 13px;
        color: #000;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    .review-images {
        display: flex;
        gap: 10px;
    }
    
    .review-images img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .reviews-summary {
            flex-direction: column;
            gap: 30px;
            padding-bottom: 30px;
        }
        .reviews-left {
            padding-right: 0;
            border-right: none;
            border-bottom: 1px solid #eee;
            padding-bottom: 30px;
        }
        .reviews-right {
            min-width: auto;
        }
    }
    /* Trending Products Section */
    /* .trending-section {
        margin-top: 20px;
        padding-top: 10px;
    } */
    .trending-title {
        font-size: 24px;
        font-weight: 800;
        color: #000;
        margin-bottom: 30px;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px 20px;
    }
    .product-card-wrap {
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }
    .product-card-wrap .image-container {
        overflow: hidden;
        margin-bottom: 10px;
    }
    .product-card-wrap .product-image {
        width: 100%;
        aspect-ratio: 4 / 5;
        object-fit: cover;
        background-color: #f5f5f5;
        transition: transform 0.5s ease;
    }
    .product-card-wrap:hover .product-image {
        transform: scale(1.03);
    }
    .product-card-wrap .product-title {
        font-size: 12px;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    .product-card-wrap .product-price {
        font-size: 13px;
        font-weight: 800;
        color: #000;
    }
    @media (max-width: 1024px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 576px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 10px;
        }
    }
    
    /* Cart Drawer (Moved to global partial) */
</style>

<div class="product-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        <span>&rsaquo;</span>
        <a href="{{ route('category', ['slug' => isset($product->categories) && $product->categories->count() > 0 ? $product->categories->first()->full_slug() : ($product->category ? $product->category->full_slug() : 'uncategorized')]) }}">{{ isset($product->categories) && $product->categories->count() > 0 ? $product->categories->first()->name : ($product->category ? $product->category->name : 'Uncategorized') }}</a>
        <span>&rsaquo;</span>
        <span>{{ \Illuminate\Support\Str::limit($product->name, 25) }}</span>
    </div>

    <div class="product-layout">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="thumbnail-list" id="thumbnailList">
                @if($product->image_path)
                    <img src="{{ asset($product->image_path) }}" alt="Thumbnail Main" class="gallery-thumb active" onclick="changeMainImage(this, '{{ asset($product->image_path) }}')">
                @else
                    <img src="{{ asset('images/product.png') }}" alt="Thumbnail Main" class="gallery-thumb active" onclick="changeMainImage(this, '{{ asset('images/product.png') }}')">
                @endif
                
                @if($product->images && $product->images->count() > 0)
                    @foreach($product->images as $img)
                        <img src="{{ asset($img->image_path) }}" alt="Thumbnail {{ $loop->iteration }}" class="gallery-thumb" onclick="changeMainImage(this, '{{ asset($img->image_path) }}')">
                    @endforeach
                @endif
            </div>
            <div class="main-image">
                @if($product->image_path)
                    <img id="mainProductImage" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                @else
                    <img id="mainProductImage" src="{{ asset('images/product.png') }}" alt="{{ $product->name }}">
                @endif
                <button class="zoom-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                </button>
            </div>
        </div>
        
        <script>
            function changeMainImage(thumbElement, imageUrl) {
                // Update main image source
                document.getElementById('mainProductImage').src = imageUrl;
                
                // Update active state of thumbnails
                const thumbnails = document.querySelectorAll('.gallery-thumb');
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                thumbElement.classList.add('active');
            }

            // Image Zoom Effect
            document.addEventListener("DOMContentLoaded", function() {
                const mainImageContainer = document.querySelector('.main-image');
                const mainImgZoom = document.getElementById('mainProductImage');

                if(mainImageContainer && mainImgZoom) {
                    mainImageContainer.addEventListener('mousemove', function(e) {
                        const rect = mainImageContainer.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        
                        const xPercent = (x / rect.width) * 100;
                        const yPercent = (y / rect.height) * 100;
                        
                        mainImgZoom.style.transformOrigin = `${xPercent}% ${yPercent}%`;
                    });
                    
                    mainImageContainer.addEventListener('mouseleave', function() {
                        mainImgZoom.style.transformOrigin = 'center center';
                    });
                }
            });
        </script>

        <!-- Details -->
        <div class="product-details">
            <div class="product-header">
                <h1 class="product-title" style="display: flex; align-items: center; flex-wrap: wrap;">
                    {{ $product->name }}
                    @if($product->is_on_sale)
                        <span style="background-color: #fde8e8; color: #9b1c1c; padding: 2px 8px; border-radius: 4px; font-size: 14px; font-weight: 600; margin-left: 10px;">SALE</span>
                    @endif
                </h1>
                @if($product->quantity > 0)
                    <span class="in-stock-badge">In Stock</span>
                @else
                    <span class="in-stock-badge" style="background-color: #fde8e8; color: #dc2626;">Out of Stock</span>
                @endif
            </div>
            
            <div class="product-price">
                @if($product->is_on_sale && $product->sale_price)
                    <span style="text-decoration: line-through; color: #9ca3af; font-size: 20px; margin-right: 10px;">Rs {{ number_format($product->price) }}</span>
                    <span>Rs {{ number_format($product->sale_price) }}</span>
                @else
                    Rs {{ number_format($product->price) }}
                @endif
            </div>
            
            @if($product->color)
            <div class="product-color">
                <span style="font-weight: 600;">Color:</span> {{ $product->color }}
            </div>
            @endif
            
            @if($product->size)
            <div class="product-size">
                <div class="size-header">
                    <div><span style="font-weight: 600;">Size:</span> <span id="selectedSizeText">None</span></div>
                    <a href="#" class="size-guide" onclick="openSizeGuide(event)">Size Guide</a>
                </div>
                <div class="size-options">
                    @php
                        // Handle sizes saved as comma separated strings
                        $sizes = is_string($product->size) ? explode(',', $product->size) : (is_array($product->size) ? $product->size : []);
                    @endphp
                    @foreach($sizes as $index => $size)
                        <button class="size-btn {{ $index === 0 ? 'active' : '' }}" onclick="selectSize(this, '{{ trim($size) }}')">{{ trim($size) }}</button>
                    @endforeach
                </div>
                <script>
                    function selectSize(btn, size) {
                        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        document.getElementById('selectedSizeText').innerText = size;
                    }
                    // Initialize first size
                    window.addEventListener('DOMContentLoaded', () => {
                        const firstSize = document.querySelector('.size-btn.active');
                        if(firstSize) document.getElementById('selectedSizeText').innerText = firstSize.innerText;
                    });
                </script>
            </div>
            @endif
            
            <div class="product-quantity">
                <span style="font-weight: 600;">Quantity:</span>
                <div class="quantity-selector">
                    <button class="qty-btn" onclick="let input = this.nextElementSibling; if(input.value > 1) input.value--;">-</button>
                    <input type="text" value="1" class="qty-input">
                    <button class="qty-btn" onclick="let input = this.previousElementSibling; input.value++;">+</button>
                </div>
            </div>
            
            <div class="product-actions">
                @if($product->quantity > 0)
                    <button class="btn-add-cart" id="btnAddToCart">Add to Cart</button>
                    <button class="btn-buy-now">Buy it Now</button>
                @else
                    <button class="btn-add-cart" disabled style="background: rgba(200,0,0,0.7); cursor: not-allowed; color: white;">Out of Stock</button>
                    <button class="btn-buy-now" disabled style="background: #f5f5f5; border-color: #ddd; color: #999; cursor: not-allowed;">Unavailable</button>
                @endif
            </div>
            
            <div class="product-accordions">
                <div class="prod-accordion">
                    <div class="prod-accordion-header">Product Details <span>+</span></div>
                    <div class="prod-accordion-body">
                        {!! nl2br(e($product->product_details ?? $product->product_detail ?? 'No details available.')) !!}
                    </div>
                </div>
                <div class="prod-accordion">
                    <div class="prod-accordion-header">Product Care <span>+</span></div>
                    <div class="prod-accordion-body">
                        {!! nl2br(e($product->product_care ?? 'Dry clean only. Do not bleach. Wash dark colors separately. Iron at moderate temperature.')) !!}
                    </div>
                </div>
                <div class="prod-accordion">
                    <div class="prod-accordion-header">Shipping <span>+</span></div>
                    <div class="prod-accordion-body">
                        {!! nl2br(e($product->shipping ?? 'Standard delivery takes 3-5 business days. Express shipping options available at checkout.')) !!}
                    </div>
                </div>
                <div class="prod-accordion">
                    <div class="prod-accordion-header">Return & Exchange <span>+</span></div>
                    <div class="prod-accordion-body">
                        {!! nl2br(e($product->return_exchange ?? 'Returns and exchanges are accepted within 14 days of purchase. Items must be in original condition with tags attached.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="reviews-section" id="reviews">
        <h2 class="reviews-title">Customer Rating & Reviews</h2>
        
        @php
            $approvedReviews = $product->reviews()->with('images')->where('status', 'approved')->get();
            $reviewCount = $approvedReviews->count();
            $averageRating = $reviewCount > 0 ? round($approvedReviews->avg('rating'), 1) : 0;
            
            $starCounts = [
                5 => $approvedReviews->where('rating', 5)->count(),
                4 => $approvedReviews->where('rating', 4)->count(),
                3 => $approvedReviews->where('rating', 3)->count(),
                2 => $approvedReviews->where('rating', 2)->count(),
                1 => $approvedReviews->where('rating', 1)->count(),
            ];
            
            $ratingWidth = ($averageRating / 5) * 100;
        @endphp

        <div class="reviews-summary-container" style="display: flex; gap: 30px; margin-bottom: 10px; flex-wrap: wrap; align-items: flex-start;">
            <div class="reviews-summary" style="flex: 2; min-width: 250px; margin-bottom: 0; padding-bottom: 0;">
                <div class="reviews-left" style="min-width: 150px;">
                    <div class="rating-big">{{ number_format($averageRating, 1) }} <span>out of 5</span></div>
                    <div class="stars-outer" style="position: relative; display: inline-block; color: #d1d5db; font-size: 20px;">
                        ★★★★★
                        <div class="stars-inner" style="position: absolute; top: 0; left: 0; white-space: nowrap; overflow: hidden; color: #fbbf24; width: {{ $ratingWidth }}%;">
                            ★★★★★
                        </div>
                    </div>
                    <div class="review-count">({{ $reviewCount }} {{ $reviewCount == 1 ? 'Review' : 'Reviews' }})</div>
                </div>
                <div class="reviews-right" style="flex: 2; min-width: 200px;">
                    @for($i = 5; $i >= 1; $i--)
                    <div class="rating-bar-row">
                        <span>{{ $i }}★</span>
                        <div class="rating-bar-wrap"><div class="rating-bar-fill" style="width: {{ $reviewCount > 0 ? ($starCounts[$i] / $reviewCount) * 100 : 0 }}%;"></div></div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="write-review-box" style="flex: 1; min-width: 250px; padding: 30px; border: 1px solid #e5e7eb; border-radius: 8px; text-align: center;">
                <h3 style="font-size: 16px; margin-bottom: 15px;">Write a Review</h3>
                <button onclick="document.getElementById('reviewFormContainer').style.display='block'; this.style.display='none'" class="btn-write-review" style="background-color: #f6f3eb; color: #000; border: none; padding: 12px 30px; font-weight: 600; cursor: pointer; border-radius: 4px; width: 100%;">WRITE A REVIEW</button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="background-color: #def7ec; color: #03543f; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="background-color: #fde8e8; color: #9b1c1c; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="reviewFormContainer" style="display: none; margin-bottom: 20px;">
            <form action="{{ route('product.review.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <label for="name" style="display: block; font-size: 12px; color: #002e4d; margin-bottom: 5px;">Your Name <span style="color: red;">*</span></label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 4px; outline: none;">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label for="email" style="display: block; font-size: 12px; color: #002e4d; margin-bottom: 5px;">Your Email <span style="color: red;">*</span></label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 4px; outline: none;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; color: #002e4d; margin-bottom: 5px;">Rating <span style="color: red;">*</span></label>
                    <div class="star-rating-input" style="color: #d1d5db; font-size: 24px; cursor: pointer;">
                        <span data-value="1">★</span><span data-value="2">★</span><span data-value="3">★</span><span data-value="4">★</span><span data-value="5">★</span>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="review_text" style="display: block; font-size: 12px; color: #002e4d; margin-bottom: 5px;">Your Review <span style="color: red;">*</span></label>
                    <textarea id="review_text" name="review_text" rows="5" required placeholder="Share your experience..." style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 4px; outline: none; resize: vertical;"></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; color: #002e4d; margin-bottom: 5px;">Upload Images (Optional)</label>
                    <input type="file" name="images[]" multiple accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 4px; outline: none; font-size: 13px;">
                </div>

                <button type="submit" style="background-color: #002e4d; color: white; border: none; padding: 12px 30px; font-weight: 600; cursor: pointer; border-radius: 4px; font-size: 14px;">SUBMIT REVIEW</button>
            </form>
        </div>

        @if($reviewCount > 0)
        <div class="reviews-list">
            <div class="reviews-list-header">
                <div style="font-weight: 600;">{{ $reviewCount }} Reviews</div>
            </div>
            
            @foreach($approvedReviews as $index => $review)
            <div class="review-item {{ $index >= 3 ? 'extra-review' : '' }}" style="border-bottom: 1px solid #f3f4f6; padding: 20px 0; {{ $index >= 3 ? 'display: none;' : '' }}">
                <div class="review-user-info" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <div class="review-user-left" style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #002e4d; font-size: 16px;">
                            {{ substr($review->name, 0, 1) }}
                        </div>
                        <div class="review-user-details">
                            <h4 style="margin: 0; font-size: 15px; font-weight: 600; color: #111827;">{{ $review->name }}</h4>
                            <div class="stars" style="color: #fbbf24; font-size: 14px;">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                        </div>
                    </div>
                    <div class="review-date" style="color: #9ca3af; font-size: 13px;">{{ $review->created_at->diffForHumans() }}</div>
                </div>
                <div class="review-text" style="color: #4b5563; line-height: 1.6; font-size: 14px; margin-bottom: 15px;">
                    {{ $review->review_text }}
                </div>
                @if($review->images->count() > 0)
                <div class="review-images" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @foreach($review->images as $image)
                        <img src="{{ asset($image->image_path) }}" alt="Review Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; cursor: pointer;" onclick="window.open(this.src, '_blank')">
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
            
            @if($reviewCount > 3)
            <div style="text-align: center; margin-top: 30px;">
                <button id="loadMoreReviewsBtn" onclick="loadMoreReviews()" style="background-color: transparent; border: 2px solid #000; color: #000; padding: 10px 30px; font-weight: 600; cursor: pointer; border-radius: 4px; font-size: 14px; transition: all 0.3s ease;">Read More</button>
            </div>
            <script>
                function loadMoreReviews() {
                    document.querySelectorAll('.extra-review').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.getElementById('loadMoreReviewsBtn').style.display = 'none';
                }
            </script>
            @endif
        </div>
        @endif
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating-input span');
            const ratingInput = document.getElementById('ratingInput');
            
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;
                    
                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.style.color = '#fbbf24';
                        } else {
                            s.style.color = '#d1d5db';
                        }
                    });
                });
            });
        });
    </script>

    @php
        $displayProducts = $product->relatedProducts;
        $sectionTitle = "Related Products";
        if ($displayProducts->count() == 0) {
            $displayProducts = \App\Models\Product::where('id', '!=', $product->id)->inRandomOrder()->take(4)->get();
            $sectionTitle = "Top Trending Products";
        }
    @endphp

    @if($displayProducts->count() > 0)
    <!-- Related / Trending Products -->
    <div class="trending-section">
        <h2 class="trending-title">{{ $sectionTitle }}</h2>
        <div class="product-grid">
            @foreach ($displayProducts as $dp)
            <div class="product-card-wrap" onclick="window.location.href='{{ route('product', $dp->id) }}'">
                <div class="image-container">
                    <img src="{{ asset($dp->image_path) }}" alt="{{ $dp->name }}" class="product-image" style="width: 100%; aspect-ratio: 3/4; object-fit: cover;">
                </div>
                <div class="product-title" style="margin-top: 10px; font-weight: 600; color: #111827;">{{ $dp->name }}</div>
                <div class="product-price" style="color: #4b5563;">
                    @if($dp->is_on_sale && $dp->sale_price)
                        <span style="text-decoration: line-through; margin-right: 8px;">Rs.{{ number_format($dp->price) }}</span>
                        <span style="color: #9b1c1c; font-weight: 600;">Rs.{{ number_format($dp->sale_price) }}</span>
                    @else
                        Rs.{{ number_format($dp->price) }}
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Cart Drawer Moved to global partial -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Accordions
        const accordions = document.querySelectorAll('.prod-accordion');
        accordions.forEach(acc => {
            acc.querySelector('.prod-accordion-header').addEventListener('click', () => {
                acc.classList.toggle('active');
            });
        });

        // AJAX Add to Cart Logic
        const btnAddToCart = document.getElementById('btnAddToCart');
        if(btnAddToCart) {
            btnAddToCart.addEventListener('click', function() {
                // Get selected size
                let size = 'Standard';
                const activeSizeBtn = document.querySelector('.size-btn.active');
                if (activeSizeBtn) {
                    size = activeSizeBtn.innerText;
                }

                // Get quantity
                let qty = 1;
                const qtyInput = document.querySelector('.qty-input');
                if (qtyInput) {
                    qty = parseInt(qtyInput.value) || 1;
                }

                const productId = {{ $product->id }};

                const originalText = btnAddToCart.innerText;
                btnAddToCart.innerText = 'Adding...';
                btnAddToCart.disabled = true;

                // AJAX Request
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        size: size,
                        quantity: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btnAddToCart.innerText = originalText;
                    btnAddToCart.disabled = false;
                    
                    if(data.success) {
                        // Update drawer HTML
                        const cartContent = document.getElementById('cartDrawerContent');
                        if (cartContent) {
                            cartContent.innerHTML = data.drawer_html;
                        }
                        // Open drawer
                        openCart();
                        
                        // Update cart badge if it exists
                        const cartBadge = document.getElementById('cart-badge');
                        if (cartBadge) {
                            cartBadge.innerText = data.cart_count;
                            cartBadge.style.display = 'flex';
                        }
                    } else {
                        alert('Error adding product to cart.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        }

        // Buy it Now Logic
        const btnBuyNow = document.querySelector('.btn-buy-now');
        if(btnBuyNow) {
            btnBuyNow.addEventListener('click', function() {
                let size = 'Standard';
                const activeSizeBtn = document.querySelector('.size-btn.active');
                if (activeSizeBtn) {
                    size = activeSizeBtn.innerText;
                }

                let qty = 1;
                const qtyInput = document.querySelector('.qty-input');
                if (qtyInput) {
                    qty = parseInt(qtyInput.value) || 1;
                }

                const productId = {{ $product->id }};

                const originalText = btnBuyNow.innerText;
                btnBuyNow.innerText = 'Processing...';
                btnBuyNow.disabled = true;

                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                        btnBuyNow.innerText = originalText;
                        btnBuyNow.disabled = false;
                        alert('Error adding product to cart.');
                    }
                })
                .catch(error => {
                    btnBuyNow.innerText = originalText;
                    btnBuyNow.disabled = false;
                    console.error('Error:', error);
                });
            });
        }

        // Size selection functionality
        const sizeBtns = document.querySelectorAll('.size-btn');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Update size text
                const sizeText = document.querySelector('.size-header div');
                sizeText.innerHTML = '<span style="font-weight: 600;">Size:</span> ' + this.innerText;
            });
        });

        // Thumbnail gallery functionality
        const thumbnails = document.querySelectorAll('.thumbnail-list img');
        const mainImg = document.querySelector('.main-image img');
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                mainImg.src = this.src;
            });
        });
    });
</script>

@include('includes.size-guide-modal')
@include('includes.footer')