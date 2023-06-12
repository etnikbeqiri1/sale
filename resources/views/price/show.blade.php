@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-4">
            <h1 class="text-2xl font-bold mb-6">Price Details</h1>
            <ul class="divide-y divide-gray-200 space-y-4">
                <li class="flex items-start">
                    <span class="font-semibold w-24">ID:</span>
                    <span>{{ $price->id }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Name:</span>
                    <span>{{ $price->name }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Price:</span>
                    <span>{{ $price->price }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Start Price:</span>
                    <span>{{ $price->start_price }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Enabled:</span>
                    <span>{{ $price->enabled ? 'Yes' : 'No' }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Item Pricing ID:</span>
                    <span>{{ $price->item_pricing_id }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Created At:</span>
                    <span>{{ $price->created_at }}</span>
                </li>
                <li class="flex items-start">
                    <span class="font-semibold w-24">Updated At:</span>
                    <span>{{ $price->updated_at }}</span>
                </li>
            </ul>
            <div class="mt-8">
                <a href="{{ route('prices.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors duration-200">Back to All Prices</a>
            </div>
        </div>
    </div>
@endsection
