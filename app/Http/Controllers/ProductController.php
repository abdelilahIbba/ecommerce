<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'quantity' => 'required|numeric',
            'image' => 'required|image',
            'price' => 'required|numeric',
        ]);

        $imagePath = $request->file('image')->store('product_images', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imagePath,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'quantity' => 'required|numeric',
            'image' => 'image',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->update($request->only(['name', 'description', 'quantity', 'price']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
