@extends('layouts.app')

@section('content')
    <h1>Product List</h1>
    <a href="{{ route('products.create') }}">Create</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Internal Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Stock</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->internal_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->image }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
