@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="flex-1 font-sans text-5xl bg-gradient-to-r from-orange-500 to-red-500 text-transparent bg-clip-text mt-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="pt-4 pr-4">
                <button onclick="forceRefresh()" type="button" class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-center text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-lg border border-orange-500 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:font-bold duration-100 focus:ring-1 focus:outline-none focus:ring-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span class="sr-only">Refresh</span>
                    Refresh
                </button>
            </div>
        </div>
    </x-slot>
    <div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold">Price List</h1>
            <a href="{{ route('prices.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-200">Create Price</a>
        </div>

        <div class="mx-auto px-4 sm:px-6 md:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($prices as $price)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4 {{ $price->enabled ? '' : 'opacity-50 border-2 border-red-500' }}">
                        <h2 class="text-xl font-semibold mb-4">{{ $price->name }}</h2>
                        <p class="text-gray-600 mb-2">Price: ${{ $price->price }}</p>
                        <p class="text-gray-600 mb-2">Start Price: ${{ $price->start_price }}</p>
                        <p class="text-gray-600 mb-2">Item Pricing ID: {{ $price->itemPricing->name }}</p>
                        <p class="text-gray-600 mb-2">Created At: {{ $price->created_at }}</p>
                        <p class="text-gray-600 mb-2">Updated At: {{ $price->updated_at }}</p>

                        <div class="flex justify-end mt-4">
                            <a href="{{ route('prices.edit', $price->id) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors duration-200">Edit</a>

                            <div class="w-4"></div>
                            <form method="POST" action="{{ route('prices.destroy', $price->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-200">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
