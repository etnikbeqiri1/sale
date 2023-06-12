<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPricing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index()
    {
        $this->authorize('manage everything');
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    public function show($id)
    {
        $this->authorize('manage everything');

        $item = Item::findOrFail($id);
        return view('item.show', compact('item'));
    }

    public function create()
    {
        $this->authorize('manage everything');

        $itemPricings = ItemPricing::enabled()->get();
        return view('item.create', compact('itemPricings'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage everything');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'enabled' => 'nullable|boolean',
            'item_pricing_id' => [
                'required',
                Rule::in(ItemPricing::enabled()->pluck('id')->toArray()),
            ],
        ]);

        $item = Item::create($validatedData);
        return redirect()->route('items.show', $item->id);
    }

    public function edit($id)
    {
        $this->authorize('manage everything');

        $item = Item::findOrFail($id);
        $itemPricings = ItemPricing::enabled()->get();
        return view('item.edit', compact('item', 'itemPricings'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage everything');

        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'enabled' => 'nullable|boolean',
            'item_pricing_id' => [
                'required',
                Rule::in(ItemPricing::enabled()->pluck('id')->toArray()),
            ],
        ]);

        $item->update($validatedData);
        return redirect()->route('items.show', $item->id);
    }

    public function destroy($id)
    {
        $this->authorize('manage everything');

        Item::destroy($id);
        return redirect()->route('items.index');
    }
}
