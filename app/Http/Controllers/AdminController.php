<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->role === 'admin') {
            if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you do not have admin access.',
        ])->onlyInput('email');
    }

    public function index()
    {
        // Stats
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $activeOrders = Order::whereIn('status', ['Pending', 'Processing'])->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalProducts = Product::count();

        // Recent Orders
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        // Sales Chart Data (Current Year)
        $salesData = Order::select(
            DB::raw('sum(total_amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%M') as months")
        )
        ->where('status', '!=', 'cancelled')
        ->whereYear('created_at', date('Y'))
        ->groupBy('months')
        ->get();

        // Format for Chart.js
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $salesChartData = array_fill(0, 12, 0);
        foreach ($salesData as $data) {
            $index = array_search($data->months, $months);
            if ($index !== false) {
                $salesChartData[$index] = $data->sums;
            }
        }
        $salesChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Category Chart Data
        $categories = Category::withCount('products')->get();
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryData = $categories->pluck('products_count')->toArray();

        return view('admin.dashboard', compact(
            'totalRevenue', 'activeOrders', 'totalCustomers', 'totalProducts',
            'recentOrders', 'salesChartData', 'salesChartLabels', 'categoryLabels', 'categoryData'
        ));
    }

    public function changePasswordForm()
    {
        return view('admin.change-password');
    }

    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}
