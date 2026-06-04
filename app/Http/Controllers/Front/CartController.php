<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Display the cart */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('front.cart', compact('cart', 'total'));
    }

    /** Add a product to cart */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        if (! $product->status || $product->stock < 1) {
            return back()->with('error', 'Bu ürün stokta yok.');
        }

        $cart = session()->get('cart', []);
        $key = $product->id;

        if (isset($cart[$key])) {
            $newQty = $cart[$key]['quantity'] + $quantity;
            if ($newQty > $product->stock) {
                return back()->with('error', 'Stok yetersiz.');
            }
            $cart[$key]['quantity'] = $newQty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->getDiscountedPrice(),
                'image' => $product->image,
                'quantity' => $quantity,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', '"'.$product->title.'" sepete eklendi.');
    }

    /** Update quantity in cart */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->product_id;

        if (isset($cart[$key])) {
            $product = Product::find($key);
            if ($product && $request->quantity > $product->stock) {
                return back()->with('error', 'Stok yetersiz.');
            }
            $cart[$key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Sepet güncellendi.');
    }

    /** Remove a product from cart */
    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required']);

        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Ürün sepetten çıkarıldı.');
    }

    /** Clear entire cart */
    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Sepet temizlendi.');
    }

    /** Return cart count (for AJAX) */
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = collect($cart)->sum('quantity');

        return response()->json(['count' => $count]);
    }

    /** Return full cart contents (for AJAX Drawer) */
    public function cartContents()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;
        $total = $subtotal + $shipping;
        $cartCount = collect($cart)->sum('quantity');

        foreach ($cart as $k => $item) {
            $cart[$k]['image_url'] = $item['image'] ? \Storage::url($item['image']) : null;
        }

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'free_at' => $freeAt,
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

    /** Add a product to cart via AJAX */
    public function addAjax(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        if (! $product->status || $product->stock < 1) {
            return response()->json(['success' => false, 'message' => 'Bu ürün stokta yok.']);
        }

        $cart = session()->get('cart', []);
        $key = $product->id;

        if (isset($cart[$key])) {
            $newQty = $cart[$key]['quantity'] + $quantity;
            if ($newQty > $product->stock) {
                return response()->json(['success' => false, 'message' => 'Stok yetersiz. En fazla '.$product->stock.' adet eklenebilir.']);
            }
            $cart[$key]['quantity'] = $newQty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->getDiscountedPrice(),
                'image' => $product->image,
                'quantity' => $quantity,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;
        $total = $subtotal + $shipping;
        $cartCount = collect($cart)->sum('quantity');

        foreach ($cart as $k => $item) {
            $cart[$k]['image_url'] = $item['image'] ? \Storage::url($item['image']) : null;
        }

        return response()->json([
            'success' => true,
            'message' => '"'.$product->title.'" sepete eklendi.',
            'cart' => array_values($cart),
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'free_at' => $freeAt,
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

    /** Update quantity in cart via AJAX */
    public function updateAjax(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->product_id;

        if (isset($cart[$key])) {
            $product = Product::find($key);
            if ($product && $request->quantity > $product->stock) {
                return response()->json(['success' => false, 'message' => 'Stok yetersiz. En fazla '.$product->stock.' adet sipariş edilebilir.']);
            }
            $cart[$key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;
        $total = $subtotal + $shipping;
        $cartCount = collect($cart)->sum('quantity');

        foreach ($cart as $k => $item) {
            $cart[$k]['image_url'] = $item['image'] ? \Storage::url($item['image']) : null;
        }

        return response()->json([
            'success' => true,
            'message' => 'Sepet güncellendi.',
            'cart' => array_values($cart),
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'free_at' => $freeAt,
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

    /** Remove product from cart via AJAX */
    public function removeAjax(Request $request)
    {
        $request->validate(['product_id' => 'required']);

        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;
        $total = $subtotal + $shipping;
        $cartCount = collect($cart)->sum('quantity');

        foreach ($cart as $k => $item) {
            $cart[$k]['image_url'] = $item['image'] ? \Storage::url($item['image']) : null;
        }

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepetten çıkarıldı.',
            'cart' => array_values($cart),
            'cart_count' => $cartCount,
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'free_at' => $freeAt,
            'total' => number_format($total, 2, '.', ''),
        ]);
    }
}
