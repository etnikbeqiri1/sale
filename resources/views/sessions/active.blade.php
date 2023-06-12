@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Active Sessions</h2>
            <a href="{{ route('sessions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Session
            </a>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                <tr class="text-left">
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Session ID</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Item</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Start Price</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Price</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Started At</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Session</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Stop Session</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activeSessions as $session)
                    <tr>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->id }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->item->name }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->price->start_price }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->price->price }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->started_at }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $session->started_at->diff(Carbon\Carbon::now())->format('%h hour and %i minutes and %s seconds') }}</td>
                        <td class="border-dashed border-t border-gray-200 px-3 py-2"><a href="{{ route('sessions.stop', $session->id) }}" class="text-blue-500">Stop</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        setTimeout(function(){
            location.reload();
        }, 20000);
    </script>
@endsection
