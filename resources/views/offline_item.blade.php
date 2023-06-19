<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 2xl:w-1/5 p-3">
    <div
        class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8flex flex-col justify-between"
        style="">
        <div class="flow-root">
            <div class="flex-shrink-0 flex flex-col">
                <div class="flex flex-row justify-between">
                    <div>
                        <img class="w-32 h-32 rounded-xl border-white"
                             src="/storage/images/ps{{ $item->name[2] }}.jpg"
                             alt="{{ $item->name }}">
                    </div>
                    <div>
                        <p class="font-light text-xl opacity-40">Last Active</p>
                        <p class="flex justify-end font-light opacity-60 text-xl">{{$item->pastSession ? $item->pastSession->ended_at->diffForHumans() : "Never"}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-3">
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
                                class="opacity-90 h-14 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg border border-orange-500 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:font-bold duration-200 mr-1 text-white w-full">
                            <div class="flex justify-center align-middle">
                                @for ($i = 0; $i < $personNumber; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-user -mr-1" width="20" height="20"
                                         viewBox="0 0 20 20" stroke-width="2" stroke="currentColor" fill="none"
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


