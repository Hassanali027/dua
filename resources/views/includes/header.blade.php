<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($meta_title))
        <title>{{ $meta_title }}</title>
    @else
        <title>{{ \App\Models\Setting::get('site_title', 'Dua Mehrama') }}</title>
    @endif
    
    @if(isset($meta_description))
        @if($meta_description !== '')
            <meta name="description" content="{{ $meta_description }}">
        @endif
    @elseif(\App\Models\Setting::get('site_description'))
        <meta name="description" content="{{ \App\Models\Setting::get('site_description') }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/dua-mehrama-favicon.png') }}">
    <style>
        html:not(.dm-page-ready) body {
            visibility: hidden;
        }
    </style>
    <noscript>
        <style>
            body {
                visibility: visible;
            }
        </style>
    </noscript>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            document.documentElement.classList.add('dm-page-ready');
        });
    </script>
</head>
<body>

<!-- Top Bar Section -->
<div class="top-bar">
    <div class="top-bar-center">
        <span>{{ \App\Models\Setting::get('topbar_text', 'Free Delivery on Orders Above Rs. 3000 ✨') }}</span>
    </div>
    
    <div class="top-bar-right mobile-hidden">
        <a href="{{ \App\Models\Setting::get('instagram_link', '#') }}" class="top-bar-link" target="_blank">Instagram</a>
        <span class="top-bar-divider">|</span>
        <a href="{{ \App\Models\Setting::get('facebook_link', '#') }}" class="top-bar-link" target="_blank">Facebook</a>
    </div>
</div>

<!-- Main Navbar Section -->
<div class="main-navbar">
    <div class="nav-left">
        <!-- Hamburger Icon (Mobile Only) -->
        <svg id="hamburgerBtn" class="hamburger-icon desktop-hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-right: 15px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-logo"><img src="{{ asset('images/dua-mehrama-logo.png') }}" alt="Dua Mehrama" style="height: 65px; object-fit: contain;"></a>
    </div>
    
    <div class="nav-center desktop-nav">
        @php
            $topLinksJson = \App\Models\Setting::get('navbar_top_links', '[]');
            $topLinks = json_decode($topLinksJson, true) ?? [];
        @endphp
        
        @foreach($topLinks as $link)
            <div class="nav-item-dropdown">
                <a href="{{ str_starts_with($link['url'], '/') ? url($link['url']) : $link['url'] }}" class="top-nav-link">{{ $link['label'] }}</a>
                
                @php
                    $category = null;
                    if(strpos($link['url'], '/category/') === 0) {
                        $slug = str_replace('/category/', '', $link['url']);
                        $category = \App\Models\Category::with(['children' => function($q) {
                            $q->where('status', 1);
                        }])->where('slug', $slug)->where('status', 1)->first();
                    }
                @endphp

                @if($category && $category->children->count() > 0)
                <div class="mega-menu">
                    @foreach($category->children as $child)
                        @if($child->children->count() > 0)
                            <div class="nested-dropdown">
                                <a href="{{ url('/category/' . $child->full_slug()) }}" class="mega-menu-item">
                                    <span>{{ $child->name }}</span>
                                    <svg class="nested-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                                <div class="nested-menu">
                                    @foreach($child->children as $grandchild)
                                        <a href="{{ url('/category/' . $grandchild->full_slug()) }}" class="mega-menu-item">
                                            <span>{{ $grandchild->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ url('/category/' . $child->full_slug()) }}" class="mega-menu-item">
                                <span>{{ $child->name }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
        @endforeach
    </div>
    
    <div class="nav-right">
        <!-- Search Icon -->
        <svg id="searchIconBtn" class="nav-icon mobile-hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        
        <!-- Cart Icon -->
        <div class="mobile-hidden" style="position: relative; display: flex; align-items: center; cursor: pointer;" onclick="if(typeof openCart === 'function') openCart();">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
            <span class="cart-badge" style="position: absolute; top: -8px; right: -8px; background: #9b1c1c; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 11px; display: {{ $cartCount > 0 ? 'flex' : 'none' }}; align-items: center; justify-content: center; font-weight: bold;">{{ $cartCount }}</span>
        </div>

        <!-- User Profile Icon -->
        <a href="{{ route('signin') }}" class="mobile-hidden" style="color: inherit; display: flex; align-items: center;">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </a>
    </div>
</div>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

@php
    $topLinksJson = \App\Models\Setting::get('navbar_top_links', '[]');
    $mainLinksJson = \App\Models\Setting::get('navbar_main_links', '[]');

    $topLinks = json_decode($topLinksJson, true) ?? [];
    $mainLinks = json_decode($mainLinksJson, true) ?? [];

    if (empty($topLinks) && \App\Models\Setting::where('key', 'navbar_top_links')->count() == 0) {
        $topLinks = [
            ['label' => 'Women', 'url' => '#'],
            ['label' => 'Kids', 'url' => '#'],
            ['label' => 'Brides', 'url' => '#'],
            ['label' => 'Summer Sale', 'url' => '#'],
            ['label' => 'Clearance', 'url' => '#']
        ];
    }

    if (empty($mainLinks) && \App\Models\Setting::where('key', 'navbar_main_links')->count() == 0) {
        $mainLinks = [
            ['label' => 'Mid Summer Sale', 'url' => '#'],
            ['label' => 'Clothing', 'url' => '#'],
            ['label' => 'Accessories', 'url' => '#']
        ];
    }
@endphp

<!-- Sidebar Menu -->
<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-logo"><img src="{{ asset('images/dua-mehrama-logo.png') }}" alt="Dua Mehrama" style="height: 24px; object-fit: contain;"></a>
        <button class="close-btn" id="closeSidebar">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    <div class="sidebar-top-nav">
        @foreach($topLinks as $link)
            <a href="{{ str_starts_with($link['url'], '/') ? url($link['url']) : $link['url'] }}" class="sidebar-top-link">{{ $link['label'] }}</a>
        @endforeach
    </div>
    
    <div class="sidebar-menu">
        @foreach($mainLinks as $link)
            <a href="{{ str_starts_with($link['url'], '/') ? url($link['url']) : $link['url'] }}" class="sidebar-menu-item">{{ $link['label'] }}</a>
        @endforeach
    </div>
</div>

<!-- Search Sidebar -->
<div class="search-sidebar-overlay" id="searchSidebarOverlay"></div>
<div class="search-sidebar" id="searchSidebar">
    <div class="search-sidebar-header">
        <h2>SEARCH YOUR FAVOURITE</h2>
        <button class="close-search" id="closeSearch">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="search-sidebar-content">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="q" id="searchInput" placeholder="Search" class="search-input" required>
            <button type="submit" class="search-submit">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>

        <div class="search-suggestions">
            @php
                $featuredProducts = \App\Models\Product::where('is_featured', 1)->take(5)->get();
                $bestSellingProducts = \App\Models\Product::where('is_best_selling', 1)->take(5)->get();
            @endphp

            @if($featuredProducts->count() > 0)
            <h3>FEATURED</h3>
            <ul>
                @foreach($featuredProducts as $product)
                <li><a href="{{ route('product', $product->id) }}">{{ $product->name }}</a></li>
                @endforeach
            </ul>
            @endif

            @if($bestSellingProducts->count() > 0)
            <h3 style="margin-top: 30px;">BEST SELLING</h3>
            <ul>
                @foreach($bestSellingProducts as $product)
                <li><a href="{{ route('product', $product->id) }}">{{ $product->name }}</a></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>

<style>
    .search-sidebar-overlay {
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
    .search-sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .search-sidebar {
        position: fixed;
        top: 0;
        right: -450px;
        width: 450px;
        height: 100%;
        background: #fff;
        z-index: 1001;
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
        font-family: 'Poppins', sans-serif;
    }
    @media (max-width: 480px) {
        .search-sidebar {
            width: 100%;
            right: -100%;
        }
    }
    .search-sidebar.active {
        right: 0;
    }
    .search-sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 40px;
    }
    .search-sidebar-header h2 {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        color: #000;
        letter-spacing: 0.5px;
    }
    .close-search {
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        padding: 5px;
        display: flex;
    }
    .close-search svg {
        width: 24px;
        height: 24px;
        stroke-width: 1.5;
    }
    .search-sidebar-content {
        padding: 0 40px;
    }
    .search-form {
        position: relative;
        margin-bottom: 40px;
    }
    .search-input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        font-size: 14px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background: transparent;
        color: #000;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    .search-input:focus {
        outline: none;
        border-color: #000;
    }
    .search-submit {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        padding: 0;
        display: flex;
    }
    .search-submit svg {
        width: 20px;
        height: 20px;
    }
    .search-suggestions h3 {
        font-size: 14px;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
        letter-spacing: 0.5px;
    }
    .search-suggestions ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .search-suggestions li {
        margin-bottom: 15px;
    }
    .search-suggestions a {
        color: #666;
        text-decoration: none;
        font-size: 13px;
        transition: color 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .search-suggestions a:hover {
        color: #000;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebarMenu');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        // Search overlay logic
        const searchIcon = document.getElementById('searchIconBtn');
        const searchSidebar = document.getElementById('searchSidebar');
        const searchSidebarOverlay = document.getElementById('searchSidebarOverlay');
        const closeSearch = document.getElementById('closeSearch');
        const searchInput = document.getElementById('searchInput');

        if(searchIcon && searchSidebar) {
            window.openSearchSidebar = function() {
                searchSidebar.classList.add('active');
                searchSidebarOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                setTimeout(() => searchInput.focus(), 300);
            };

            searchIcon.addEventListener('click', window.openSearchSidebar);
            
            function closeSearchSidebar() {
                searchSidebar.classList.remove('active');
                searchSidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            closeSearch.addEventListener('click', closeSearchSidebar);
            searchSidebarOverlay.addEventListener('click', closeSearchSidebar);
        }

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarMenu() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        hamburger.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebarMenu);
        overlay.addEventListener('click', closeSidebarMenu);
    });
</script>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav desktop-hidden">
    <a href="{{ route('home') }}" class="bottom-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Home</span>
    </a>
    
    <div class="bottom-nav-item" onclick="if(typeof window.openSearchSidebar === 'function') window.openSearchSidebar();">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span>Search</span>
    </div>
    
    <a href="{{ route('signin') }}" class="bottom-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span>Profile</span>
    </a>
    
    <div class="bottom-nav-item" onclick="if(typeof openCart === 'function') openCart();">
        <div style="position: relative;">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="cart-badge" style="position: absolute; top: -6px; right: -8px; background: #9b1c1c; color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 10px; display: {{ $cartCount > 0 ? 'flex' : 'none' }}; align-items: center; justify-content: center; font-weight: bold;">{{ $cartCount }}</span>
        </div>
        <span>My bag</span>
    </div>
</div>

@include('partials.cart-drawer')
 <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        /* Top Bar Styles */
        .top-bar {
            background-color: #1a1a1a;
            color: #FFFFFF;
            font-size: 14px;
            padding: 5px 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }
        
        .top-bar-center {
            text-align: center;
        }
        
        .top-bar-right {
            position: absolute;
            right: 46px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: #d1d5db;
        }
        
        .top-bar-link {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }
        
        .top-bar-link:hover {
            color: #ffffff;
        }
        
        .top-bar-divider {
            color: #6b7280;
        }

        /* Main Navbar Styles */
        .main-navbar {
            background-color: #f6f3eb;
            padding: 0px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .hamburger-icon {
            cursor: pointer;
            width: 24px;
            height: 24px;
            color: #1a1a1a;
            transition: opacity 0.2s;
        }

        .hamburger-icon:hover {
            opacity: 0.7;
        }

        .nav-center {
            text-align: center;
            flex: 2; /* give more space for links */
            display: flex;
            justify-content: center;
        }

        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .nav-item-dropdown {
            position: relative;
            padding: 20px 0;
        }

        .top-nav-link {
            color: #1a1a1a;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.2s;
            padding-bottom: 5px;
        }

        .top-nav-link:hover {
            color: #000;
        }

        .mega-menu {
            position: absolute;
            top: 100%;
            margin-top: 5px;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            min-width: 220px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            border-top: 2px solid #1a1a1a;
            border-radius: 0 0 6px 6px;
        }

        .mega-menu::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            right: 0;
            height: 15px;
        }

        .nav-item-dropdown:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .mega-menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #4b5563;
            transition: background 0.2s, color 0.2s, padding-left 0.2s;
            white-space: nowrap;
            padding: 12px 25px;
            text-align: left;
        }

        .mega-menu-item:hover {
            color: #1a1a1a;
            background-color: #f9fafb;
            padding-left: 30px;
        }

        .mega-menu-item span {
            font-size: 14px;
            font-weight: 500;
            line-height: 1.3;
        }

        .nested-dropdown {
            position: relative;
        }

        .nested-arrow {
            width: 14px;
            height: 14px;
            color: #9ca3af;
        }

        .nested-menu {
            position: absolute;
            top: 0;
            left: 100%;
            min-width: 200px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            transform: translateX(10px);
            border-radius: 4px;
            border: 1px solid #eee;
            z-index: 1001;
        }

        .nested-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: -10px;
            bottom: 0;
            width: 10px;
        }

        .nested-dropdown:hover .nested-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        .nested-dropdown:hover > .mega-menu-item {
            background-color: #f9fafb;
            color: #1a1a1a;
            padding-left: 30px;
        }

        @media (min-width: 769px) {
            .desktop-hidden {
                display: none !important;
            }
        }

        .brand-logo {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 1px;
            color: #000000;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 24px;
            flex: 1;
        }

        .nav-icon {
            cursor: pointer;
            width: 22px;
            height: 22px;
            color: #1a1a1a;
            transition: opacity 0.2s;
        }

        .nav-icon:hover {
            opacity: 0.7;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 998;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -480px;
            width: 450px;
            max-width: 90vw;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 999;
            transition: left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 30px 20px 30px;
        }

        .sidebar-logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 1px;
            color: #000;
            text-decoration: none;
        }

        .close-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #000;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn svg {
            width: 24px;
            height: 24px;
            stroke-width: 2;
        }

        .sidebar-top-nav {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 15px;
            padding: 0 30px 20px 30px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .sidebar-top-nav::-webkit-scrollbar {
            display: none;
        }

        .sidebar-top-link {
            color: #111;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .sidebar-menu {
            list-style: none;
            padding: 30px 30px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .sidebar-menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #222;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }

        .chevron-icon {
            width: 18px;
            height: 18px;
            color: #222;
        }

        @media (max-width: 768px) {
            .mobile-hidden {
                display: none !important;
            }
            .desktop-nav {
                display: none !important;
            }
            .brand-logo {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
            .brand-logo img {
                height: 45px !important;
            }
            .main-navbar {
                padding: 10px 20px;
                position: relative;
            }
            .nav-right {
                gap: 15px;
            }
            body {
                padding-bottom: 70px;
            }
        }

        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            z-index: 997;
            border-radius: 20px 20px 0 0;
        }
        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6b7280;
            text-decoration: none;
            font-size: 11px;
            gap: 4px;
            cursor: pointer;
            width: 60px;
        }
        .bottom-nav-item svg {
            width: 24px;
            height: 24px;
            color: #4b5563;
        }
        .bottom-nav-item.active {
            color: #1a1a1a;
        }
        .bottom-nav-item.active svg {
            color: #1a1a1a;
        }
        @media (min-width: 769px) {
            .mobile-bottom-nav {
                display: none !important;
            }
        }
    </style>
