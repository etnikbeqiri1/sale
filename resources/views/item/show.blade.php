@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Item Details</h1>
        <ul class="space-y-4">
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">ID:</span> {{ $item->id }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">Name:</span> {{ $item->name }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">State:</span> {{ $item->state }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">Enabled:</span> {{ $item->enabled }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">Item Pricing ID:</span> {{ $item->item_pricing_id }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">Created At:</span> {{ $item->created_at }}
            </li>
            <li class="flex items-center">
                <span class="text-gray-700 font-semibold mr-2">Updated At:</span> {{ $item->updated_at }}
            </li>
        </ul>
        <div class="mt-8">
            <a href="{{ route('items.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors duration-200">Back to All Items</a>
        </div>
        @endsection
    </div>

