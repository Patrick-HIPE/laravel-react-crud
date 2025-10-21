<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // List products
    public function index() {
        $products = Product::all();
        return Inertia::render('products/Index', [ 'products' => $products ]); // go to index page with products data
    }

    // Create product
    public function create() {
        return Inertia::render('products/Create', []); // go to create page
    }

    public function store(StoreProductRequest $request) {
        $validated = $request->validated();
        $createProduct = Product::create($validated);
        return redirect()->route('products.index')->with('message', 'Product created successfully.');
    }

    // Update product
    public function edit(Product $product) {
        return Inertia::render('products/Edit', [ 'product' => $product ]); // go to edit page with product data
    }

    public function update(UpdateProductRequest $request, Product $product) {
        $validated = $request->validated();
        $product->update($validated);
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }
}
