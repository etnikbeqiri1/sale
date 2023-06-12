@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Item</h1>
        <form method="POST" action="{{ route('items.update', $item->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="text-gray-700 font-semibold">Name:</label>
                <input type="text" id="name" name="name" value="{{ $item->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="enabled" class="block text-gray-700 font-semibold mb-2">Enabled:</label>
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox" id="enabled" name="enabled" value="1" {{ $item->enabled ? 'checked' : '' }}>
                @error('enabled')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="item_pricing_id" class="text-gray-700 font-semibold">Item Pricing:</label>
                <select id="item_pricing_id" name="item_pricing_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    @foreach($itemPricings as $itemPricing)
                        <option value="{{ $itemPricing->id }}" {{ $itemPricing->id === $item->item_pricing_id ? 'selected' : '' }}>{{ $itemPricing->name }}</option>
                    @endforeach
                </select>
                @error('item_pricing_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600 transition-colors duration-200">Update</button>
        </form>
    </div>
@endsection
