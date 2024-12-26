@extends('base')
@section('title', 'Products')

@section('content')
    <h2 class="text-xl font-bold mb-4">Product List</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">#ID</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">{{ $product->name }}</th>
                        <th class="px-4 py-2 border">{{ $product->description }}</th>
                        <th class="px-4 py-2 border">{{ $product->quantity }}</th>
                        <th class="px-4 py-2 border">{{ $product->image }}</th>
                        <th class="px-4 py-2 border">{{ $product->price }} MAD</th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" align="center">
                            <h5>No Products.</h5>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
