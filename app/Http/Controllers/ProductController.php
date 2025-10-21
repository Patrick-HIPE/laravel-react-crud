<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Product;

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

    public function store(Request $request) {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price'       => ['required', 'numeric', 'min:0']
        ]);
        $createProduct = Product::create($validated);
        return redirect()->route('products.index')->with('message', 'Product created successfully.');
    }

    // Update product
    public function edit(Product $product) {
        return Inertia::render('products/Edit', [ 'product' => $product ]); // go to edit page with product data
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price'       => ['required', 'numeric', 'min:0']
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }
}
