@extends('templates.layout_admin')
@section('content')
<div class="content_admin">
    @if (Session::has('success'))
    <strong style="color: green">{{ Session::get('success') }}</strong> <br>
@endif
<a href="{{ route('add_book') }}" class="btn btn-outline-primary">Add Book</a>
    <table class="table ">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Promotion Price</th>
                <th>Quantity</th>
                <th>Publishing Year</th>
                <th>Publisher</th>
                <th>Author</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->book_title }}</td>
                    <td>{{ $book->category_name }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->promotion_price ?? 0 }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->publishing_year }}</td>
                    <td>{{ $book->publisher_name}}</td>
                    <td><?= $authors=($book->author_name); ?></td>
                    <td>
                        <img src="{{ $book->image ? Storage::url($book->image) : "" }}" 
                        style="height: 100px; width: 100px; border-radius: 50%" alt="" srcset="">
                    </td>
                    <td class="text-truncate" style="max-width: 300px;">{{ $book->description }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('edit_book',['id'=>$book->id]) }}">Edit</a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Do you want to delete this book?')" href="{{ route('delete_book',['id'=>$book->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{  $books->links()  }} 
</div>
@endsection