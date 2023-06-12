<div id="start-session-modal_{{$item->id}}_{{$personNumber}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" class="bg-transparent absolute top-3 right-2.5 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="start-session-modal_{{$item->id}}_{{$personNumber}}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <h1 class="text-3xl font-light flex flex-row justify-center">{{$item->name}} <p class="font-extralight">
                        &nbsp;&nbsp; Start Session</p></h1>
                <h1 class="text-2xl font-extralight">{{ $price['price'] }}€/h</h1>
                <h1 class="text-xl text-orange-500 font-extrabold mb-4">{{ $price['name'] }}</h1>
                <h3 class="mb-5 text-lg font-extralight text-gray-500">Are you sure you want to start a session?</h3>
                <form method="POST" action="{{ route('sessions.store') }}">
                    @csrf

                    <input type="hidden" name="price_id" value="{{ $price['id'] }}">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button data-modal-hide="start-session-modal_{{$item->id}}_{{$personNumber}}" type="submit" class="text-white bg-gradient-to-r from-orange-500 to-red-500 focus:ring-4 focus:outline-none focus:ring-orange-500 font-bold rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="start-session-modal_{{$item->id}}_{{$personNumber}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-md px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
