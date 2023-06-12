@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="internal_name">Internal Name:</label>
            <input type="text" id="internal_name" name="internal_name">
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price">
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="text" id="image" name="image">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
