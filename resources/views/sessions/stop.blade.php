@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-5 max-w-md">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Stop Session</h2>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white py-4 px-4">
                        <form method="POST" action="{{ route('sessions.stopSession', $session->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to stop the session?
                                </p>
                            </div>
                            <div>
                                {{ $session->item->name }}
                            </div>
                            <div>
                                {{ $session->started_at->diff(Carbon\Carbon::now())->format('%h hour and %i minutes and %s seconds') }}
                            </div>
                            <div>
                                {{ $session->price->price }}$
                            </div>
                            <div>
                                {{ $session->price->start_price }}$
                            </div>
                            <div>
                                {{ $formattedPrice }}$
                            </div>
                                <div>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Stop Session
                                </button>
                            </div>
                            <div>
                                {{ $session->products }}
                            </div>
                        </form>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function(){
            location.reload();
        }, 5000);
    </script>
@endsection
