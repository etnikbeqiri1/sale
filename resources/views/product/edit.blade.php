@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}">
        </div>
        <div>
            <label for="internal_name">Internal Name:</label>
            <input type="text" id="internal_name" name="internal_name" value="{{ $product->internal_name }}">
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}">
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="text" id="image" name="image" value="{{ $product->image }}">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ $product->stock }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
