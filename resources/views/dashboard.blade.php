@extends('templates.layout_admin')
@section('content')
<div class="header">
    <div class="left">
        <h1>Dashboard</h1>
        <ul class="breadcrumb">
            <li><a href="#">
                    Dashboard
                </a></li>
            /
            <li><a href="#" class="active">T-Book</a></li>
        </ul>
    </div>

</div>

<!-- Insights -->
<ul class="insights">
    <li>
        <i class='bx bx-calendar-check'></i>
        <span class="info">
            <h3>
                {{ $paid_order }}
            </h3>
            <p>Paid Order</p>
        </span>
    </li>
    <li><i class='bx bx-group'></i>
        <span class="info">
            <h3>
                {{ $new_user }}
            </h3>
            <p>New users during the month</p>
        </span>
    </li>
    <li><i class='bx bx-book-alt'></i>
        <span class="info">
            <h3>
                {{ $book_sold }}
            </h3>
            <p>Books Sold</p>
        </span>
    </li>
    <li><i class='bx bx-dollar-circle'></i>
        <span class="info">
            <h3>
                {{number_format($total_sales, 0, '', ',')  }}đ
            </h3>
            <p>Total Sales</p>
        </span>
    </li>
</ul>
<!-- End of Insights -->

<div class="bottom-data">
    <!-- New Users -->
    <div class="orders">
        <div class="header">
            <i class='bx bx-group'></i>
            <h3>Recently Registered Users</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-plus'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Image</th>
                    <th>Birthday</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recently_user as $user)
                    <tr>
                        <td>
                            <p>{{ $user->name }}</p>
                        </td>
                        <td>
                            <img src="{{ Storage::url($user->image) }}">
                        </td>
                        <td>{{ (new DateTime($user->birthday))->format('d-m-Y') }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->role == 0 ? 'Nữ' : 'Nam' }}</td>
                        <td>{{ (new DateTime($user->created_at))->format('d-m-Y') }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>

    <!-- End of New Users-->
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Recent Orders</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recently_order as $order)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($order->image) }}">
                            <p>{{ $order->name }}</p>
                        </td>
                        <td>{{ (new DateTime($order->created_at))->format('d-m-Y') }}</td>
                        <td>
                            @if ($order->delivery == 0 && $order->delivery != 4)
                                <span class="status pending">Pending</span>
                            @elseif ($order->delivery == 1 || $order->delivery == 2)
                                <span class="status process">Processing</span>
                            @elseif($order->delivery == 3)
                                <span class="status completed">Completed</span>
                            @elseif($order->delivery == 4)
                                <span class="status destroyed">destroyed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection