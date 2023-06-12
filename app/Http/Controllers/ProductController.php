<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('manage everything');

        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function show($id)
    {
        $this->authorize('manage everything');

        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function create()
    {
        $this->authorize('manage everything');

        return view('product.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage everything');

        $product = Product::create($request->all());
        return redirect()->route('products.show', $product->id);
    }

    public function edit($id)
    {
        $this->authorize('manage everything');

        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage everything');

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.show', $product->id);
    }

    public function destroy($id)
    {
        $this->authorize('manage everything');

        Product::destroy($id);
        return redirect()->route('products.index');
    }
}
