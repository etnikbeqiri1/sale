<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPricing;
use App\Models\Price;
use Illuminate\Http\Request;

class ItemPricingController extends Controller
{
    public function index()
    {
        $this->authorize('manage everything');

        $itemPricings = ItemPricing::all();
        return view('item_pricing.index', compact('itemPricings'));
    }

    public function show($id)
    {
        $this->authorize('manage everything');

        $itemPricing = ItemPricing::findOrFail($id);
        return view('item_pricing.show', compact('itemPricing'));
    }

    public function create()
    {
        $this->authorize('manage everything');

        return view('item_pricing.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage everything');

        $itemPricing = ItemPricing::create($request->all());
        return redirect()->route('item_pricings.show', $itemPricing->id);
    }

    public function edit($id)
    {
        $this->authorize('manage everything');

        $itemPricing = ItemPricing::findOrFail($id);
        return view('item_pricing.edit', compact('itemPricing'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage everything');

        $itemPricing = ItemPricing::findOrFail($id);
        $itemPricing->update($request->all());
        return redirect()->route('item_pricings.show', $itemPricing->id);
    }

    public function destroy($id)
    {
        $this->authorize('manage everything');

        ItemPricing::destroy($id);
        return redirect()->route('item_pricings.index');
    }
}
