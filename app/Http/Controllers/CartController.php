<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->whereNull('carts.deleted_at')
            ->where('carts.user_id', Auth::user()->id)
            ->select('carts.*', 'products.name', 'products.price', 'products.image')
            ->get();
        return view("clients.cart", compact("carts"));
    }

    public function add_to_cart(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $cart = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            if (isset($request->quantity)) {
                $carts = DB::table('carts')->where('id', '=', $cart->id)->update(['quantity' => $cart->quantity + $request->quantity]);
            } else {
                $carts = DB::table('carts')->where('id', '=', $cart->id)->update(['quantity' => $cart->quantity + 1]);
            }
        } else {
            if (isset($request->quantity)) {
                $data = [
                    'product_id' => $id,
                    'quantity' => $request->quantity,
                    'price' => $product->promotion_price ? $product->promotion_price : $product->price,
                    'user_id' => Auth::user()->id
                ];
            } else {
                $data = [
                    'product_id' => $id,
                    'quantity' => 1,
                    'price' => $product->promotion_price ? $product->promotion_price : $product->price,
                    'user_id' => Auth::user()->id
                ];
            }

            $carts = Cart::create($data);
        }
        if ($carts) {
            return redirect()->back();
        }
    }
    public function descrease_quantity(Request $request, $id)
    {
        $cart = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();
        $ud = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->update(['quantity' => $cart->quantity - 1]);
        if ($ud) {
            Session::flash('success', 'Cập nhật số lượng thành công');
        }
        return redirect()->route("cart");
    }
    public function increase_quantity(Request $request, $id)
    {
        $cart = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();
        $ud = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->update(['quantity' => $cart->quantity + 1]);
        if ($ud) {
            Session::flash('success', 'Cập nhật số lượng thành công');
        }
        return redirect()->route("cart");
    }
    public function delete_product_cart(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->delete();
        if ($cart) {
            Session::flash('success_dl', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        }
        return redirect()->route("cart");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function payment_page(Request $request)
    {
        $button = $request->input('submitButton');
        // Xử lý theo giá trị của nút bấm
        switch ($button) {
            case 'payment':
                $products = [];
                $total_money = 0;
                foreach ($request->product_ids as $key => $value) {
                    $product = DB::table('carts')
                        ->join('products', 'products.id', '=', 'carts.product_id')
                        ->where('user_id', Auth::user()->id)
                        ->where('product_id', $key)
                        ->select('carts.*', 'products.name', 'products.price',  'products.image')
                        ->first();
                    $products[] = $product;
                    $total_money += $product->quantity * ($product->price);
                }
                $user = Auth::user();

                $promotions_used = Order::where('user_id', Auth::user()->id)->where('discount_code', '!=', '')->get();
                $promotions_use = [];
                foreach ($promotions_used as $promotion) {
                    $promotions_use[] = $promotion->discount_code;
                }
                $promotions = DB::table('promotions')->whereNotIn('discount_code', $promotions_use)->get();

                return view('clients.payment_page', compact(['products', 'user', 'total_money', 'promotions']));
                break;
            case 'delete':
                // Hiển thị dữ liệu ra màn hình
                foreach ($request->product_ids as $key => $value) {
                    $product_dl = Cart::join('products', 'products.id', '=', 'carts.product_id')
                        ->where('user_id', Auth::user()->id)
                        ->where('product_id', $key)
                        ->delete();
                }
                return redirect()->back();
                break;
        }
    }
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
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
