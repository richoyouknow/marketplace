<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('variants')->orderBy('id');

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('has_variants')) {
            if ($request->input('has_variants') === 'yes') {
                $query->has('variants');
            } elseif ($request->input('has_variants') === 'no') {
                $query->doesntHave('variants');
            }
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Product::select('category')->distinct()->pluck('category');

        $stats = [
            'total_products' => Product::count(),
            'with_variants' => Product::has('variants')->count(),
            'without_variants' => Product::doesntHave('variants')->count(),
            'total_variants' => ProductVariant::count(),
            'out_of_stock_variants' => ProductVariant::where('stock', '<=', 0)->count(),
        ];

        return view('admin.products.index', compact('products', 'categories', 'stats'));
    }
}
