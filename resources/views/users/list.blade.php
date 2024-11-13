@extends('templates.layout_admin')
@section('content')
    <div class="content_admin">
        @if (Session::has('success'))
            <strong style="color: green">{{ Session::get('success') }}</strong> <br>
        @endif
        <a href="{{ route('add_user') }}" class="btn btn-outline-primary">Add User</a>
        <table class="table ">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td style="width: 15em !important; word-break: break-all">{{ $user->password }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->gender == 0 ? "Nữ":"Nam" }}</td>
                        <td>{{ $user->role == 0 ? "Khách Hàng":"Admin"}}</td>
                        <td>
                            <img src="{{ $user->image ? Storage::url($user->image) : "" }}" 
                            style="height: 100px; width: 100px; border-radius: 50%" alt="" srcset="">
                        </td>
                        <td>
                            <a class="btn btn-outline-warning" href="{{ route('edit_user',['id'=>$user->id]) }}">Edit</a>
                            <a class="btn btn-outline-danger" onclick="return confirm('Do you want to delete this user?')" href="{{ route('delete_user',['id'=>$user->id]) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection