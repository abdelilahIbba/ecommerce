@extends('base')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h2>

    <form method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" enctype="multipart/form-data">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Save Product</button>
    </form>
@endsection
