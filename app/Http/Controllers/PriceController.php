<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPricing;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $this->authorize('manage everything');

        $prices = Price::all();
        foreach ($prices as $price) {
            $price->itemPricing();
        }
        return view('price.index', compact('prices'));
    }

    public function show($id)
    {
        $this->authorize('manage everything');

        $price = Price::findOrFail($id);
        return view('price.show', compact('price'));
    }

    public function create()
    {
        $this->authorize('manage everything');

        $itemPricings = ItemPricing::enabled()->get();
        return view('price.create', compact('itemPricings'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage everything');

        $price = Price::create($request->all());
        return redirect()->route('prices.show', $price->id);
    }

    public function edit($id)
    {
        $this->authorize('manage everything');

        $price = Price::findOrFail($id);
        $itemPricings = ItemPricing::all();
        return view('price.edit', compact('price', 'itemPricings'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage everything');

        $price = Price::findOrFail($id);
        $price->update($request->all());
        return redirect()->route('prices.show', $price->id);
    }

    public function destroy($id)
    {
        $this->authorize('manage everything');

        Price::destroy($id);
        return redirect()->route('prices.index');
    }

    public function getPricesFromItem($id)
    {
        $itemPricing = Item::find($id)->itemPricing;

        $prices = Price::where('item_pricing_id', $itemPricing->id)->get();
        return response()->json($prices);
    }
}
