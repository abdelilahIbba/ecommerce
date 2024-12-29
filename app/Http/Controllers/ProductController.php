<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact(
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        return view('product.create', compact(
            'product'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'quantity' => 'required|numeric',
            'image' => 'required|image',
            'price' => 'required|numeric',
        ]);
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product', 'public');
        }
        Product::create($formFields);
        // return to_route('Product.index')->with('success', 'Product created successfully');
        // $data = $request->validate([
        //     'name' => 'required|min:5',
        //     'description' => 'required|min:5',
        //     'quantity' => 'required|numeric',
        //        'image' => 'required|image',
        //     'price' => 'required|numeric',
        // ]);

        // Save product
        // $product = new Product();
        // $product->name = $data['name'];
        // $product->description = $data['description'];
        // $product->quantity = $data['quantity'];
        // $product->image = $request['image'];
        // $product->price = $data['price'];
        // $product->save();

        return redirect()->route('Product.index')->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
