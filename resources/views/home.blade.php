
    @include('includes.header')
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

     

        /* Hero Section Styles */
        .hero-section {
            position: relative;
            width: 100%;
            overflow: hidden;
            aspect-ratio: 21 / 9; /* Sleek, wide aspect ratio like MariaB */
            background-color: #000;
        }

        @media (max-width: 768px) {
            .hero-section {
                aspect-ratio: 21 / 9; /* Match desktop aspect ratio to prevent any side cropping */
            }
            .hero-image {
                object-fit: contain;
                object-position: center;
            }
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 20%; /* Keep focus on faces/top area */
            z-index: 1;
        }

        /* Gradient overlay to make text pop */
        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            z-index: 2;
        }

        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            z-index: 3;
            width: 100%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-shop-btn {
            position: absolute;
            top: 72%;
            right: 25%;
            transform: translateX(50%);
            background-color: #fae663;
            color: #000;
            padding: 14px 45px;
            font-weight: 700;
            text-decoration: none;
            border-radius: 30px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(250, 230, 99, 0.3);
        }

        .hero-shop-btn:hover {
            transform: translateX(50%) translateY(-3px);
            box-shadow: 0 6px 20px rgba(250, 230, 99, 0.5);
            background-color: #e5d254;
            color: #000;
        }

        @media (max-width: 768px) {
            .hero-shop-btn {
                top: auto;
                bottom: 25%;
                right: 50%;
                transform: translateX(50%);
                padding: 12px 35px;
                font-size: 14px;
            }
            .hero-shop-btn:hover {
                transform: translateX(50%) translateY(-3px);
            }
        }

        .hero-title {
            color: #ffffff;
            font-size: 32px;
            font-weight: 500;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .hero-pagination {
            position: absolute;
            bottom: 40px;
            right: 40px;
            display: flex;
            gap: 8px;
            z-index: 4;
        }

        .pagination-dash {
            width: 30px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-dash.active {
            width: 60px;
            background-color: #ffffff;
        }

        /* Category Section Styles */
        .category-section {
            padding: 60px 40px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
        }

        .category-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: #000;
        }

        .category-header a {
            font-size: 14px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        .category-carousel-wrapper {
            position: relative;
        }

        .category-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none; /* Firefox */
        }

        .category-carousel::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .category-card {
            position: relative;
            flex: 0 0 calc(33.333% - 14px);
            min-width: 280px;
            aspect-ratio: 4 / 5;
            scroll-snap-align: start;
            overflow: hidden;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.05);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px 20px;
            background: #D9D9D905;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: white;
            font-size: 16px;
            font-weight: 700;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            color: #333;
            transition: background-color 0.2s;
        }
        
        .carousel-btn:hover {
            background-color: #f9f9f9;
        }

        .carousel-btn.left {
            left: -20px;
        }

        .carousel-btn.right {
            right: -20px;
        }
        
        @media (max-width: 768px) {
            .category-card {
                flex: 0 0 calc(50% - 10px);
            }
            .category-section {
                padding: 40px 20px;
            }
            .carousel-btn {
                display: none;
            }
        }
        
        @media (max-width: 480px) {
            .category-card {
                flex: 0 0 85%;
            }
        }

        /* Product Section Styles */
        .product-section {
            padding: 0px 40px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .product-header-container {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
        }

        .product-header-container h2 {
            font-size: 32px;
            font-weight: 800;
            color: #000;
            margin-bottom: 8px;
        }

        .product-subtitle {
            font-size: 15px;
            color: #000;
        }

        .product-view-all {
            position: absolute;
            right: 0;
            bottom: 0;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        .product-card {
            flex: 0 0 calc(25% - 15px);
            min-width: 260px;
            scroll-snap-align: start;
            cursor: pointer;
        }

        .product-image-container {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 5;
            overflow: hidden;
            background-color: #f5f5f5;
            margin-bottom: 15px;
        }

        .product-info {
            padding: 0 5px;
        }

        .product-title {
            font-size: 14px;
            color: #000;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 14px;
            font-weight: 800;
            color: #000;
        }

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

        .product-card:hover .hover-eye {
            opacity: 1;
            transform: translateY(0);
        }

        .product-card:hover .hover-add-to-cart {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .product-card {
                flex: 0 0 calc(50% - 10px);
            }
            .product-view-all {
                position: static;
                display: block;
                text-align: right;
                margin-top: 15px;
            }
        }

        @media (max-width: 480px) {
            .product-card {
                flex: 0 0 85%;
            }
        }

        /* CTA Section */
        .cta-section {
            width: 100%;
            max-width: 1440px;
            margin: 40px auto;
            padding: 0;
        }

        .cta-image-container {
            width: 100%;
            display: block;
            position: relative;
            cursor: pointer;
            aspect-ratio: 1440 / 615;
            overflow: hidden;
        }

        .cta-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: opacity 0.3s;
        }

        .cta-image-container:hover img {
            opacity: 0.95;
        }

        /* New Arrival Section */
        .new-arrival-section {
            padding: 30px 40px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .new-arrival-info {
            flex: 0 0 25%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .new-arrival-info h2 {
            font-size: 32px;
            font-weight: 800;
            color: #000;
            margin-bottom: 10px;
        }

        .new-arrival-info p {
            font-size: 15px;
            color: #000;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .btn-beige {
            background-color: #e6d7c8;
            color: #000;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-beige:hover {
            background-color: #d4c3b3;
        }

        .new-arrival-carousel-wrapper {
            flex: 1;
            position: relative;
            min-width: 0;
        }

        .new-arrival-carousel-wrapper .product-card {
            flex: 0 0 calc(33.333% - 13.33px);
            min-width: 220px;
        }

        .badge-new {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #e6d7c8;
            color: #000;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
        }
        
        @media (max-width: 992px) {
            .new-arrival-section {
                flex-direction: column;
            }
            .new-arrival-info {
                width: 100%;
                text-align: center;
                align-items: center;
                margin-bottom: 30px;
            }
            .new-arrival-carousel-wrapper {
                width: 100%;
            }
        }

        /* Bridal & Kids Split Sections */
        .bridal-split-section {
            display: grid;
            grid-template-columns: 35% 1fr;
            gap: 40px;
            padding: 10px 40px 0px 40px;
            background-color: #fff;
        }

        .kids-split-section {
            display: grid;
            grid-template-columns: 35% 1fr;
            gap: 0px;
            padding: 0px 46px 10px 40px;
            background-color: #fff;
        }

        .bridal-split-img {
            width: 100%;
            aspect-ratio: 2 / 3;
        }
        .bridal-split-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .bridal-split-content {
            align-self: center;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .split-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
        }
        
        .split-header-row h2 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            color: #000;
        }
        
        .bridal-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 20px;
        }
        .bridal-carousel::-webkit-scrollbar { display: none; }
        
        .bridal-carousel .product-card {
            flex: 0 0 calc(33.333% - 13.33px);
            min-width: 220px;
        }
        
        .split-pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .split-pagination-dash {
            width: 30px;
            height: 4px;
            background-color: #eee;
            cursor: pointer;
        }
        .split-pagination-dash.active {
            background-color: #e6d7c8;
        }

        .kids-split-content {
            align-self: center;
            display: flex;
            flex-direction: column;
            padding-right: 20px;
        }
        
        .kids-split-content h2 {
            font-size: 36px;
            font-weight: 800;
            color: #1a1a1a;
            margin-top: 0;
            margin-bottom: 20px;
        }
        
        .kids-split-content p {
            font-size: 15px;
            line-height: 1.5;
            color: #000;
            margin-bottom: 30px;
        }
        
        .kids-split-img {
            width: 100%;
            position: relative;
            aspect-ratio: 16 / 9;
        }
        .kids-split-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .kids-overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: 12px;
            text-align: center;
            width: 100%;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }
        
        .kids-overlay-btn {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: white;
            color: black;
            padding: 10px 25px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
        }

        @media (max-width: 992px) {
            .bridal-split-section, .kids-split-section {
                display: flex;
                flex-direction: column;
                gap: 40px;
            }
            .bridal-split-content, .kids-split-content {
                align-self: stretch;
            }
            .kids-split-content {
                padding-right: 0;
            }
        }

        @media (max-width: 768px) {
            .bridal-split-section, .kids-split-section {
                padding: 40px 20px;
            }
            .bridal-carousel .product-card,
            .new-arrival-carousel-wrapper .product-card {
                flex: 0 0 calc(50% - 10px);
                min-width: 150px;
            }
            .split-header-row h2, .kids-split-content h2 {
                font-size: 24px;
            }
            .kids-overlay-text {
                font-size: 24px;
                letter-spacing: 6px;
            }
        }

        @media (max-width: 480px) {
            .bridal-carousel .product-card {
                flex: 0 0 85%;
            }
        }
    </style>

    <main>
        <!-- Hero Section -->
        <section class="hero-section" id="heroSlider">
            <h1 style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap;">Dua Mehrama – Premium Women & Girls' Fashion Brand in Pakistan</h1>
            @if(isset($sliders) && $sliders->count() > 0)
                @foreach($sliders as $index => $slider)
                    <div class="hero-slide {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset($slider->image_path) }}" alt="Slider Image" class="hero-image" style="object-position: center;">
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                        </div>
                    </div>
                @endforeach

                <div class="hero-pagination">
                    @foreach($sliders as $index => $slider)
                        <div class="pagination-dash {{ $index == 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                    @endforeach
                </div>
            @else
                <!-- Default Slide -->
                <div class="hero-slide active">
                    <img src="{{ asset('images/due-bride-hero.webp') }}" alt="Mono+Chrome Collection" class="hero-image">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                    </div>
                </div>
                
                <div class="hero-pagination">
                    <div class="pagination-dash active" data-slide="0"></div>
                </div>
            @endif
        </section>

        <!-- Shop By Category Section -->
        <section class="category-section">
            <div class="category-header">
                <h2>Shop By Category</h2>
                <a href="{{ route('allcategories') }}">View All</a>
            </div>
            
            <div class="category-carousel-wrapper">
                <button class="carousel-btn left" id="catBtnLeft">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <div class="category-carousel" id="catCarousel">
                    @if(isset($categories) && $categories->count() > 0)
                        @foreach($categories as $category)
                            <a href="{{ route('category', ['slug' => $category->full_slug() ?? $category->name]) }}" class="category-card" style="text-decoration: none; display: block;">
                                <img src="{{ asset($category->image_path) }}" alt="{{ $category->name }}" class="category-image">
                                <div class="category-overlay">{{ $category->name }}</div>
                            </a>
                        @endforeach
                    @else
                        <!-- Fallback if no categories -->
                        <a href="{{ route('category', ['slug' => 'ready-to-wear']) }}" class="category-card" style="text-decoration: none; display: block;">
                            <img src="{{ asset('images/category.png') }}" alt="Ready to Wear" class="category-image">
                            <div class="category-overlay">Ready to Wear</div>
                        </a>
                        <a href="{{ route('category', ['slug' => 'stitched']) }}" class="category-card" style="text-decoration: none; display: block;">
                            <img src="{{ asset('images/category.png') }}" alt="Stitched" class="category-image">
                            <div class="category-overlay">Stitched</div>
                        </a>
                        <a href="{{ route('category', ['slug' => 'party-wear']) }}" class="category-card" style="text-decoration: none; display: block;">
                            <img src="{{ asset('images/category.png') }}" alt="Party Wear" class="category-image">
                            <div class="category-overlay">Party Wear</div>
                        </a>
                        <a href="{{ route('category', ['slug' => 'unstitched']) }}" class="category-card" style="text-decoration: none; display: block;">
                            <img src="{{ asset('images/category.png') }}" alt="Unstitched" class="category-image">
                            <div class="category-overlay">Unstitched</div>
                        </a>
                    @endif
                </div>
                
                <button class="carousel-btn right" id="catBtnRight">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- Most In Demand Section -->
        <section class="product-section">
            <div class="product-header-container">
                <h2>Most In Demand</h2>
                <div class="product-subtitle">Quality you can feel in designs you'll use every day.</div>
                <a href="{{ url('most-in-demand') }}" class="product-view-all">View All</a>
            </div>
            
            <div class="category-carousel-wrapper">
                <button class="carousel-btn left" id="prodBtnLeft">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <div class="category-carousel" id="prodCarousel">
                    @forelse($mostInDemand as $product)
                    <a href="{{ route('product', $product->id) }}" class="product-card" style="text-decoration: none;">
                        <div class="product-image-container">
                            @if($product->quantity <= 0)
                                <div class="out-of-stock-badge">Out of Stock</div>
                            @endif
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="category-image">
                            <div class="hover-eye" onclick="event.preventDefault(); openQuickView({{ $product->id }});">
                                <span class="hover-eye-text">Quick view</span>
                                <img src="{{ asset('images/view.svg') }}" alt="View" style="width: 24px; height: 24px;">
                            </div>
                            @if($product->quantity > 0)
                                <div class="hover-add-to-cart" onclick="addToCartFromHome(event, {{ $product->id }})">Add to cart</div>
                            @else
                                <div class="hover-add-to-cart" style="background: rgba(200,0,0,0.7); cursor: not-allowed;" onclick="event.preventDefault(); event.stopPropagation();">Out of Stock</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">Rs.{{ number_format($product->price) }}</div>
                        </div>
                    </a>
                    @empty
                    <p style="padding: 20px;">No products assigned to Most In Demand yet.</p>
                    @endforelse
                </div>
                
                <button class="carousel-btn right" id="prodBtnRight">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- New Arrival Section -->
        <section class="new-arrival-section">
            <div class="new-arrival-info">
                <h2>New Arrival</h2>
                <p>Fresh styles just in discover the latest trends.</p>
                <a href="{{ url('new-arrivals') }}" class="btn-beige">View All</a>
            </div>
            
            <div class="new-arrival-carousel-wrapper">
                <button class="carousel-btn left" id="newBtnLeft">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <div class="category-carousel" id="newCarousel">
                    @forelse($newArrivals as $product)
                    <a href="{{ route('product', $product->id) }}" class="product-card" style="text-decoration: none;">
                        <div class="product-image-container">
                            @if($product->quantity <= 0)
                                <div class="out-of-stock-badge">Out of Stock</div>
                            @endif
                            <div class="badge-new">New</div>
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="category-image">
                            <div class="hover-eye" onclick="event.preventDefault(); openQuickView({{ $product->id }});">
                                <span class="hover-eye-text">Quick view</span>
                                <img src="{{ asset('images/view.svg') }}" alt="View" style="width: 24px; height: 24px;">
                            </div>
                            @if($product->quantity > 0)
                                <div class="hover-add-to-cart" onclick="addToCartFromHome(event, {{ $product->id }})">Add to cart</div>
                            @else
                                <div class="hover-add-to-cart" style="background: rgba(200,0,0,0.7); cursor: not-allowed;" onclick="event.preventDefault(); event.stopPropagation();">Out of Stock</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">Rs.{{ number_format($product->price) }}</div>
                        </div>
                    </a>
                    @empty
                    <p style="padding: 20px;">No products assigned to New Arrivals yet.</p>
                    @endforelse
                </div>
                
                <button class="carousel-btn right" id="newBtnRight">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </section>

        <!-- CTA Banner Section -->
        <section class="cta-section">
            <a href="{{ \App\Models\Setting::get('cta_link', '#') }}" class="cta-image-container">
                <img src="{{ asset(\App\Models\Setting::get('cta_image', 'images/Dua-mahrama-cta banner.webp')) }}" alt="Shop the latest collection">
            </a>
        </section>

        <!-- Bridal Split Section -->
        <section class="bridal-split-section">
            <div class="bridal-split-img">
                <img src="{{ asset(\App\Models\Setting::get('bridal_image', 'images/due-bride-hero.webp')) }}" alt="Bridal Wear">
            </div>
            <div class="bridal-split-content">
                <div class="split-header-row">
                    <h2>Bridal & Party Wear</h2>
                    <a href="{{ url('bridal-party-wear') }}" class="product-view-all" style="position:static;">View All</a>
                </div>
                
                <div class="bridal-carousel" id="bridalCarousel">
                    @forelse($bridalPartyWear as $product)
                    <a href="{{ route('product', $product->id) }}" class="product-card" style="text-decoration: none;">
                        <div class="product-image-container">
                            @if($product->quantity <= 0)
                                <div class="out-of-stock-badge">Out of Stock</div>
                            @endif
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="category-image">
                            <div class="hover-eye" onclick="event.preventDefault(); openQuickView({{ $product->id }});">
                                <span class="hover-eye-text">Quick view</span>
                                <img src="{{ asset('images/view.svg') }}" alt="View" style="width: 24px; height: 24px;">
                            </div>
                            @if($product->quantity > 0)
                                <div class="hover-add-to-cart" onclick="addToCartFromHome(event, {{ $product->id }})">Add to cart</div>
                            @else
                                <div class="hover-add-to-cart" style="background: rgba(200,0,0,0.7); cursor: not-allowed;" onclick="event.preventDefault(); event.stopPropagation();">Out of Stock</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">Rs.{{ number_format($product->price) }}</div>
                        </div>
                    </a>
                    @empty
                    <p style="padding: 20px;">No products assigned to Bridal & Party Wear yet.</p>
                    @endforelse
                </div>
                
                <div class="split-pagination bridal-pagination">
                    <div class="split-pagination-dash active" data-slide="0"></div>
                    <div class="split-pagination-dash" data-slide="1"></div>
                    <div class="split-pagination-dash" data-slide="2"></div>
                </div>
            </div>
        </section>

        <!-- Kids Split Section -->
        <section class="kids-split-section">
            <div class="kids-split-content">
                <h2>{{ \App\Models\Setting::get('kids_heading', 'Kidswear Collection') }}</h2>
                <p>{{ \App\Models\Setting::get('kids_desc', 'Soft fabrics, playful designs, and everyday comfort come together in our collection for every little adventure.') }}</p>
                <div class="split-pagination kids-pagination" style="justify-content: flex-start; margin-top:0; margin-bottom: 25px;">
                    <div class="split-pagination-dash active" data-slide="0"></div>
                    <div class="split-pagination-dash" data-slide="1"></div>
                    <div class="split-pagination-dash" data-slide="2"></div>
                    <div class="split-pagination-dash" data-slide="3"></div>
                </div>
                <div>
                    <a href="{{ \App\Models\Setting::get('kids_link', '#') }}" class="btn-beige">View All</a>
                </div>
            </div>
            <div class="kids-split-img" id="kidsImageSlider" style="position: relative; overflow: hidden;">
                @php
                    $kidsImages = [
                        \App\Models\Setting::get('kids_image_1', 'images/kidswear.png'),
                        \App\Models\Setting::get('kids_image_2', 'images/kidswear.png'),
                        \App\Models\Setting::get('kids_image_3', 'images/kidswear.png'),
                        \App\Models\Setting::get('kids_image_4', 'images/kidswear.png'),
                    ];
                @endphp

                @foreach($kidsImages as $index => $img)
                    <img src="{{ asset($img) }}" alt="Kidswear {{ $index + 1 }}" class="kids-slide {{ $index === 0 ? 'active' : '' }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: {{ $index === 0 ? '1' : '0' }}; transition: opacity 0.5s ease-in-out;">
                @endforeach
                
                <div class="kids-overlay-text" style="z-index: 2;">{{ \App\Models\Setting::get('kids_overlay_text', 'PROJECT MASTANI') }}</div>
                <a href="{{ \App\Models\Setting::get('kids_btn_link', '#') }}" class="kids-overlay-btn" style="z-index: 2;">{{ \App\Models\Setting::get('kids_btn_text', 'Party Wear') }}</a>
            </div>
        </section>
    </main>
    @include('includes.size-guide-modal')
@include('includes.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper function to hide/show buttons based on overflow
            function checkCarouselOverflow(carousel, btnLeft, btnRight) {
                if (!carousel || !btnLeft || !btnRight) return;
                
                // Add a small delay to ensure images/fonts are loaded and layout is calculated
                setTimeout(() => {
                    if (carousel.scrollWidth <= carousel.clientWidth) {
                        btnLeft.style.display = 'none';
                        btnRight.style.display = 'none';
                    } else {
                        btnLeft.style.display = 'flex';
                        btnRight.style.display = 'flex';
                    }
                }, 100);
            }

            // Category Carousel Logic
            const carousel = document.getElementById('catCarousel');
            const btnLeft = document.getElementById('catBtnLeft');
            const btnRight = document.getElementById('catBtnRight');

            if(btnLeft && btnRight && carousel) {
                btnLeft.addEventListener('click', () => {
                    carousel.scrollBy({ left: -320, behavior: 'smooth' });
                });

                btnRight.addEventListener('click', () => {
                    carousel.scrollBy({ left: 320, behavior: 'smooth' });
                });
                
                checkCarouselOverflow(carousel, btnLeft, btnRight);
            }

            // Product Carousel Logic
            const prodCarousel = document.getElementById('prodCarousel');
            const prodBtnLeft = document.getElementById('prodBtnLeft');
            const prodBtnRight = document.getElementById('prodBtnRight');

            if(prodBtnLeft && prodBtnRight && prodCarousel) {
                prodBtnLeft.addEventListener('click', () => {
                    prodCarousel.scrollBy({ left: -320, behavior: 'smooth' });
                });

                prodBtnRight.addEventListener('click', () => {
                    prodCarousel.scrollBy({ left: 320, behavior: 'smooth' });
                });
                
                checkCarouselOverflow(prodCarousel, prodBtnLeft, prodBtnRight);
            }

            // New Arrival Carousel Logic
            const newCarousel = document.getElementById('newCarousel');
            const newBtnLeft = document.getElementById('newBtnLeft');
            const newBtnRight = document.getElementById('newBtnRight');

            if(newBtnLeft && newBtnRight && newCarousel) {
                newBtnLeft.addEventListener('click', () => {
                    newCarousel.scrollBy({ left: -320, behavior: 'smooth' });
                });

                newBtnRight.addEventListener('click', () => {
                    newCarousel.scrollBy({ left: 320, behavior: 'smooth' });
                });
                
                checkCarouselOverflow(newCarousel, newBtnLeft, newBtnRight);
            }

            // Re-check on window resize
            window.addEventListener('resize', () => {
                checkCarouselOverflow(carousel, btnLeft, btnRight);
                checkCarouselOverflow(prodCarousel, prodBtnLeft, prodBtnRight);
                checkCarouselOverflow(newCarousel, newBtnLeft, newBtnRight);
            });

            // Hero Slider Logic
            const heroSlides = document.querySelectorAll('.hero-slide');
            const heroDashes = document.querySelectorAll('.hero-pagination .pagination-dash');
            let currentHeroSlide = 0;
            let heroInterval;

            function showHeroSlide(index) {
                if (heroSlides.length === 0) return;
                
                heroSlides.forEach(slide => slide.classList.remove('active'));
                heroDashes.forEach(dash => dash.classList.remove('active'));
                
                heroSlides[index].classList.add('active');
                if (heroDashes[index]) {
                    heroDashes[index].classList.add('active');
                }
                currentHeroSlide = index;
            }

            function nextHeroSlide() {
                if (heroSlides.length === 0) return;
                let next = (currentHeroSlide + 1) % heroSlides.length;
                showHeroSlide(next);
            }

            function startHeroSlider() {
                heroInterval = setInterval(nextHeroSlide, 5000); // 5 seconds
            }

            function resetHeroSlider() {
                clearInterval(heroInterval);
                startHeroSlider();
            }

            // Click on pagination dashes
            heroDashes.forEach((dash) => {
                dash.addEventListener('click', function() {
                    const slideIndex = parseInt(this.getAttribute('data-slide'));
                    showHeroSlide(slideIndex);
                    resetHeroSlider();
                });
            });

            // Start auto slide
            if(heroSlides.length > 0) {
                startHeroSlider();
            }
            // Kids Slider Logic
            const kidsSlides = document.querySelectorAll('.kids-slide');
            const kidsDashes = document.querySelectorAll('.kids-pagination .split-pagination-dash');
            let currentKidsSlide = 0;
            let kidsInterval;

            function showKidsSlide(index) {
                if (kidsSlides.length === 0) return;
                
                kidsSlides.forEach(slide => {
                    slide.classList.remove('active');
                    slide.style.opacity = '0';
                });
                kidsDashes.forEach(dash => dash.classList.remove('active'));
                
                kidsSlides[index].classList.add('active');
                kidsSlides[index].style.opacity = '1';
                if (kidsDashes[index]) {
                    kidsDashes[index].classList.add('active');
                }
                currentKidsSlide = index;
            }

            function nextKidsSlide() {
                if (kidsSlides.length === 0) return;
                let next = (currentKidsSlide + 1) % kidsSlides.length;
                showKidsSlide(next);
            }

            function startKidsSlider() {
                kidsInterval = setInterval(nextKidsSlide, 4000); // 4 seconds
            }

            function resetKidsSlider() {
                clearInterval(kidsInterval);
                startKidsSlider();
            }

            // Click on kids pagination dashes
            kidsDashes.forEach((dash) => {
                dash.addEventListener('click', function() {
                    const slideIndex = parseInt(this.getAttribute('data-slide'));
                    showKidsSlide(slideIndex);
                    resetKidsSlider();
                });
            });

            // Start kids auto slide
            if(kidsSlides.length > 0) {
                startKidsSlider();
            }

            // Bridal Carousel Logic
            const bridalCarousel = document.getElementById('bridalCarousel');
            const bridalDashes = document.querySelectorAll('.bridal-pagination .split-pagination-dash');
            
            if (bridalCarousel && bridalDashes.length > 0) {
                // Update active dash on scroll
                bridalCarousel.addEventListener('scroll', () => {
                    const scrollPos = bridalCarousel.scrollLeft;
                    const maxScroll = bridalCarousel.scrollWidth - bridalCarousel.clientWidth;
                    if (maxScroll <= 0) return;
                    
                    const progress = scrollPos / maxScroll;
                    let activeIndex = 0;
                    
                    if (progress > 0.8) activeIndex = 2;
                    else if (progress > 0.4) activeIndex = 1;
                    else activeIndex = 0;
                    
                    bridalDashes.forEach(d => d.classList.remove('active'));
                    bridalDashes[activeIndex].classList.add('active');
                });

                // Scroll on dash click
                bridalDashes.forEach((dash) => {
                    dash.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-slide'));
                        const maxScroll = bridalCarousel.scrollWidth - bridalCarousel.clientWidth;
                        
                        let targetScroll = 0;
                        if (index === 1) targetScroll = maxScroll / 2;
                        else if (index === 2) targetScroll = maxScroll;
                        
                        bridalCarousel.scrollTo({
                            left: targetScroll,
                            behavior: 'smooth'
                        });
                        
                        bridalDashes.forEach(d => d.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            }
        });
    </script>
    <!-- Quick View Modals -->
    @php
        $allProductsForModal = collect();
        if(isset($mostInDemand)) $allProductsForModal = $allProductsForModal->merge($mostInDemand);
        if(isset($newArrivals)) $allProductsForModal = $allProductsForModal->merge($newArrivals);
        if(isset($bridalPartyWear)) $allProductsForModal = $allProductsForModal->merge($bridalPartyWear);
        $allProductsForModal = $allProductsForModal->unique('id');
    @endphp

    <style>
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
        @foreach($allProductsForModal as $prod)
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
</body>
</html>