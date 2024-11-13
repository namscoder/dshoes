@extends('templates.layout_admin')
@section('content')
    <div class="content_admin">
        @if (Session::has('success'))
            <strong style="color: green">{{ Session::get('success') }}</strong> <br>
        @endif
        <a href="{{ route('add_category') }}" class="btn btn-outline-primary">Add Category</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $cate)
    {{--                <span class="visually-hidden">{{ $a[$cate->id] = $cate->category_name }}</span>--}}
                <tr>
                    <td>{{ $cate->id }}</td>
                    <td>{{ $cate->category_name }}</td>
                    <td>{{ $cate->description }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('edit_category',['id'=>$cate->id]) }}">Edit</a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Do you want to delete this categoryDo you want to delete this category? Would that also delete other categories that are subcategories of this category?')"
                           href="{{ route('delete_category',['id'=>$cate->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>

@endsection
