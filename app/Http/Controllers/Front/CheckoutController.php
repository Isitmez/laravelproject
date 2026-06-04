<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Sepetiniz boş.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;

        $discount = 0;
        $couponCode = null;
        if ($couponSession = session()->get('coupon')) {
            $coupon = Coupon::where('code', $couponSession['code'])->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponCode = $coupon->code;
            } else {
                session()->forget('coupon');
            }
        }

        $total = max(0, $subtotal - $discount) + $shipping;

        $user = Auth::user();

        return view('front.checkout', compact('cart', 'subtotal', 'shipping', 'discount', 'couponCode', 'total', 'user', 'freeAt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'note' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Sepetiniz boş.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if (! $product || $product->stock < $item['quantity']) {
                return back()->with('error', '"'.$item['title'].'" için yeterli stok yok.');
            }
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;

        $discount = 0;
        $couponCode = null;
        if ($couponSession = session()->get('coupon')) {
            $coupon = Coupon::where('code', $couponSession['code'])->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponCode = $coupon->code;
            }
        }

        $total = max(0, $subtotal - $discount) + $shipping;

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'discount' => $discount,
            'coupon_code' => $couponCode,
            'total' => $total,
            'status' => 'pending',
            'note' => $request->note,
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_title' => $item['title'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);

            $product->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');
        session()->forget('coupon');

        return redirect()->route('order.success', $order->id)
            ->with('success', 'Siparişiniz başarıyla alındı!');
    }

    public function success(Order $order)
    {
        $order->load('items.product');

        return view('front.order_success', compact('order'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Sepetiniz boş.']);
        }

        $coupon = Coupon::where('code', $request->code)->first();

        if (! $coupon || ! $coupon->isValid()) {
            session()->forget('coupon');

            return response()->json(['success' => false, 'message' => 'Geçersiz veya süresi dolmuş kupon kodu.']);
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $discount = $coupon->calculateDiscount($subtotal);

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]);

        $shippingFee = (float) Setting::get('shipping_fee', 9.99);
        $freeAt = (float) Setting::get('free_shipping_at', 100);
        $shipping = $subtotal >= $freeAt ? 0 : $shippingFee;
        $total = max(0, $subtotal - $discount) + $shipping;

        return response()->json([
            'success' => true,
            'message' => 'Kupon uygulandı: '.$coupon->code,
            'code' => $coupon->code,
            'discount' => number_format($discount, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
        ]);
    }
}
