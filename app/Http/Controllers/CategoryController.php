<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        $title = "List of Category";
        return view('categories.list',compact(['categories', 'title']));
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
    public function store(CategoryRequest $request)
    {
        $title = "Add Category";
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            $category = Category::create($params);
            if ($category->id) {
                Session::flash('success', 'Add new Category Successfully');
            }
        }
        $categories = Category::all();
        return view('categories.store', compact(['title', 'categories']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $title = "Update Book Category";
        $category = DB::table('categories')->where('id', $id)->first();


        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            $category = Category::where('id', $id)->update($params);
            if ($category) {
                Session::flash('success', 'Update Category Successfully');
                return redirect()->route('edit_category', ['id' => $id]);
            }
        }

        $categories = Category::all();
        return view('categories.update', compact(['title', 'category', 'categories']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
