<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Add a product to the cart session.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        $cart = session()->get('cart', []);
        
        $size = $request->size ?? 'Standard';
        // Unique cart key based on product ID and size
        $cartKey = $product->id . '_' . md5($size);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $price = $product->is_on_sale && $product->sale_price ? $product->sale_price : $product->price;
            
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $price,
                'size' => $size,
                'image' => $product->image_path ? asset($product->image_path) : asset('images/product.png'),
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => count($cart),
            'drawer_html' => view('partials.cart-drawer-items', compact('cart'))->render()
        ]);
    }

    /**
     * Update quantity of an item in the cart.
     */
    public function update(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->cart_key])) {
            $cart[$request->cart_key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            $itemTotal = $cart[$request->cart_key]['price'] * $request->quantity;
            $cartTotal = collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; });

            return response()->json([
                'success' => true,
                'drawer_html' => view('partials.cart-drawer-items', compact('cart'))->render(),
                'item_total_formatted' => 'Rs ' . number_format($itemTotal),
                'cart_total_formatted' => 'Rs ' . number_format($cartTotal)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->cart_key])) {
            unset($cart[$request->cart_key]);
            session()->put('cart', $cart);
            
            $cartTotal = collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; });

            return response()->json([
                'success' => true,
                'cart_count' => count($cart),
                'drawer_html' => view('partials.cart-drawer-items', compact('cart'))->render(),
                'cart_total_formatted' => 'Rs ' . number_format($cartTotal)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }

    /**
     * Get the cart drawer HTML.
     */
    public function getDrawer()
    {
        $cart = session()->get('cart', []);
        
        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'drawer_html' => view('partials.cart-drawer-items', compact('cart'))->render()
        ]);
    }
}
