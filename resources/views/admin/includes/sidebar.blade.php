<style>
    .sidebar-menu {
        padding: 20px 0;
        list-style: none;
    }
    .sidebar-menu li {
        margin-bottom: 5px;
    }
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: #bbb;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }
    .sidebar-link svg {
        margin-right: 15px;
        width: 18px;
        height: 18px;
    }
    .sidebar-link:hover, .sidebar-link.active {
        background-color: rgba(220, 198, 182, 0.1);
        color: #dcc6b6; /* Theme accent color */
        border-left-color: #dcc6b6;
    }
</style>

<div class="admin-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('images/dua-mehrama-logo.png') }}" alt="Logo" style="height: 35px; filter: invert(1) brightness(100);">
    </a>
    
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.slider.index') }}" class="sidebar-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Home Page
            </a>
        </li>
        <li>
            <div class="sidebar-dropdown-toggle" onclick="toggleSidebarMenu(this)" style="padding: 12px 25px; color: #bbb; font-size: 14px; font-weight: 500; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                <div style="display: flex; align-items: center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 15px; width: 18px; height: 18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Category
                </div>
                <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; transition: transform 0.3s; transform: {{ request()->routeIs('admin.category.*') ? 'rotate(180deg)' : 'rotate(0)' }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <ul class="sidebar-submenu" style="list-style: none; padding-left: 25px; margin: 0; display: {{ request()->routeIs('admin.category.*') ? 'block' : 'none' }};">
                <li><a href="{{ route('admin.category.create') }}" class="sidebar-link {{ request()->routeIs('admin.category.create') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">Add Category</a></li>
                <li><a href="{{ route('admin.category.index') }}" class="sidebar-link {{ request()->routeIs('admin.category.index') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">View Category</a></li>
            </ul>
        </li>
        <li>
            <div class="sidebar-dropdown-toggle" onclick="toggleSidebarMenu(this)" style="padding: 12px 25px; color: #bbb; font-size: 14px; font-weight: 500; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                <div style="display: flex; align-items: center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 15px; width: 18px; height: 18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Products
                </div>
                <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; transition: transform 0.3s; transform: {{ request()->routeIs('admin.product.*') ? 'rotate(180deg)' : 'rotate(0)' }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <ul class="sidebar-submenu" style="list-style: none; padding-left: 25px; margin: 0; display: {{ request()->routeIs('admin.product.*') ? 'block' : 'none' }};">
                <li><a href="{{ route('admin.product.create') }}" class="sidebar-link {{ request()->routeIs('admin.product.create') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">Add Product</a></li>
                <li><a href="{{ route('admin.product.index') }}" class="sidebar-link {{ request()->routeIs('admin.product.index') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">View Products</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.reviews.index') }}" class="sidebar-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Reviews
            </a>
        </li>
        <li>
            <div class="sidebar-dropdown-toggle" onclick="toggleSidebarMenu(this)" style="padding: 12px 25px; color: #bbb; font-size: 14px; font-weight: 500; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                <div style="display: flex; align-items: center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 15px; width: 18px; height: 18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                    Colors
                </div>
                <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; transition: transform 0.3s; transform: {{ request()->routeIs('admin.color.*') ? 'rotate(180deg)' : 'rotate(0)' }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <ul class="sidebar-submenu" style="list-style: none; padding-left: 25px; margin: 0; display: {{ request()->routeIs('admin.color.*') ? 'block' : 'none' }};">
                <li><a href="{{ route('admin.color.create') }}" class="sidebar-link {{ request()->routeIs('admin.color.create') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">Add Color</a></li>
                <li><a href="{{ route('admin.color.index') }}" class="sidebar-link {{ request()->routeIs('admin.color.index') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">View Colors</a></li>
            </ul>
        </li>
        <li>
            <div class="sidebar-dropdown-toggle" onclick="toggleSidebarMenu(this)" style="padding: 12px 25px; color: #bbb; font-size: 14px; font-weight: 500; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                <div style="display: flex; align-items: center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 15px; width: 18px; height: 18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Blog
                </div>
                <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; transition: transform 0.3s; transform: {{ request()->routeIs('admin.blog.*') ? 'rotate(180deg)' : 'rotate(0)' }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <ul class="sidebar-submenu" style="list-style: none; padding-left: 25px; margin: 0; display: {{ request()->routeIs('admin.blog.*') ? 'block' : 'none' }};">
                <li><a href="{{ route('admin.blog.create') }}" class="sidebar-link {{ request()->routeIs('admin.blog.create') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">Add Blog</a></li>
                <li><a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog.index') ? 'active' : '' }}" style="padding: 8px 25px; font-size: 13px;">View Blogs</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Orders
            </a>
        </li>
        <li>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('admin.topbar.index') }}" class="sidebar-link {{ request()->routeIs('admin.topbar.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Topbar
            </a>
        </li>
        <li>
            <a href="{{ route('admin.navbar.index') }}" class="sidebar-link {{ request()->routeIs('admin.navbar.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                Navbar
            </a>
        </li>

        <li>
            <a href="{{ route('admin.footer.index') }}" class="sidebar-link {{ request()->routeIs('admin.footer.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Footer Settings
            </a>
        </li>
        <li>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Site Settings
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Static Pages
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank" style="margin-top: 20px;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Visit Store
            </a>
        </li>
    </ul>
</div>

<script>
    function toggleSidebarMenu(element) {
        var submenu = element.nextElementSibling;
        var arrow = element.querySelector('.dropdown-arrow');
        
        if (submenu.style.display === "none") {
            submenu.style.display = "block";
            arrow.style.transform = "rotate(180deg)";
        } else {
            submenu.style.display = "none";
            arrow.style.transform = "rotate(0)";
        }
    }
</script>
