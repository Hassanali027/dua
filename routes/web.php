<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/allcategories', [HomeController::class, 'allcategories'])->name('allcategories');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category')->where('slug', '.*');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');
Route::get('/about-us', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/cart/drawer', [\App\Http\Controllers\CartController::class, 'getDrawer'])->name('cart.drawer');
Route::get('/contact-us', [HomeController::class, 'contactus'])->name('contactus');
Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return.policy');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/shipping-policy', [HomeController::class, 'shippingPolicy'])->name('shipping.policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/faqs', [HomeController::class, 'faq'])->name('faqs');
Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
Route::post('/register', [HomeController::class, 'register'])->name('register');

// Search Route
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Account Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [HomeController::class, 'account'])->name('account');
    Route::post('/account/profile', [HomeController::class, 'updateProfile'])->name('account.profile.update');
    Route::post('/account/address', [HomeController::class, 'updateAddress'])->name('account.address.update');
    Route::post('/account/orders/{id}/cancel', [HomeController::class, 'cancelOrder'])->name('account.order.cancel');
});
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
Route::post('/product/{id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('product.review.store');
// Admin Routes
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    
    // Admin Profile & Password
    Route::get('/change-password', [\App\Http\Controllers\AdminController::class, 'changePasswordForm'])->name('admin.password.form');
    Route::post('/change-password', [\App\Http\Controllers\AdminController::class, 'updatePassword'])->name('admin.password.update');
    
    // Site Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
    
    // Topbar Routes
    Route::get('/topbar', [\App\Http\Controllers\Admin\TopbarController::class, 'index'])->name('admin.topbar.index');
    Route::post('/topbar', [\App\Http\Controllers\Admin\TopbarController::class, 'update'])->name('admin.topbar.update');

    // Navbar Routes
    Route::get('/navbar', [\App\Http\Controllers\Admin\NavbarController::class, 'index'])->name('admin.navbar.index');
    Route::post('/navbar', [\App\Http\Controllers\Admin\NavbarController::class, 'update'])->name('admin.navbar.update');

    // Slider & CTA Routes
    Route::get('/slider', [\App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.slider.index');
    Route::post('/slider', [\App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.slider.store');
    Route::post('/slider/cta', [\App\Http\Controllers\Admin\SliderController::class, 'updateCta'])->name('admin.cta.update');
    Route::post('/slider/bridal', [\App\Http\Controllers\Admin\SliderController::class, 'updateBridal'])->name('admin.bridal.update');
    Route::post('/slider/kids', [\App\Http\Controllers\Admin\SliderController::class, 'updateKids'])->name('admin.kids.update');
    Route::post('/slider/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/slider/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('admin.slider.destroy');

    // Footer Routes
    Route::get('/footer', [\App\Http\Controllers\Admin\FooterController::class, 'index'])->name('admin.footer.index');
    Route::post('/footer', [\App\Http\Controllers\Admin\FooterController::class, 'update'])->name('admin.footer.update');
    // Category Routes
    Route::get('/category', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/add', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/add', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Blog Posts
    Route::get('/blog', [\App\Http\Controllers\Admin\BlogPostController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog/create', [\App\Http\Controllers\Admin\BlogPostController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog', [\App\Http\Controllers\Admin\BlogPostController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/{id}/edit', [\App\Http\Controllers\Admin\BlogPostController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog/{id}', [\App\Http\Controllers\Admin\BlogPostController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blog/{id}', [\App\Http\Controllers\Admin\BlogPostController::class, 'destroy'])->name('admin.blog.destroy');

    // Static Pages
    Route::get('/pages', [\App\Http\Controllers\Admin\StaticPageController::class, 'index'])->name('admin.pages.index');
    Route::get('/pages/{id}/edit', [\App\Http\Controllers\Admin\StaticPageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/{id}', [\App\Http\Controllers\Admin\StaticPageController::class, 'update'])->name('admin.pages.update');

    // Customers
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{id}/edit', [\App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/customers/{id}', [\App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    // Product Routes
    Route::get('/product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/add', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/add', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::delete('/product/image/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyImage'])->name('admin.product.image.destroy');
    // Reviews Admin Routes
    Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::put('/review/{id}/approve', [\App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('/review/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // Order routes
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::delete('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Color Routes
    Route::get('/color', [\App\Http\Controllers\Admin\ColorController::class, 'index'])->name('admin.color.index');
    Route::get('/color/add', [\App\Http\Controllers\Admin\ColorController::class, 'create'])->name('admin.color.create');
    Route::post('/color/add', [\App\Http\Controllers\Admin\ColorController::class, 'store'])->name('admin.color.store');
    Route::delete('/color/{color}', [\App\Http\Controllers\Admin\ColorController::class, 'destroy'])->name('admin.color.destroy');
});

Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'dynamicSlug'])->name('dynamic.slug');