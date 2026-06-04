<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();

        $categories = Category::where('parent_id', 0)
            ->where('status', true)
            ->with('children')
            ->get();

        $featuredProducts = Product::with('category')
            ->active()
            ->where('stock', '>', 0)
            ->latest()
            ->take(24)
            ->get();

        $discountedProducts = Product::with('category')
            ->active()
            ->where('discount', '>', 0)
            ->where('stock', '>', 0)
            ->take(12)
            ->get();

        return view('front.home', compact(
            'sliders',
            'categories',
            'featuredProducts',
            'discountedProducts'
        ));
    }

    public function searchAutocomplete(Request $request)
    {
        $q = $request->query('q');
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $products = Product::active()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('keywords', 'like', "%{$q}%");
            })
            ->take(5)
            ->get();

        $results = [];
        foreach ($products as $p) {
            $results[] = [
                'id' => $p->id,
                'title' => $p->title,
                'price' => number_format($p->getDiscountedPrice(), 2, '.', ''),
                'original_price' => number_format($p->price, 2, '.', ''),
                'discount' => $p->discount,
                'image_url' => $p->image ? \Storage::url($p->image) : null,
                'url' => route('product.show', $p->id),
            ];
        }

        return response()->json($results);
    }

    public function quickView(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'detail' => $product->detail,
            'price' => number_format($product->getDiscountedPrice(), 2, '.', ''),
            'original_price' => number_format($product->price, 2, '.', ''),
            'discount' => $product->discount,
            'stock' => $product->stock,
            'image_url' => $product->image ? \Storage::url($product->image) : null,
            'url' => route('product.show', $product->id),
        ]);
    }

    public function profile()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->with('items')
            ->latest()
            ->get();

        return view('front.profile', compact('user', 'orders'));
    }
}
