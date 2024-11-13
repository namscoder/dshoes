@extends('templates.layout_admin')
@section('content')
<div class="content_admin">
    @if (Session::has('success'))
    <strong style="color: green">{{ Session::get('success') }}</strong> <br>
@endif
<a href="{{ route('add_product') }}" class="btn btn-outline-primary">Add Product</a>
    <table class="table ">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img src="{{ $product->image ? Storage::url($product->image) : "" }}"
                        style="height: 100px; width: 100px; border-radius: 50%" alt="" srcset="">
                    </td>
                    <td class="text-truncate" style="max-width: 300px;">{{ $product->description }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('edit_product',['id'=>$product->id]) }}">Edit</a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Do you want to delete this product?')" href="{{ route('delete_product',['id'=>$product->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{  $products->links()  }}
</div>
@endsection
