<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        // Assuming free shipping for now, or you can add logic here
        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $rules = [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone' => ['required', 'string', 'min:10', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'payment_method' => 'required|string|in:COD',
            'billing_address_type' => 'required|in:same,different',
        ];

        if ($request->billing_address_type === 'different') {
            $rules['billing_first_name'] = 'required|string|max:255';
            $rules['billing_last_name'] = 'required|string|max:255';
            $rules['billing_address'] = 'required|string|max:255';
            $rules['billing_city'] = 'required|string|max:255';
            $rules['billing_postal_code'] = 'nullable|string|max:20';
            $rules['billing_phone'] = ['required', 'string', 'min:10', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
        }

        $request->validate($rules, [
            'email.email' => 'Please enter a valid email address.',
            'phone.regex' => 'Please enter a valid phone number (digits only).',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'billing_phone.regex' => 'Please enter a valid billing phone number.',
        ]);

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
        
        $shipping = 0;
        $total = $subtotal + $shipping;

        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            $orderData = [
                'order_number' => $orderNumber,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total_amount' => $total,
                'status' => 'Pending',
            ];

            if ($request->billing_address_type === 'different') {
                $orderData['billing_first_name'] = $request->billing_first_name;
                $orderData['billing_last_name'] = $request->billing_last_name;
                $orderData['billing_address'] = $request->billing_address;
                $orderData['billing_city'] = $request->billing_city;
                $orderData['billing_postal_code'] = $request->billing_postal_code;
                $orderData['billing_phone'] = $request->billing_phone;
            } else {
                $orderData['billing_first_name'] = $request->first_name;
                $orderData['billing_last_name'] = $request->last_name;
                $orderData['billing_address'] = $request->address;
                $orderData['billing_city'] = $request->city;
                $orderData['billing_postal_code'] = $request->postal_code;
                $orderData['billing_phone'] = $request->phone;
            }

            $order = Order::create($orderData);

            foreach ($cart as $key => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['name'],
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            // Clear the cart
            session()->forget('cart');

            return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function success()
    {
        if (!session('success')) {
            return redirect()->route('home');
        }
        
        return view('checkout-success');
    }
}
