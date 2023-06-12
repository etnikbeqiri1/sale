<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use App\Models\SessionProduct;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Item;

class SessionController extends Controller
{
    public function create()
    {
        $prices = Price::all();
        $items = Item::where(['state' => 0, 'enabled' => 1])->get();

        return view('sessions.create', compact('prices', 'items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'price_id' => 'required',
            'item_id' => 'required',
        ]);

        $item = Item::find($request->item_id);

        if($item->state == 1) {
            return redirect()->back()->with('error', 'Item already in use');
        }

        $item->state = 1;
        $item->save();

        $session = new Session;
        $session->fill($request->all());
        $session->save();

        return redirect()->route('dashboard')->with('success', 'Session created successfully');
    }

    public function getActiveSessions()
    {
        $activeSessions = Session::whereNull('ended_at')->get();
        $now = new DateTime();
        return view('sessions.active', compact('activeSessions', 'now'));
    }

    public function stop($id)
    {
        $session = Session::find($id);

        if(!$session) {
            return redirect()->back()->with('error', 'Session not found');
        }

        $formattedPrice = $this->calculateSessionPrice($session);


        return view('sessions.stop', compact('session', 'formattedPrice'));
    }

    private function calculateSessionPrice(Session $session){
        $durationInMinutes = $session->started_at->diffInMinutes(now());
        $pricePerHour = $session->price->price;
        $price = $durationInMinutes / 60 * $pricePerHour;

        $minPrice = $session->price->start_price;

        $roundedPrice = ceil($price / 0.05) * 0.05; // Round up to the nearest 0.05 increment
        $price = max($roundedPrice, $minPrice); // Ensure the price is at least the minimum price

        return number_format((float)$price, 2, '.', '');

    }

    public function stopSession(Request $request, $id)
    {
        $session = Session::find($id);

        if(!$session) {
            return redirect()->back()->with('error', 'Session not found');
        }

        $session->ended_at = now();
        $session->paid = true;
        $session->duration = $session->started_at->diffInMinutes(now());
        $session->save();

        $item = Item::find($session->item_id);
        $item->state = 0;
        $item->save();

        return redirect()->route('dashboard')->with('success', 'Session ended successfully');
    }

    public function addProductToSession(Request $request, $sessionId)
    {
        // Check if the session state is 1
        $session = Session::findOrFail($sessionId);
        if ($session->endedAt !== null) {
            return response()->json(['message' => 'Session state not active'], 422);
        }

        // Iterate over each item in the JSON request
        $data = $request->json()->all()['data'];

        foreach ($data as $item) {
            // Extract item ID and number of items from the JSON
            $productId = $item['id'];
            $numberOfItems = $item['number_of_items'];

            // Check if the product with the given ID exists
            $product = Product::findOrFail($productId);

            // Check if the product has enough stock
            if ($product->stock < $numberOfItems) {
                return response()->json(['message' => 'Insufficient stock for product: ' . $product->name], 422);
            }

            // Check if the session already has the product
            $sessionProduct = SessionProduct::where('session_id', $sessionId)
                                            ->where('product_id', $productId)
                                            ->first();

            if ($sessionProduct) {
                // Increase the number_of_items
                $sessionProduct->increment('number_of_items', $numberOfItems);
                $sessionProduct->push();
            } else {
                // Create the session-product relationship
                $sessionProduct = new SessionProduct();
                $sessionProduct->session_id = $sessionId;
                $sessionProduct->product_id = $productId;
                $sessionProduct->number_of_items = $numberOfItems;
                $sessionProduct->push();
            }

            // Deduct items from the product's stock
            $product->stock -= $numberOfItems;
            $product->push();
        }

        return response()->json(['message' => 'Products added to session successfully'], 200);
    }
}
