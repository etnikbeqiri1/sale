@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Create Price</h1>
        <form method="POST" action="{{ route('prices.store') }}" class="space-y-4">
            @csrf
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Name:</label>
                <input required type="text" id="name" name="name" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="price" class="text-lg font-semibold mb-2">Price:</label>
                <input required type="number" step="0.01" id="price" name="price" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col">
                <label  for="start_price" class="text-lg font-semibold mb-2">Start Price:</label>
                <input required type="number" step="0.01" id="start_price" name="start_price" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                @error('start_price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="enabled" class="block text-gray-700 font-semibold mb-2">Enabled:</label>
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox" id="enabled" name="enabled" value="1" checked>
            </div>
            <div class="flex flex-col">
                <label for="item_pricing_id" class="text-lg font-semibold mb-2">Item Pricing:</label>
                <select id="item_pricing_id" name="item_pricing_id" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                    @foreach($itemPricings as $itemPricing)
                        <option value="{{ $itemPricing->id }}">{{ $itemPricing->name }}</option>
                    @endforeach
                </select>
                @error('item_pricing_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">Create</button>
        </form>
    </div>
@endsection
