@extends('base')

@section('content')
<form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($product)
        @method('PUT')
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ $product ? 'Edit Product' : 'Create Product' }}</h2>

        <!-- Name Input -->
        <div class="mb-6">
            <label for="name-input" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name-input" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none"
                value="{{ old('name', $product->name ?? '') }}">
        </div>

        <!-- Description Input -->
        <div class="mb-6">
            <label for="description-input" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
            <textarea id="description-input" name="description" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <!-- Quantity Input -->
        <div class="mb-6">
            <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity-input" name="quantity" step="1" min="0"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none"
                value="{{ old('quantity', $product->quantity ?? '') }}" placeholder="0.00">
        </div>

        <!-- Image File Input -->
        <div class="mb-6">
            <label for="image-input" class="block mb-2 text-sm font-medium text-gray-700">Upload Image</label>
            <input type="file" id="image-input" name="image" accept="image/*"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none">
            @if ($product && $product->image)
                <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}"
                    class="w-16 h-16 object-cover rounded-md">
            @endif
        </div>

        <!-- Price Input -->
        <div class="mb-6">
            <label for="price-input" class="block mb-2 text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price-input" name="price" step="1" min="0"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none"
                value="{{ old('price', $product->price ?? '') }}" placeholder="0.00">
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <input type="submit" value="{{ $product ? 'Update' : 'Create' }}"
                class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        </div>
    </div>
</form>
@endsection
