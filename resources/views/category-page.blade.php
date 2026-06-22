@include('includes.header')

<style>
    .category-page-container {
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

    .breadcrumb svg {
        width: 16px;
        height: 16px;
    }

    .page-title {
        text-align: center;
        font-size: 36px;
        font-weight: 800;
        color: #000;
        margin-bottom: 50px;
    }

    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .filter-left {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #000;
        cursor: pointer;
    }

    .filter-left svg {
        width: 20px;
        height: 20px;
    }

    .filter-right {
        position: relative;
        font-size: 14px;
        font-weight: 600;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .sort-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 10px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 4px;
        width: max-content;
        min-width: 180px;
        z-index: 100;
        display: none;
        flex-direction: column;
        padding: 10px 0;
        border: 1px solid #eee;
    }
    
    .sort-dropdown-menu.active {
        display: flex;
    }
    
    .sort-option {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 400;
        color: #333;
        transition: background 0.2s ease;
    }
    
    .sort-option:hover {
        background: #f5f5f5;
        color: #000;
    }

    .active-filters {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 13px;
        color: #333;
        background: #fff;
    }

    .filter-tag span {
        cursor: pointer;
        color: #999;
    }

    .filter-tag span:hover {
        color: #000;
    }

    .remove-all {
        font-size: 13px;
        color: #000;
        text-decoration: underline;
        cursor: pointer;
        font-weight: 600;
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
        .category-page-container {
            padding: 20px;
        }
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .page-title {
            font-size: 28px;
            margin-bottom: 30px;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 10px;
        }
    }

    /* Filter Sidebar Styles */
    .filter-sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .filter-sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .filter-sidebar {
        position: fixed;
        top: 0;
        left: -350px;
        width: 350px;
        height: 100%;
        background: #fff;
        z-index: 1001;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: left 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    @media (max-width: 480px) {
        .filter-sidebar {
            width: 85%;
            left: -85%;
        }
    }
    .filter-sidebar.active {
        left: 0;
    }
    .filter-sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }
    .filter-sidebar-header h2 {
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        color: #000;
    }
    .close-sidebar {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #000;
    }
    .filter-sidebar-content {
        padding: 0 20px 20px 20px;
        overflow-y: auto;
        flex: 1;
    }
    .accordion-item {
        padding: 15px 0;
    }
    .accordion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        cursor: pointer;
        font-size: 16px;
        color: #000;
    }
    .accordion-icon {
        transition: transform 0.3s ease;
        display: flex;
    }
    .accordion-item.active .accordion-icon {
        transform: rotate(180deg);
    }
    .accordion-body {
        padding-top: 15px;
        display: none;
        flex-direction: column;
        gap: 15px;
    }
    .accordion-item.active .accordion-body {
        display: flex;
    }
    .accordion-body label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        cursor: pointer;
        color: #333;
    }
    .accordion-body input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #000;
    }
    .color-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: inline-block;
    }
    .color-dot.white { background: #fff; border: 1px solid #ddd; }
    .color-dot.black { background: #000; }
    .color-dot.red { background: red; }
    .color-dot.blue { background: blue; }
    .price-range {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        margin-bottom: 5px;
        color: #000;
        font-weight: 600;
    }
    .slider-container {
        position: relative;
        width: 100%;
        height: 4px;
        background: #ddd;
        border-radius: 2px;
        margin: 15px 0;
    }
    .slider-track {
        position: absolute;
        height: 100%;
        background: #000;
        width: 100%;
        border-radius: 2px;
    }
    .slider-thumb {
        position: absolute;
        width: 16px;
        height: 16px;
        background: #000;
        border-radius: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
    }
    .slider-thumb.left { left: 0%; }
    .slider-thumb.right { left: 100%; }
    
    .price-inputs {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    .price-input-group {
        flex: 1;
        position: relative;
    }
    .price-input-group label {
        position: absolute;
        top: -8px;
        left: 10px;
        background: #fff;
        padding: 0 5px;
        font-size: 11px;
        color: #666;
    }
    .price-input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
        box-sizing: border-box;
    }

    .slider-container input[type="range"] {
        position: absolute;
        width: 100%;
        height: 4px;
        top: 0;
        left: 0;
        appearance: none;
        -webkit-appearance: none;
        pointer-events: none;
        background: transparent;
        z-index: 5;
        margin: 0;
    }
    .slider-container input[type="range"]::-webkit-slider-thumb {
        pointer-events: auto;
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: transparent;
        cursor: pointer;
    }
    .slider-container input[type="range"]::-moz-range-thumb {
        pointer-events: auto;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: transparent;
        cursor: pointer;
        border: none;
    }
</style>

<div class="category-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        @if($category->parent)
            <span>&rsaquo;</span>
            <a href="{{ route('category', $category->parent->full_slug()) }}">{{ $category->parent->name }}</a>
        @endif
        <span>&rsaquo;</span>
        <span>{{ $category->name }}</span>
    </div>

    <h1 class="page-title">{{ $category->name }}</h1>

    <div class="filter-bar">
        <div class="filter-left">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
            Filters
        </div>
        <div class="filter-right" id="sortDropdownBtn">
            Sort
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            <div class="sort-dropdown-menu" id="sortDropdownMenu">
                <div class="sort-option" data-sort="featured">Featured</div>
                <div class="sort-option" data-sort="best_selling">Best selling</div>
                <div class="sort-option" data-sort="alpha_asc">Alphabetically, A-Z</div>
                <div class="sort-option" data-sort="alpha_desc">Alphabetically, Z-A</div>
                <div class="sort-option" data-sort="price_low">Price, low to high</div>
                <div class="sort-option" data-sort="price_high">Price, high to low</div>
                <div class="sort-option" data-sort="date_old">Date, old to new</div>
                <div class="sort-option" data-sort="date_new">Date, new to old</div>
            </div>
        </div>
    </div>

    <div class="active-filters" style="display: none;">
        <div class="filter-tag">Size: Large <span>&times;</span></div>
        <div class="filter-tag">Color: Black <span>&times;</span></div>
        <div class="remove-all">Remove all</div>
    </div>

    <div class="product-grid">
        <!-- Products -->
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
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                <p>No products found in this category.</p>
            </div>
        @endif
    </div>
</div>

<!-- Filter Sidebar Drawer -->
<div class="filter-sidebar-overlay" id="filterSidebarOverlay"></div>
<div class="filter-sidebar" id="filterSidebar">
    <div class="filter-sidebar-header">
        <h2>Filters</h2>
        <button class="close-sidebar" id="closeFilterSidebar">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <div class="filter-sidebar-content">
        @if($category->children->count() > 0 || $category->parent_id)
            <div class="accordion-item" style="border-bottom: 1px solid #eee;">
                <div class="accordion-header" style="font-weight: 700;">Categories <span class="accordion-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span></div>
                <div class="accordion-body" style="padding-bottom: 15px;">
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                        @if($category->parent)
                            <li><a href="{{ route('category', $category->parent->full_slug()) }}" style="color: #4b5563; text-decoration: none; font-weight: 600;">&larr; Back to {{ $category->parent->name }}</a></li>
                            @foreach($category->parent->children as $sibling)
                                <li>
                                    <a href="{{ route('category', $sibling->full_slug()) }}" style="color: {{ $sibling->id == $category->id ? '#1a1a1a; font-weight: 700;' : '#4b5563;' }} text-decoration: none; padding-left: 15px;">
                                        {{ $sibling->name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('category', $category->full_slug()) }}" style="color: #1a1a1a; font-weight: 700; text-decoration: none;">{{ $category->name }}</a></li>
                            @foreach($category->children as $child)
                                <li>
                                    <a href="{{ route('category', $child->full_slug()) }}" style="color: #4b5563; text-decoration: none; padding-left: 15px;">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        @endif

        <form method="GET" action="{{ url()->current() }}" id="filterForm">
            <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
            <!-- Size -->
            <div class="accordion-item">
                <div class="accordion-header">Size <span class="accordion-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span></div>
                <div class="accordion-body">
                    @php $reqSizes = request('sizes', []); @endphp
                    <label><input type="checkbox" name="sizes[]" value="Small" {{ in_array('Small', $reqSizes) ? 'checked' : '' }}> Small</label>
                    <label><input type="checkbox" name="sizes[]" value="Medium" {{ in_array('Medium', $reqSizes) ? 'checked' : '' }}> Medium</label>
                    <label><input type="checkbox" name="sizes[]" value="Large" {{ in_array('Large', $reqSizes) ? 'checked' : '' }}> Large</label>
                    <label><input type="checkbox" name="sizes[]" value="X Large" {{ in_array('X Large', $reqSizes) ? 'checked' : '' }}> X Large</label>
                </div>
            </div>
            <!-- Price -->
            <div class="accordion-item">
                <div class="accordion-header">Price <span class="accordion-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span></div>
                <div class="accordion-body">
                    <div class="price-range">
                        <span>0</span><span>Rs.10000</span>
                    </div>
                    <div class="slider-container">
                        <div class="slider-track" id="sliderTrack"></div>
                        <div class="slider-thumb left" id="sliderThumbLeft"></div>
                        <div class="slider-thumb right" id="sliderThumbRight"></div>
                        <input type="range" id="rangeMin" min="0" max="10000" value="{{ request('min_price', 0) }}" step="100">
                        <input type="range" id="rangeMax" min="0" max="10000" value="{{ request('max_price', 10000) }}" step="100">
                    </div>
                    <div class="price-inputs">
                        <div class="price-input-group">
                            <label>From</label>
                            <input type="number" id="inputMin" name="min_price" placeholder="0" value="{{ request('min_price') }}">
                        </div>
                        <div class="price-input-group">
                            <label>To</label>
                            <input type="number" id="inputMax" name="max_price" placeholder="10000" value="{{ request('max_price') }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Color -->
            <div class="accordion-item">
                <div class="accordion-header">Color <span class="accordion-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span></div>
                <div class="accordion-body">
                    @php $reqColors = request('colors', []); @endphp
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 12px;"><input type="checkbox" name="colors[]" value="White" style="display: none;" {{ in_array('White', $reqColors) ? 'checked' : '' }}> <span class="color-dot white" style="{{ in_array('White', $reqColors) ? 'box-shadow: 0 0 0 2px #000;' : '' }}"></span> White</label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 12px;"><input type="checkbox" name="colors[]" value="Black" style="display: none;" {{ in_array('Black', $reqColors) ? 'checked' : '' }}> <span class="color-dot black" style="{{ in_array('Black', $reqColors) ? 'box-shadow: 0 0 0 2px #aaa;' : '' }}"></span> Black</label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 12px;"><input type="checkbox" name="colors[]" value="Red" style="display: none;" {{ in_array('Red', $reqColors) ? 'checked' : '' }}> <span class="color-dot red" style="{{ in_array('Red', $reqColors) ? 'box-shadow: 0 0 0 2px #000;' : '' }}"></span> Red</label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 12px;"><input type="checkbox" name="colors[]" value="Blue" style="display: none;" {{ in_array('Blue', $reqColors) ? 'checked' : '' }}> <span class="color-dot blue" style="{{ in_array('Blue', $reqColors) ? 'box-shadow: 0 0 0 2px #000;' : '' }}"></span> Blue</label>
                </div>
            </div>
            <!-- Season -->
            <div class="accordion-item">
                <div class="accordion-header">Season <span class="accordion-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></span></div>
                <div class="accordion-body">
                    @php $reqSeasons = request('seasons', []); @endphp
                    <label><input type="checkbox" name="seasons[]" value="Summer" {{ in_array('Summer', $reqSeasons) ? 'checked' : '' }}> Summer</label>
                    <label><input type="checkbox" name="seasons[]" value="Winter" {{ in_array('Winter', $reqSeasons) ? 'checked' : '' }}> Winter</label>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtn = document.querySelector('.filter-left');
        const sidebar = document.getElementById('filterSidebar');
        const overlay = document.getElementById('filterSidebarOverlay');
        const closeBtn = document.getElementById('closeFilterSidebar');

        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if(filterBtn) filterBtn.addEventListener('click', openSidebar);
        if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if(overlay) overlay.addEventListener('click', closeSidebar);

        // Accordion logic
        const accordions = document.querySelectorAll('.accordion-header');
        accordions.forEach(acc => {
            acc.addEventListener('click', function() {
                this.parentElement.classList.toggle('active');
            });
        });

        // Sort Dropdown logic
        const sortBtn = document.getElementById('sortDropdownBtn');
        const sortMenu = document.getElementById('sortDropdownMenu');
        const sortOptions = document.querySelectorAll('.sort-option');
        const sortInput = document.getElementById('sortInput');

        if(sortBtn && sortMenu) {
            sortBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sortMenu.classList.toggle('active');
            });

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!sortBtn.contains(e.target)) {
                    sortMenu.classList.remove('active');
                }
            });

            sortOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const val = this.getAttribute('data-sort');
                    if (val) {
                        sortInput.value = val;
                        document.getElementById('filterForm').submit();
                    }
                });
            });
        }

        // Auto-submit filter form
        const filterForm = document.getElementById('filterForm');
        if (filterForm) {
            const inputs = filterForm.querySelectorAll('input[type="checkbox"]');
            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    filterForm.submit();
                });
            });

            // Range slider logic
            const rangeMin = document.getElementById('rangeMin');
            const rangeMax = document.getElementById('rangeMax');
            const inputMin = document.getElementById('inputMin');
            const inputMax = document.getElementById('inputMax');
            const sliderTrack = document.getElementById('sliderTrack');
            const thumbLeft = document.getElementById('sliderThumbLeft');
            const thumbRight = document.getElementById('sliderThumbRight');
            const maxVal = parseInt(rangeMin.max);

            function updateSliderVisuals() {
                let min = parseInt(rangeMin.value);
                let max = parseInt(rangeMax.value);
                if (min > max) { let temp = min; min = max; max = temp; }
                
                const minPercent = (min / maxVal) * 100;
                const maxPercent = (max / maxVal) * 100;
                
                sliderTrack.style.left = minPercent + '%';
                sliderTrack.style.width = (maxPercent - minPercent) + '%';
                
                thumbLeft.style.left = minPercent + '%';
                thumbRight.style.left = maxPercent + '%';
            }

            if(rangeMin && rangeMax) {
                rangeMin.addEventListener('input', function() {
                    let min = parseInt(rangeMin.value);
                    let max = parseInt(rangeMax.value);
                    if (min > max) { rangeMin.value = max; min = max; }
                    inputMin.value = min;
                    updateSliderVisuals();
                });

                rangeMax.addEventListener('input', function() {
                    let min = parseInt(rangeMin.value);
                    let max = parseInt(rangeMax.value);
                    if (max < min) { rangeMax.value = min; max = min; }
                    inputMax.value = max;
                    updateSliderVisuals();
                });

                // Bring range input to front on hover so they don't block each other when overlapping
                rangeMin.addEventListener('mouseover', function() { rangeMin.style.zIndex = 6; rangeMax.style.zIndex = 5; });
                rangeMax.addEventListener('mouseover', function() { rangeMax.style.zIndex = 6; rangeMin.style.zIndex = 5; });
                
                inputMin.addEventListener('input', function() {
                    let val = parseInt(inputMin.value) || 0;
                    rangeMin.value = val;
                    updateSliderVisuals();
                });

                inputMax.addEventListener('input', function() {
                    let val = parseInt(inputMax.value) || parseInt(rangeMax.max);
                    rangeMax.value = val;
                    updateSliderVisuals();
                });

                // Submit form when finished dragging or typing
                [rangeMin, rangeMax, inputMin, inputMax].forEach(el => {
                    el.addEventListener('change', () => {
                        filterForm.submit();
                    });
                });

                // Initial setup
                if(!inputMin.value) rangeMin.value = 0;
                if(!inputMax.value) rangeMax.value = maxVal;
                updateSliderVisuals();
            }
        }
    });
</script>

@include('includes.quickview', ['modalProducts' => $products])

@include('includes.size-guide-modal')
@include('includes.footer')
