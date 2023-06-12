@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Item Pricing Details</h1>
        <ul class="space-y-4">
            <li class="flex items-start">
                <span class="font-semibold mr-2">ID:</span>
                <span>{{ $itemPricing->id }}</span>
            </li>
            <li class="flex items-start">
                <span class="font-semibold mr-2">Name:</span>
                <span>{{ $itemPricing->name }}</span>
            </li>
            <li class="flex items-start">
                <span class="font-semibold mr-2">Enabled:</span>
                <span>{{ $itemPricing->enabled }}</span>
            </li>
            <li class="flex items-start">
                <span class="font-semibold mr-2">Created At:</span>
                <span>{{ $itemPricing->created_at }}</span>
            </li>
            <li class="flex items-start">
                <span class="font-semibold mr-2">Updated At:</span>
                <span>{{ $itemPricing->updated_at }}</span>
            </li>
        </ul>
    </div>
@endsection
