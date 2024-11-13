<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_outstandings = DB::table('products')
            ->leftjoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->whereNull('products.deleted_at')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                DB::raw('avg(reviews.rating) as avg_rating'),
                DB::raw('count(reviews.id) as total_reviews')
            )
            ->where('rating', '>=', 3)
            ->groupBy('products.id', 'products.name', 'products.price', 'products.image')
            ->orderBy('avg_rating', 'desc')
            ->paginate(10);

        $new_products = DB::table('products')
            ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->whereNull('products.deleted_at')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                DB::raw('avg(reviews.rating) as avg_rating'),
                DB::raw('count(reviews.id) as total_reviews')
            )
            ->groupBy('products.id', 'products.name', 'products.price','products.image')
            ->orderBy('products.id', 'desc')
            ->paginate(10);


        return view('clients.home', compact(['product_outstandings', 'new_products']));
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
