<tr class="bg-white border-b hover:bg-gray-50">
    <td class="m-4 pl-2">
        <img class="object-contain h-16 w-10" src="{{ $product->image }}"
             alt="{{$product->name}}">
    </td>
    <td class="px-6 py-4 font-semibold text-gray-800">
        {{ $product->name }}
    </td>
    <td class="px-6 py-4">
        <div class="flex items-center space-x-3">
            {{ $product->pivot->number_of_items }}
        </div>
    </td>
    <td class="px-6 py-4 text-gray-900">
        <div class="flex items-center space-x-3">
            {{ $product->price }}€
        </div>
    </td>
    <td class="px-6 py-4 font-bold">
        <div class="flex items-center space-x-3">
            {{ $product->pivot->number_of_items * $product->price }}€
        </div>
    </td>
    <td class="px-6 py-4">
        <span
            class="bg-gray-100 text-gray-600 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
            {{ $product->pivot->created_at->format('H:i:s, D, F j') }}
        </span>
    </td>

</tr>
