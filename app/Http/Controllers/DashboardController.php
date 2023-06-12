<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Price;
use App\Models\Product;
use App\Models\Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $queryName = $request->get('name');
        if ($queryName !== null) {
            $items = Item::where(['enabled' => 1])->orderBy('state', 'desc')->where('name', 'like', '%' . $queryName . '%')->get();
        } else {
            $items = Item::where(['enabled' => 1])->orderBy('state', 'desc')->get();
        }

        $sessions = Session::where(['paid' => 0, 'ended_at' => null])->get();
        $prices = Price::where(['enabled' => 1])->get();
        $products = Product::where('stock', '>=', 1)->get();

        foreach ($items as $item) {
            /*  @var Item $item */

            if ($item->state === 0) {
                $itemPricingId = $item->item_pricing_id;
                $item->prices = array_filter($prices->toArray(), function ($item) {
                    return $item['item_pricing_id'] === 8;
                });
                $item->pastSession = $item->sessions()->orderBy('ended_at', 'desc')->first();

            } else {
                $session = $sessions->where('item_id', $item->id)->first();
                $item->price = $prices->where('id', $session->price_id)->first();
                $item->session = $session;
                $allProductPrice = 0;
                $productNumber = 0;
                foreach ($session->products as $product) {
                    $allProductPrice += $product->pivot->number_of_items * $product->price;
                    $productNumber += $product->pivot->number_of_items;
                }
                $item->allProductPrice = $allProductPrice;
                $item->productNumber = $productNumber;
            }

        }
        return view('dashboard', compact('items', 'products', 'queryName'));
    }


}
