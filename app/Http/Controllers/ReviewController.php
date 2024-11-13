<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $review = DB::table('reviews')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $data['product_id'])
            ->first();
        $data['user_id'] = Auth::user()->id;
        if ($review) {
            Session::flash('errors', 'Bạn đã bình luận cho sản phẩm này rồi');
            return redirect()->back();
        } else {
            $review_add = Review::create($data);
            if ($review_add) {
                Session::flash('success', 'Bình luận sản phẩm thành công');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
