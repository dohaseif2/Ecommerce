<?php

namespace App\Http\Controllers;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json(['products' => $products]);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json(['product' => $product]);
    }
}
