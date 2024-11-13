<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //đơn hàng đã thanh toán
        $paid_order = DB::table("orders")->where('status', '=', 1)->count();
        // Lấy tháng hiện tại
        $currentMonth = Carbon::now()->month;

        // Lấy tổng số người đăng ký trong tháng hiện tại
        $new_user = User::whereMonth('created_at', $currentMonth)->count();

        // sách đã bán
        $book_sold = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', '=', 1)
            ->sum('order_details.quantity');
        $total_sales = DB::table('orders')
            ->where('status', '=', 1)
            ->sum('total_money');
        // người dùng đăng ký gần đây
        $recently_user = User::where('role', '=', 0)->latest()->limit(3)->get();

        // Đơn hàng gần đây
        $recently_order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('orders.created_at', 'desc')
            ->select('users.name', 'users.image', 'orders.created_at', 'orders.status', 'orders.delivery')
            ->limit(3)
            ->get();
        return view("dashboard", compact(['paid_order', 'new_user', 'book_sold', 'total_sales', 'recently_user', 'recently_order']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
