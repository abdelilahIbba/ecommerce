@extends('base')

@section('title', 'Products')

@section('content')
    <h2 class="text-3xl font-semibold mb-6">Product List</h2>

    <div class="overflow-hidden shadow-xl rounded-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="text-left bg-gray-100 border-b border-gray-300">
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">#ID</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Name</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Description</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Quantity</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Image</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Price</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $product->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $product->description }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $product->quantity }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-16 h-16 object-cover rounded-md">
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($product->price, 2) }} MAD</td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <a href="{{ route('products.edit', $product) }}"
                                class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Edit</a>

                            <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete"
                                    class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 ml-2">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-lg text-gray-500">No Products Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
