<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductCatalogService $productService;

    public function __construct(ProductCatalogService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $products = $this->productService->searchAndFilter($filters);
        
        return view('products.index', compact('products', 'filters'));
    }

    public function show($slug)
    {
        $product = $this->productService->findBySlug($slug);
        
        if (!$product) {
            abort(404);
        }

        $relatedProducts = $this->productService->getAll()
            ->where('category', $product['category'])
            ->where('id', '!=', $product['id'])
            ->take(4);

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
