<x-app-layout>
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
            <div class="relative pt-4 w-1/6">
                <div class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="search-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5" placeholder="Search" value="{{$queryName}}">
                    </div>
                    <button type="button" onclick="handleSearch()" onkeydown="handleSearchWithEnter(event)" class="p-2.5 ml-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-lg border border-orange-500 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 focus:ring-4 focus:outline-none focus:ring-orange-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>

            </div>
        </div>
    </x-slot>

    <div class="m-1">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                @foreach($items as $item)
                    @if($item->state == 0)
                        @include('offline_item', ['item' => $item])
                    @else
                        @include('online_item', ['item' => $item, 'products' => $products])
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <style>
        .animation-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 2px rgba(24, 255, 98, 0.42);
            }

            25% {
                transform: scale(0.98);
            }

            70% {
                transform: scale(1.01);
                box-shadow: 0 0 0 16px rgba(14, 148, 10, 0.01);
            }

            100% {
                transform: scale(1);
            }

        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        forceRefresh = () => {
            window.location.reload();
        }

        handleSearch = () => {
            const searchQuery = document.getElementById('search-input').value;
            window.location.href = '?name=' + searchQuery;
        }

        handleSearchWithEnter = (event) => {
            console.log(event.key)
            if (event.key === "Enter") {
                event.preventDefault();
                handleSearch();
            }
        }

        handleIncreaseItemNumber = (item, id, stock) => {
            const element = document.getElementById('product_' + item+ '_' + id);
            if (stock > element.value) {
                element.value = parseInt(element.value) + 1;

            }
        }

        handleDecreaseItemNumber = (item, id, stock) => {
            const element = document.getElementById('product_' + item+ '_' + id);
            if (element.value >= 1) {
                element.value = parseInt(element.value) - 1;
            }
        }

        submitProductOrder = (id, sessionId) => {
            let query = '#products_table_'+ id + ' tbody tr';
            let data = [];
            $(query).each(function() {
                let id = $(this).data('id');
                let numberOfItems = parseInt($(this).find('input[type="number"]').val());
                if (numberOfItems > 0) {
                    data.push({ id: id, number_of_items: numberOfItems });
                }
            });
            console.log(data);
            let url = '/sessions/' + sessionId + '/products';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    data
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    forceRefresh();
                })
                .catch(error => {
                    console.log(error);
                });
        };

    </script>
</x-app-layout>
