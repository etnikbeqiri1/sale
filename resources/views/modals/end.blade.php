@php
    $durationInMinutes = $item->session->started_at->diffInMinutes(now());
    $pricePerHour = $item->session->price->price;
    $price = $durationInMinutes / 60 * $pricePerHour;

    $minPrice = $item->session->price->start_price;

    $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
    $price = max($roundedPrice, $minPrice); // Ensure the price is at least the minimum price

    $finalPrice = number_format((float)$price, 2, '.', '');

@endphp
<div id="end-session-modal_{{$item->id}}" tabindex="-1"
     class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="end-session-modal_{{$item->id}}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <h1 class="text-3xl font-light flex flex-row justify-center">{{$item->name}} <p class="font-extralight">
                        &nbsp;&nbsp; End Session</p></h1>

                <div class="w-full bg-white">
                    <ul class="flex flex-row pb-2" id="fullWidthTab_{{$item->id}}"
                        data-tabs-toggle="#fullWidthTabContent_{{$item->id}}" role="tablist">
                        <li class="w-full">
                            <button id="info-tab_{{$item->id}}" data-tabs-target="#info_{{$item->id}}" type="button"
                                    role="tab" aria-controls="info_{{$item->id}}" aria-selected="true"
                                    class="inline-block py-2 px-14 rounded-lg bg-gray-50 text-orange-500 transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-orange-500 hover:bg-gray-100 focus:outline-none">
                                Information
                            </button>
                        </li>
                        @if($item->session->products->count() >= 1)
                            <li class="w-full">
                                <button id="products-tab_{{$item->id}}" data-tabs-target="#products_{{$item->id}}"
                                        type="button" role="tab" aria-controls="products_{{$item->id}}"
                                        aria-selected="false"
                                        class="inline-block py-2 px-14 rounded-lg bg-gray-50 text-orange-500  transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300 hover:text-orange-500 hover:bg-gray-100 focus:outline-none">
                                    Products
                                </button>
                            </li>
                        @endif
                    </ul>
                    <div id="fullWidthTabContent_{{$item->id}}" class="">
                        <div class="hidden p-1 bg-white rounded-lg md:p-8" id="info_{{$item->id}}" role="tabpanel"
                             aria-labelledby="info_{{$item->id}}-tab">
                            <div class="pb-6 text-center">
                                @php
                                    $personNumber = $item->session->price->name[0];
                                @endphp

                                <div class="flex flex-row justify-center text-gray-700">
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

                                <h1 class="text-2xl font-extralight">Started at
                                    - {{$item->session->started_at}}</h1>
                                <hr class="w-80 h-1 mx-auto my-3 bg-gray-100 border-0 rounded">
                                <h1 class="text-2xl font-extralight">Active For
                                    - <span
                                        class="font-extrabold text-orange-500">{{$item->session->started_at->diff(Carbon\Carbon::now())->format('%d Days %h Hours %i Minutes')}}</span>
                                </h1>
                                <h1 class="text-2xl font-extralight">Price Per Hour
                                    - <span
                                        class="font-extrabold text-orange-500">{{$item->session->price->price}}$/h</span>
                                </h1>
                                <hr class="w-72 h-1 mx-auto my-3 bg-gray-100 border-0 rounded">
                                <h1 class="text-2xl font-extralight">Ordered Products - <span
                                        class="font-extrabold text-orange-500">{{ $item->productNumber }}</span></h1>
                                <h1 class="text-2xl font-extralight">Products Price - <span
                                        class="font-extrabold text-orange-500">{{ $item->allProductPrice }}$</span>
                                </h1>
                                <hr class="w-60 h-1 mx-auto my-3 bg-gray-100 border-0 rounded">
                                <h1 class="text-2xl font-extralight">PlayTime Price - <span
                                        class="font-extrabold text-orange-500">{{ $finalPrice }}$</span></h1>
                                @php

                                        $roundPriceTotal = ceil(($finalPrice + $item->allProductPrice) / 0.05) * 0.05;
                                        $totalRoundPrice = number_format($roundPriceTotal, 2, '.', '');
                                @endphp
                                <hr class="w-60 h-1 mx-auto my-3 bg-gray-100 border-0 rounded">

                                <h1 class="text-2xl font-light pt-2">Total - <span
                                        class="font-extrabold mb-4 text-orange-500">{{ $totalRoundPrice }}$</span>
                                </h1>
                            </div>
                        </div>
                        <div class="hidden bg-white rounded-lg" id="products_{{$item->id}}" role="tabpanel"
                             aria-labelledby="products_{{$item->id}}-tab">
                            @if($item->session->products->count() > 0)
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                <span class="sr-only">Image</span>
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Qty
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Price
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Order Time
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item->session->products as $product)
                                            @include('product.list-item', $product)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="p-4 text-orange-500 font-semibold text-xl text-gradient-to-r from-orange-500 to-red-500">
                                    Total Price - {{ $item->allProductPrice }}$
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <form method="POST" action="{{ route('sessions.stopSession', $item->session->id) }}">
                    @csrf
                    @method('PUT')

                    <button data-modal-hide="end-session-modal_{{$item->id}}" type="submit"
                            class="text-white bg-gradient-to-r from-orange-500 to-red-500 focus:ring-4 focus:outline-none focus:ring-orange-500 font-bold rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="end-session-modal_{{$item->id}}" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-md px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        No, cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
