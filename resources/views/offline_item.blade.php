<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 p-3">
    <div
        class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8flex flex-col justify-between"
        style="height: 500px">
        <div class="flow-root">
            <div class="flex-shrink-0">
                <img class="w-32 h-32 rounded-xl border-white"
                     src="/storage/images/ps{{ $item->name[2] }}.jpg"
                     alt="Neil image">
            </div>
        </div>
        <div class="mb-32">
            <div>
                <p class="flex justify-items-start font-extralight text-lg text-gray-500">Last Active
                    Time</p>
            </div>
            <div
                class="flex pb-10
                                pointer-events-none rounded cursor-not-allowed"
            >
                <div
                    class="flex flex-nowrap"
                >
                    <div class="inline-block px-1">
                        <none class="text-gray-400 font-bold">
                            {{$item->pastSession ? $item->pastSession->ended_at->diffForHumans() : "Never"}}
                        </none>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold leading-none text-gray-900">{{ $item->name }}</h1>
            </div>
            <div class="flex items-center justify-between">
                @foreach($item->prices as $price)
                    @php
                        $personNumber = $price['name'][0];
                    @endphp
                    <div class="flex-1 mr-1">

                        <button data-modal-target="start-session-modal_{{$item->id}}_{{$personNumber}}"
                                data-modal-toggle="start-session-modal_{{$item->id}}_{{$personNumber}}"
                                class="opacity-90 px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg border border-orange-500 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:font-bold duration-200 mr-1 text-white w-full">
                            <div class="flex justify-center align-middle">
                                @for ($i = 0; $i < $personNumber; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-user -mr-2" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                @endfor
                            </div>
                            {{ $price['name'] }}
                        </button>
                        @include('modals.start', ['item' => $item, 'price' => $price, 'personNumber' => $personNumber])

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>


