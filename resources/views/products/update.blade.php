@extends('templates.layout_admin')
@section('content')
<div class="action">
    @if (Session::has('success'))
        <strong style="color: green">{{ Session::get('success') }}</strong>
    @endif
    <form action="{{ route('edit_product',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="text-align: center">{{ $title }}</h1>
        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            <span class="@error('name') is-valid  @enderror" style="color: red" >{{ $errors->first('name') }}</span>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                <span class="@error('price') is-valid  @enderror" style="color: red" >{{ $errors->first('price') }}</span>
            </div>
        </div>


        {{-- Danh mục  --}}
        <div class="form-floating col-lg-12 col-sm-12">
            <select class="form-select" id="floatingSelect" name="category_id" aria-label="Floating label select example">
            <option value="{{ $product->category_id }}">{{ $product->category_name }}</option>
            @foreach ($categories as $cate)
                <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
            @endforeach
            </select>
            <label for="floatingSelect">Category</label>
        </div>
        <span class="@error('category_id') is-valid  @enderror" style="color: red" >{{ $errors->first('category_id') }}</span>

        {{-- Ảnh bìa sách --}}
        <div class="mb-3">
            <img id="anh_preview" src="{{ $product->image ? Storage::url($product->image) : "https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" }}" alt="your image"
                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
            <input type="file" name="image" accept="image/*"
                    class="form-control-file @error('image') is-invalid @enderror" id="cmt_anh">
            <label for="cmt_anh">Image</label><br/>
        </div>

        {{-- List ảnh sách --}}
        <div class="mb-3">
            <label class="form-label">Product Albums:</label>
            <input type="file" name="list_image[]" class="form-control @error('list_image.*') is-invalid @enderror" multiple>
        </div>

        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Description</label>
            <textarea name="description" id="" cols="30" class="form-control" rows="5">{{ $product->description }}</textarea>
            <span class="@error('description') is-valid  @enderror" style="color: red" >{{ $errors->first('description') }}</span>
        </div>

        <div class="gap-2 col-2  mx-auto">
            <button class="btn btn-primary ">Save</button>
            <a href="{{ route('products') }}" class="btn btn-primary">List Product</a>
        </div>
    </form>

    {{-- Xóa ảnh trong list ảnh của sách --}}
    <div style="margin-top: 50px">
        <h1 style="text-align: center">Update List Image</h1>
        @foreach ($list_images as $image)
            <figure class="figure" style="margin-right:10px ">
                <img src="{{ Storage::url($image->image) }}" alt="your image"
                style="max-width: 100px; height:100px; margin-bottom: 10px;" class="figure-img img-fluid rounded"/>
                <figcaption class="figure-caption text-center"><a href="{{ route('delete_image',['id'=>$image->id]) }}" class="btn text-danger"><i class='bx bx-x'></i></a></figcaption>
            </figure>
        @endforeach
    </div>

</div>

@endsection
