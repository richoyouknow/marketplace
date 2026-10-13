<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;

class HomeController extends Controller
{
    protected ProductCatalogService $productService;

    public function __construct(ProductCatalogService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $featured = $this->productService->getFeatured();
        $bestSellers = $this->productService->getBestSellers();
        $newArrivals = $this->productService->getNewArrivals();

        return view('home', compact('featured', 'bestSellers', 'newArrivals'));
    }
}
