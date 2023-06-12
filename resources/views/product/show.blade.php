@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>
    <ul>
        <li><strong>ID:</strong> {{ $product->id }}</li>
        <li><strong>Name:</strong> {{ $product->name }}</li>
        <li><strong>Internal Name:</strong> {{ $product->internal_name }}</li>
        <li><strong>Price:</strong> {{ $product->price }}</li>
        <li><strong>Image:</strong> {{ $product->image }}</li>
        <li><strong>Stock:</strong> {{ $product->stock }}</li>
        <li><strong>Created At:</strong> {{ $product->created_at }}</li>
        <li><strong>Updated At:</strong> {{ $product->updated_at }}</li>
    </ul>
@endsection
