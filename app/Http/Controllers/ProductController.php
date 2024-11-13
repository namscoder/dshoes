<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\List_Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name')
            ->where('products.deleted_at', null)
            ->orderBy('products.id', 'desc')
            ->paginate(10);
        return view('products.list', compact('products'));
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
    public function store(ProductRequest $request)
    {

        $categories = Category::all();
        $title = "Add New Product";
        $list_images = [];

        if ($request->method('POST')) {

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $filePath = $request->file('image')->store('images', 'public'); // Lưu file vào thư mục public/images
                $request->image = $filePath;
                $params = $request->except('_token', 'image');
                $params['image'] = $filePath;
                $product = Product::create($params);
                if ($product->id) {
                    if ($request->list_image) {
                        foreach ($request->list_image as $key => $value) {
                            $filePath = $value->store('images', 'public');
                            $list_images[] = $filePath;
                        }
                        for ($i = 0; $i < count($list_images); $i++) {
                            $image = [
                                'image' => $list_images[$i],
                                'product_id' => $product->id
                            ];
                            $images = List_Image::create($image);
                        }
                    }
                    //add variant
                    if ($request->variants) {
                        foreach ($request->variants as $variant) {
                            if (isset($variant['price'], $variant['size'], $variant['quantity'])) {
                                $product->variants()->create([
                                    'price' => $variant['price'],
                                    'size' => $variant['size'],
                                    'quantity' => $variant['quantity']
                                ]);
                            }
                        }
                    }

                    Session::flash('success', "Add Successfully");
                }
            }
        }
        return view('products.store', compact(['categories', 'title']));
    }

    public function delete_image($id)
    { //xóa ảnh ở phần cập nhật khi click vào dấu x
        $image = DB::table('list_images')->where('id', $id)->first();
        if (Storage::exists('/public/', $image->image)) {
            $resultDL = Storage::delete('/public/' . $image->image);
        }
        List_Image::where('id', $id)->delete();
        Session::flash('success', "Delete image in List image successfully");
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $title = "Update Product";
        $categories = Category::all();
        $list_images = DB::table('list_images')->where('product_id', $id)->where('deleted_at', null)->get(); //lấy list ảnh của sách
    $product = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id',$id)
        ->select('products.*', 'categories.category_name')
        ->first();
    //update
        if ($request->isMethod('POST')) {
            $params = $request->except('_token', 'image', 'list_image');

            //cập nhật ảnh mới thì xóa ảnh cũ
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDL = Storage::delete('/public/' . $product->image);
                if ($resultDL) {
                    $request->image = $request->file('image')->store('images', 'public');
                    $params['image'] = $request->image;
                } else {
                    $params['image'] = $product->image;
                }
            }
            $result = DB::table('products')->where('id', $id)->update($params);

            //Nếu chọn ảnh thêm vào list thì upload file
            if (!empty($request->list_image)) {
                $list_images = [];
                foreach ($request->list_image as $key => $value) {
                    if (uploadFile('image', $value))
                        $list_images[] = uploadFile('image', $value);
                }

                for ($i = 0; $i < count($list_images); $i++) {
                    $image = [
                        'image' => $list_images[$i],
                        'product_id' => $product->id
                    ];
                    $images = List_Image::create($image);
                }
            }
            Session::flash('success', "Update Successfully");
            return redirect()->route('edit_product', ['id' => $id]);
        }
        return view('products.update', compact(['title', 'product', 'categories', 'list_images']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
