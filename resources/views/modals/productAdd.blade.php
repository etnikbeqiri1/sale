<div id="products-session-modal_{{$item->id}}" tabindex="-1"
     class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                    class="bg-transparent absolute top-3 right-2.5 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="products-session-modal_{{$item->id}}">
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
                        &nbsp;&nbsp; Add Products</p></h1>
                @if($products->count() >= 1)
                    <div class="relative overflow-x-auto mt-4 shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500" id="products_table_{{$item->id}}">
                            <thead class="text-xs text-orange-500 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Number Of Items
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="bg-white border-b hover:bg-gray-50" data-id="{{$product->id}}">
                                    <td class="m-4">
                                        <img class="object-contain h-16 w-10" src="{{ $product->image }}"
                                             alt="{{$product->name}}">
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <button
                                                onclick="handleDecreaseItemNumber({{ $item->id }}, {{$product->id}}, {{ $product->stock }})"
                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                                type="button">
                                                <span class="sr-only">Quantity button</span>
                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            <div>
                                                <input type="number" min="0"
                                                       id="product_{{ $item->id }}_{{$product->id}}"
                                                       class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1"
                                                       placeholder="0" value="0" required>
                                            </div>
                                            <button
                                                onclick="handleIncreaseItemNumber({{ $item->id }}, {{$product->id}}, {{ $product->stock }})"
                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                                type="button">
                                                <span class="sr-only">Quantity button</span>
                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        {{ $product->price }}€
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1 class="m-4 font-bold text-orange-500 text-4xl">No Stock!</h1>
                @endif

                <div class="mt-3">

                    <button onclick="submitProductOrder({{ $item->id }}, {{ $item->session->id }})"
                            data-modal-hide="products-session-modal_{{$item->id}}" type="button"
                            class="text-white bg-gradient-to-r from-orange-500 to-red-500 focus:ring-4 focus:outline-none focus:ring-orange-500 font-bold rounded-lg text-md inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, Add Products
                    </button>
                    <button data-modal-hide="products-session-modal_{{$item->id}}" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-md px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        No, cancel
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
