@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-4xl font-bold mb-6">Edit Price</h1>

        <form method="POST" action="{{ route('prices.update', $price->id) }}" class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="{{ $price->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ $price->price }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="start_price" class="block text-gray-700 font-semibold mb-2">Start Price:</label>
                <input type="number" step="0.01" id="start_price" name="start_price" value="{{ $price->start_price }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="enabled" class="block text-gray-700 font-semibold mb-2">Enabled:</label>
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox" id="enabled" name="enabled" value="1" {{ $price->enabled ? 'checked' : '' }}>
            </div>
            <div class="mb-4">
                <label for="item_pricing_id" class="block text-gray-700 font-semibold mb-2">Item Pricing:</label>
                <select id="item_pricing_id" name="item_pricing_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    @foreach($itemPricings as $itemPricing)
                        <option value="{{ $itemPricing->id }}" {{ $itemPricing->id === $price->item_pricing_id ? 'selected' : '' }}>
                            {{ $itemPricing->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200">Update</button>
        </form>
    </div>

@endsection
