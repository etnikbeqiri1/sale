@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Item Pricing</h1>
        <form method="POST" action="{{ route('item_pricings.update', $itemPricing->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Name:</label>
                <input required type="text" id="name" name="name" value="{{ $itemPricing->name }}" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="enabled" class="block text-gray-700 font-semibold mb-2">Enabled:</label>
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox" id="enabled" name="enabled" value="1" {{ $itemPricing->enabled ? 'checked' : '' }}>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600 transition-colors duration-200">Update</button>
        </form>
    </div>
@endsection
