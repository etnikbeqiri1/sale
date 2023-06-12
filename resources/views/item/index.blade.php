@extends('layouts.app')

@section('content')
    <div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold">Item List</h1>
            <a href="{{ route('items.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-200">Create Items</a>
        </div>

        <div class="mx-auto px-4 sm:px-6 md:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($items as $item)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4 {{ $item->enabled ? '' : 'opacity-50 border-2 border-red-500' }}">
                        <h2 class="text-2xl font-semibold mb-4">{{ $item->name }}</h2>
                        <p class="text-gray-600 mb-2">ID: {{ $item->id }}</p>
                        <p class="text-gray-600 mb-2">State: {{ $item->state }}</p>
                        <p class="text-gray-600 mb-2">Enabled: {{ $item->enabled }}</p>
                        <p class="text-gray-600 mb-2">Item Pricing ID: {{ $item->itemPricing->name }}</p>
                        <p class="text-gray-600 mb-2">Created At: {{ $item->created_at }}</p>
                        <p class="text-gray-600 mb-2">Updated At: {{ $item->updated_at }}</p>

                        <div class="flex justify-end mt-4">
                            <a href="{{ route('items.edit', $item->id) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors duration-200">Edit</a>

                            <div class="w-4"></div>
                            <form method="POST" action="{{ route('items.destroy', $item->id) }}">
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
