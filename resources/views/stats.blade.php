<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="flex-1 font-sans text-5xl bg-gradient-to-r from-orange-500 to-red-500 text-transparent bg-clip-text mt-4">
                {{ __('Stats') }}
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
        </div>
    </x-slot>

    <div class="m-1">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Session Time</div>
                            <div class="bg-purple-500 text-white rounded-full px-3 py-1 text-sm">{{ $totalSessionsTimeTodayPercentage }}%</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalSessionsTimeToday }}</div>
                        <div class="text-gray-500 text-sm mt-2">Today</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg col-span-1 p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Total Sessions</div>
                            <div class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">{{$totalSessionsSinceLastMonthPercentage}}%</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{$totalSessionsSinceLastMonth}}</div>
                        <div class="text-gray-500 text-sm mt-2">Since Last Month</div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6 col-span-2 row-span-3 h-[280px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Revenue</div>
                            <div class="bg-green-500 text-white rounded-full px-3 py-1 text-sm">{{ $totalRevenueTodayPercentage }}%</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalRevenueToday }}</div>
                        <div class="text-gray-500 text-sm mt-2">Today</div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalRevenueMonthly }}</div>
                        <div class="text-gray-500 text-sm mt-2">This month</div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{$totalRevenue}}</div>
                        <div class="text-gray-500 text-sm mt-2">All the time</div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Product Sales</div>
                            <div class="bg-yellow-500 text-white rounded-full px-3 py-1 text-sm">{{ $totalProductSalesTodayPercentage }}%</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalProductSalesToday }}</div>
                        <div class="text-gray-500 text-sm mt-2">Today</div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Product Sales</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalProductSalesMonthly }}</div>
                        <div class="text-gray-500 text-sm mt-2">This month</div>
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Session Time</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalSessionsTime }}</div>
                        <div class="text-gray-500 text-sm mt-2">All the time</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Session Time</div>
                            <div class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">{{ $totalSessionsTimeMonthlyPercentage }}%</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalSessionsTimeMonthly }}</div>
                        <div class="text-gray-500 text-sm mt-2">Monthly</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6 h-[180px]">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-semibold text-gray-800">Product Sales</div>
                        </div>
                        <div class="text-4xl font-bold text-gray-800 mt-2">{{ $totalProductSales }}</div>
                        <div class="text-gray-500 text-sm mt-2">All the time</div>
                    </div>

                </div>
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
