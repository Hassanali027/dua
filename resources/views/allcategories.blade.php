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

    .category-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .category-grid-item {
        position: relative;
        aspect-ratio: 4 / 5;
        overflow: hidden;
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .category-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-grid-item:hover img {
        transform: scale(1.05);
    }

    .category-grid-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 25px 20px;
        background: rgba(217, 217, 217, 0.05); /* Equivalent to #D9D9D905 */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: white;
        font-size: 16px;
        font-weight: 700;
        z-index: 2;
    }

    @media (max-width: 1024px) {
        .category-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .category-page-container {
            padding: 20px;
        }
        .category-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .page-title {
            font-size: 28px;
            margin-bottom: 30px;
        }
    }

    @media (max-width: 480px) {
        .category-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .category-grid-overlay {
            padding: 15px 10px;
            font-size: 13px;
        }
    }
</style>

<div class="category-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        <span>&rsaquo;</span>
        <span>Shop By Category</span>
    </div>

    <h1 class="page-title">Shop By Category</h1>

    <div class="category-grid">
        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $category)
                <a href="{{ route('category', ['slug' => $category->full_slug() ?? $category->name]) }}" class="category-grid-item" style="display: block; text-decoration: none;">
                    @if($category->image_path)
                        <img src="{{ asset($category->image_path) }}" alt="{{ $category->name }}">
                    @else
                        <img src="{{ asset('images/category.png') }}" alt="{{ $category->name }}">
                    @endif
                    <div class="category-grid-overlay">{{ $category->name }}</div>
                </a>
            @endforeach
        @else
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                No categories found.
            </div>
        @endif
    </div>
</div>

@include('includes.footer')