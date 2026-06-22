<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::orderBy('order', 'asc')->get();
        $categories = \App\Models\Category::where('status', 1)->orWhere('status', 'active')->get();
        
        $mostInDemand = \App\Models\Product::where('is_most_in_demand', true)
            ->orWhereHas('categories', function($q) {
                $q->where('slug', 'most-in-demand')->orWhere('name', 'like', '%Most In Demand%');
            })
            ->latest()->get();

        $newArrivals = \App\Models\Product::where('is_new_arrival', true)
            ->orWhereHas('categories', function($q) {
                $q->where('slug', 'new-arrivals')->orWhere('slug', 'new-arrival')->orWhere('name', 'like', '%New Arrival%');
            })
            ->latest()->get();

        $bridalPartyWear = \App\Models\Product::where('is_bridal_party_wear', true)
            ->orWhereHas('categories', function($q) {
                $q->where('slug', 'bridal-party-wear')->orWhere('slug', 'bridal-cloth')->orWhere('name', 'like', '%Bridal%');
            })
            ->latest()->get();

        return view('home', compact('sliders', 'categories', 'mostInDemand', 'newArrivals', 'bridalPartyWear'));
    }

    public function allcategories()
    {
        $categories = \App\Models\Category::where('status', 1)->get();
        $meta_title = 'All Categories';
        $meta_description = '';
        return view('allcategories', compact('categories', 'meta_title', 'meta_description'));
    }

    public function category(Request $request, $slug)
    {
        $slugParts = explode('/', $slug);
        $actualSlug = end($slugParts);

        $category = \App\Models\Category::where('slug', $actualSlug)->orWhere('name', $actualSlug)->firstOrFail();
        $childIds = $category->children()->pluck('id')->toArray();
        $allCategoryIds = array_merge([$category->id], $childIds);

        $query = \App\Models\Product::whereHas('categories', function($q) use ($allCategoryIds) {
            $q->whereIn('categories.id', $allCategoryIds);
        });

        // Apply filters
        if ($request->has('sizes') && is_array($request->sizes)) {
            $query->where(function($q) use ($request) {
                foreach($request->sizes as $size) {
                    $q->orWhere('size', 'like', "%$size%");
                }
            });
        }
        if ($request->has('colors') && is_array($request->colors)) {
            $query->where(function($q) use ($request) {
                foreach($request->colors as $color) {
                    $q->orWhere('color', 'like', "%$color%");
                }
            });
        }
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', (float) $request->max_price);
        }
        if ($request->has('seasons') && is_array($request->seasons)) {
            $query->where(function($q) use ($request) {
                foreach($request->seasons as $season) {
                    $q->orWhere('season', 'like', "%$season%");
                }
            });
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'alpha_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'alpha_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($request->sort == 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'date_old') {
                $query->orderBy('created_at', 'asc');
            } elseif ($request->sort == 'date_new') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'best_selling') {
                $query->orderBy('is_best_selling', 'desc')->latest();
            } elseif ($request->sort == 'featured') {
                $query->orderBy('is_featured', 'desc')->latest();
            } else {
                $query->latest(); // Default
            }
        } else {
            $query->latest(); // Default sorting
        }

        $products = $query->get();
        
        $meta_title = $category->meta_title ?: $category->name;
        $meta_description = $category->meta_description ?: '';
        
        return view('Category-page', compact('category', 'products', 'meta_title', 'meta_description'));
    }

    public function dynamicSlug(Request $request, $slug)
    {
        $query = \App\Models\Product::query();

        // Check for specific collections
        if ($slug == 'most-in-demand') {
            $query->where(function($q) {
                $q->where('is_most_in_demand', true)
                  ->orWhereHas('categories', function($q2) {
                      $q2->where('slug', 'most-in-demand')->orWhere('name', 'like', '%Most In Demand%');
                  });
            });
            $category = (object)['name' => 'Most In Demand'];
        } elseif ($slug == 'new-arrivals') {
            $query->where(function($q) {
                $q->where('is_new_arrival', true)
                  ->orWhereHas('categories', function($q2) {
                      $q2->where('slug', 'new-arrivals')->orWhere('slug', 'new-arrival')->orWhere('name', 'like', '%New Arrival%');
                  });
            });
            $category = (object)['name' => 'New Arrivals'];
        } elseif ($slug == 'bridal-party-wear') {
            $query->where(function($q) {
                $q->where('is_bridal_party_wear', true)
                  ->orWhereHas('categories', function($q2) {
                      $q2->where('slug', 'bridal-party-wear')->orWhere('slug', 'bridal-cloth')->orWhere('name', 'like', '%Bridal%');
                  });
            });
            $category = (object)['name' => 'Bridal & Party Wear'];
        } else {
            // Check if it's a category
            $dbCategory = \App\Models\Category::where('slug', $slug)->first();
            if ($dbCategory) {
                $query->whereHas('categories', function($q) use ($dbCategory) {
                    $q->where('categories.id', $dbCategory->id);
                });
                $category = $dbCategory;
            } else {
                abort(404);
            }
        }

        // Apply filters
        if ($request->has('sizes') && is_array($request->sizes)) {
            $query->where(function($q) use ($request) {
                foreach($request->sizes as $size) {
                    $q->orWhere('size', 'like', "%$size%");
                }
            });
        }
        if ($request->has('colors') && is_array($request->colors)) {
            $query->where(function($q) use ($request) {
                foreach($request->colors as $color) {
                    $q->orWhere('color', 'like', "%$color%");
                }
            });
        }
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', (float) $request->max_price);
        }
        if ($request->has('seasons') && is_array($request->seasons)) {
            $query->where(function($q) use ($request) {
                foreach($request->seasons as $season) {
                    $q->orWhere('season', 'like', "%$season%");
                }
            });
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'alpha_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'alpha_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($request->sort == 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'date_old') {
                $query->orderBy('created_at', 'asc');
            } elseif ($request->sort == 'date_new') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'best_selling') {
                $query->orderBy('is_best_selling', 'desc')->latest();
            } elseif ($request->sort == 'featured') {
                $query->orderBy('is_featured', 'desc')->latest();
            } else {
                $query->latest(); // Default
            }
        } else {
            $query->latest(); // Default sorting
        }

        $products = $query->get();

        $meta_title = isset($category->meta_title) && $category->meta_title ? $category->meta_title : $category->name;
        $meta_description = isset($category->meta_description) ? $category->meta_description : '';

        return view('Category-page', compact('category', 'products', 'meta_title', 'meta_description'));
    }

    public function product($id)
    {
        $product = \App\Models\Product::with('images', 'category')->findOrFail($id);
        return view('product', compact('product'));
    }

    public function aboutus()
    {
        return view('Aboutus');
    }

    public function cart()
    {
        return view('cart');
    }

    public function contactus()
    {
        return view('Contact-us');
    }

    public function returnPolicy()
    {
        $page = \App\Models\StaticPage::where('slug', 'return-policy')->firstOrFail();
        $meta_title = $page->meta_title ?: $page->title;
        $meta_description = $page->meta_description ?: '';
        return view('static-page', compact('page', 'meta_title', 'meta_description'));
    }

    public function privacyPolicy()
    {
        $page = \App\Models\StaticPage::where('slug', 'privacy-policy')->firstOrFail();
        $meta_title = $page->meta_title ?: $page->title;
        $meta_description = $page->meta_description ?: '';
        return view('static-page', compact('page', 'meta_title', 'meta_description'));
    }

    public function shippingPolicy()
    {
        $page = \App\Models\StaticPage::where('slug', 'shipping-policy')->firstOrFail();
        $meta_title = $page->meta_title ?: $page->title;
        $meta_description = $page->meta_description ?: '';
        return view('static-page', compact('page', 'meta_title', 'meta_description'));
    }

    public function termsConditions()
    {
        $page = \App\Models\StaticPage::where('slug', 'terms-conditions')->firstOrFail();
        $meta_title = $page->meta_title ?: $page->title;
        $meta_description = $page->meta_description ?: '';
        return view('static-page', compact('page', 'meta_title', 'meta_description'));
    }

    public function faq()
    {
        return view('faq');
    }

    public function signin()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
        ], [
            'email.email' => 'Please enter a valid email address with a correct domain.',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('account');
        }

        return back()->withErrors([
            'email' => 'No account found with this email address.',
        ])->onlyInput('email');
    }

    public function signup()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ], [
            'email.email' => 'Please enter a valid email address with a correct domain.',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => 'customer'
        ]);

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('account');
    }

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function account()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $orders = \App\Models\Order::where('email', $user->email)->latest()->get();
        return view('account-page', compact('user', 'orders'));
    }

    public function updateProfile(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $request->validate([
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = trim($request->first_name . ' ' . $request->last_name);
        $user->email = $request->email;
        $user->save();

        return redirect()->route('account')->with('success', 'Profile updated successfully.');
    }

    public function updateAddress(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $request->validate([
            'country' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:50',
            'phone' => 'required|string|max:50',
        ]);

        // Just updating the name if they change it in address, or maybe not needed, but since it's on the form we update it
        $user->country = $request->country;
        $user->name = trim($request->first_name . ' ' . $request->last_name);
        $user->address = $request->address;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('account')->with('success', 'Address updated successfully.');
    }

    public function cancelOrder(Request $request, $id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $order = \App\Models\Order::where('id', $id)->where('email', $user->email)->first();
        
        if ($order && strtolower($order->status) != 'completed' && strtolower($order->status) != 'cancelled') {
            $order->status = 'cancelled';
            $order->save();
            return back()->with('success', 'Order has been cancelled successfully.');
        }
        
        return back()->withErrors(['error' => 'Order could not be cancelled.']);
    }

    public function blog()
    {
        $blogs = \App\Models\BlogPost::where('status', 1)->latest()->paginate(10);
        $meta_title = 'Blog';
        $meta_description = '';
        return view('blog', compact('blogs', 'meta_title', 'meta_description'));
    }

    public function blogPost($slug)
    {
        $blog = \App\Models\BlogPost::where('slug', $slug)->where('status', 1)->firstOrFail();
        
        $meta_title = $blog->meta_title ?: $blog->name;
        $meta_description = $blog->meta_description ?: '';
        
        $popularBlogs = \App\Models\BlogPost::where('is_popular', 1)
                                            ->where('status', 1)
                                            ->where('id', '!=', $blog->id)
                                            ->latest()
                                            ->take(4)
                                            ->get();
        
        $relatedBlogs = \App\Models\BlogPost::where('status', 1)
                                            ->where('id', '!=', $blog->id)
                                            ->inRandomOrder()
                                            ->take(3)
                                            ->get();
        
        return view('blog-post', compact('blog', 'meta_title', 'meta_description', 'popularBlogs', 'relatedBlogs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if ($query) {
            $products = \App\Models\Product::where('name', 'LIKE', "%{$query}%")
                               ->orWhere('product_details', 'LIKE', "%{$query}%")
                               ->get();
        } else {
            $products = collect();
        }

        return view('search', compact('products', 'query'));
    }
}

