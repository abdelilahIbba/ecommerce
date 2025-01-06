@extends('base')

@section('title', $product->name)

@section('content')
    <h2 class="text-3xl font-semibold mb-6">{{ $product->name }}</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-md mb-4">
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ number_format($product->price, 2) }} MAD</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
    </div>
@endsection
