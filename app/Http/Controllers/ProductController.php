<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
// use App\Models\Product::file();

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
        $product->file([
            'quantity' => 0,
        ]);        
        $isUpdate = false;
        return view('product.form', compact(
            'product', 'isUpdate'
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
        $product = Product::find($id);
     
        return view('product.edit',compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $product = Product::find($id);    
        // Update the product with the request data
        $product->update($request->all());
    
        return redirect()->route('Product.index')->with('success', 'Product Updated successfully.');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // If the product doesn't exist, redirect with an error message
            return redirect()->route('Product.index')->with('error', 'Product not found.');
        }

        // Attempt to delete the product
        $product->delete();

        // Redirect with success message after successful deletion
        return redirect()->route('Product.index')->with('success', 'Product deleted successfully.');
    }
}
