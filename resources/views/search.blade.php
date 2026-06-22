@include('includes.header')

<style>
    .search-page-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 40px;
        font-family: 'Poppins', sans-serif;
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

    .page-title {
        text-align: center;
        font-size: 36px;
        font-weight: 800;
        color: #000;
        margin-bottom: 20px;
    }

    .search-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 50px;
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

    .product-card-wrap .product-image {
        width: 100%;
        aspect-ratio: 4 / 5;
        object-fit: cover;
        background-color: #f5f5f5;
        margin-bottom: 15px;
        transition: transform 0.5s ease;
    }

    .product-card-wrap:hover .product-image {
        transform: scale(1.03);
    }

    .product-card-wrap .image-container {
        position: relative;
        overflow: hidden;
        margin-bottom: 0px;
    }

    .hover-eye {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50px;
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
    
    .out-of-stock-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #dc2626;
        color: white;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        z-index: 5;
        letter-spacing: 0.5px;
    }
    
    .product-card-wrap:hover .hover-add-to-cart {
        opacity: 1;
        transform: translateY(0);
    }

    .product-card-wrap .product-title {
        font-size: 13px;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .product-card-wrap .product-price {
        font-size: 14px;
        font-weight: 800;
        color: #000;
    }

    @media (max-width: 1024px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .search-page-container {
            padding: 20px;
        }
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .page-title {
            font-size: 28px;
            margin-bottom: 10px;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 10px;
        }
    }
</style>

<div class="search-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        <span>&rsaquo;</span>
        <span>Search Results</span>
    </div>

    <h1 class="page-title">Search Results</h1>
    <div class="search-subtitle">
        @if($query)
            Showing results for <strong>"{{ $query }}"</strong>
        @else
            No search query provided.
        @endif
    </div>

    <div class="product-grid">
        @if($products->count() > 0)
            @foreach($products as $product)
            <div class="product-card-wrap" onclick="window.location.href='{{ route('product', ['id' => $product->id]) }}'">
                <div class="image-container">
                    @if($product->quantity <= 0)
                        <div class="out-of-stock-badge">Out of Stock</div>
                    @endif
                    @if($product->image_path)
                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <img src="{{ asset('images/product.png') }}" alt="{{ $product->name }}" class="product-image">
                    @endif
                    <div class="hover-eye" onclick="event.preventDefault(); event.stopPropagation(); openQuickView({{ $product->id }});">
                        <span class="hover-eye-text">Quick view</span>
                        <img src="{{ asset('images/view.svg') }}" alt="View" style="width: 24px; height: 24px;">
                    </div>
                    @if($product->quantity > 0)
                        <div class="hover-add-to-cart" onclick="event.stopPropagation(); addToCartFromHome(event, {{ $product->id }})">Add to cart</div>
                    @else
                        <div class="hover-add-to-cart" style="background: rgba(200,0,0,0.7); cursor: not-allowed;" onclick="event.preventDefault(); event.stopPropagation();">Out of Stock</div>
                    @endif
                </div>
                <div class="product-title">{{ $product->name }}</div>
                <div class="product-price">Rs.{{ number_format($product->price) }}</div>
            </div>
            @endforeach
        @else
            @if($query)
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 0; background: #fafafa; border-radius: 8px;">
                    <svg style="width: 48px; height: 48px; color: #ccc; margin-bottom: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 10px;">No products found</h3>
                    <p style="color: #666;">We couldn't find anything matching "{{ $query }}". Please try searching with different keywords.</p>
                </div>
            @endif
        @endif
    </div>
</div>

@include('includes.quickview', ['modalProducts' => $products])
@include('includes.footer')
