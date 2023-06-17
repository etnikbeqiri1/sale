@php
    $durationInMinutes = $item->session->started_at->diffInMinutes(now());
    $pricePerHour = $item->session->price->price;
    $price = $durationInMinutes / 60 * $pricePerHour;

    $minPrice = $item->session->price->start_price;

    $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
    $price = max($roundedPrice, $minPrice); // Ensure the price is at least the minimum price
    $displayPrice = $item->allProductPrice + $price;

    $finalPrice = number_format((float)$price, 2, '.', '');
@endphp
<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 2xl:w-1/5 p-3">
    <div
        class="animation-pulse w-full max-w-md p-4 bg-white border border-green-400 rounded-lg shadow flex flex-col justify-between"
        style="">
        <div class="flow-root">
            <div class="flex-shrink-0 flex flex-col">
                <div class="flex flex-row justify-between">
                    <div>
                        <img class="w-28 h-28 rounded-xl border-white"
                             src="/storage/images/ps{{ $item->name[2] }}.jpg"
                             alt="{{ $item->name }}">
                    </div>
                    <div>
                        <p class="font-bold text-4xl"> {{number_format($displayPrice, 2, ".", ".")}}€</p>
                        <p class="flex justify-end font-extralight text-xl">{{ $item->session->started_at->diffForHumans() }}</p>
                        <div class="flex flex-row justify-end">
                            @php
                                $personNumber = $item->session->price->name[0];
                            @endphp
                            <div class="flex flex-row pt-4 m-1">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div
                class="flex overflow-x-scroll hide-scroll-bar"
            >
                <div
                    class="flex flex-nowrap"
                >
                    <div class="inline-block px-1 mb-1 hover:scale-105 duration-300">
                        <div
                            class="w-20 h-24 overflow-hidden rounded-lg drop-shadow-sm shadow-md bg-white hover:drop-shadow-none hover:shadow-lg transition-shadow duration-300 ease-in-out flex flex-col"
                        >
                            <div class="grid h-screen place-items-center" data-modal-target="products-session-modal_{{$item->id}}"
                                 data-modal-toggle="products-session-modal_{{$item->id}}">
                                <div>
                                    <h1 class=" opacity-50 text-5xl">+</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($item->session->products as $product)
                    <div class="inline-block px-1 mb-0.5">
                        <div
                            class="w-20 h-24 max-w-xs overflow-hidden rounded-lg drop-shadow-sm shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out"
                        >
                            <div class="flex flex-row justify-between">
                                <div class="flex-1 pt-1 pl-1">
                                    <img class="object-contain h-14 w-10"
                                         src="{{ $product->image }}"
                                         alt="{{ $product->name }}">
                                </div>
                                <div class="pr-1 pt-0.5  text-gray-400 font-light">x</div>
                                <div class="pr-2 text-lg text-gray-400 font-bold">{{ $product->pivot->number_of_items }}</div>
                            </div>
                            <div>
                                <p class="text-xs font-light px-2 text-gray-500">{{ $product->name }}</p>
                                <p class="text-sm font-light px-2 text-gray-700">{{ $product->price * $product->pivot->number_of_items }}€</p>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-3xl font-bold leading-none text-gray-900">{{ $item->name }}</h1>
            </div>
            <div class="flex items-center justify-between">

                <button
                    data-modal-target="end-session-modal_{{$item->id}}"
                    data-modal-toggle="end-session-modal_{{$item->id}}"
                    class="h-[4.3rem] opacity-90 rounded-lg bg-red-500 border-2 border-red-700 hover:font-bold duration-200 mr-1 text-white text-xl w-full">
                    End Session
                </button>
            </div>
        </div>
    </div>
    @include('modals.end', ['item' => $item])
    @include('modals.productAdd', ['item' => $item, 'products' => $products])
    <style>
        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 20px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #bcbfc2;
            border-radius: 20px;
            border: 6px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #93999a;
        }
    </style>
</div>
