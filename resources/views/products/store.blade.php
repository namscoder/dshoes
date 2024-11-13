@extends('templates.layout_admin')
@section('content')
<div class="action">
    @if (Session::has('success'))
        <strong style="color: green">{{ Session::get('success') }}</strong>
    @endif
    <form action="{{ route('add_product') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="text-align: center">{{ $title }}</h1>
        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
            <span class="@error('name') is-valid  @enderror" style="color: red" >{{ $errors->first('name') }}</span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Price</label>
                <input type="text" name="price" class="form-control">
                <span class="@error('price') is-valid  @enderror" style="color: red" >{{ $errors->first('price') }}</span>
            </div>

        </div>
        <div class="form-floating col-lg-12 col-sm-12">
            <select class="form-select" id="floatingSelect" name="category_id" aria-label="Floating label select example">
            <option value="">none</option>
            @foreach ($categories as $cate)
                <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
            @endforeach
            </select>
            <label for="floatingSelect">Category</label>
        </div>
        <span class="@error('category_id') is-valid  @enderror" style="color: red" >{{ $errors->first('category_id') }}</span>
        <div class="mb-3">
            <img id="anh_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
            <input type="file" name="image" accept="image/*"
                    class="form-control-file @error('image') is-invalid @enderror" id="cmt_anh">
            <label for="cmt_anh">Image</label><br/>
            <span class="@error('image') is-valid  @enderror" style="color: red" >{{ $errors->first('image') }}</span>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Albums:</label>
            <input type="file" name="list_image[]" class="form-control @error('list_image.*') is-invalid @enderror" multiple>
        </div>
        <span class="@error('list_image.*') is-valid  @enderror" style="color: red" >{{ $errors->first('list_image.*') }}</span>
        <span class="@error('list_image') is-valid  @enderror" style="color: red" >{{ $errors->first('list_image') }}</span>

        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Description</label>
            <textarea name="description" id="" cols="30" class="form-control" rows="5"></textarea>
            <span class="@error('description') is-valid  @enderror" style="color: red" >{{ $errors->first('description') }}</span>
        </div>

        {{-- Thông tin các biến thể --}}
        <div id="variants-container">
            <h4>Product Variants</h4>
            <button class="btn btn-primary" type="button" onclick="addVariant()">Add Variant</button>
        </div>

        <div class="gap-2 col-2  mx-auto">
            <button class="btn btn-primary ">Save</button>
            <a href="{{ route('products') }}" class="btn btn-primary">List Product</a>
        </div>
    </form>
</div>
<script>
    function addVariant() {
        const container = document.getElementById('variants-container');
        const variantHTML = `
            <div class="variant">
                <label>Price:</label>
                <input type="number" name="variants[][price]" required>
                <label>Size:</label>
                <input type="text" name="variants[][size]" required>
                <label>Quantity:</label>
                <input type="number" name="variants[][quantity]" required>
                <button type="button" onclick="this.parentNode.remove()">Remove</button>
            </div>`;
        container.insertAdjacentHTML('beforeend', variantHTML);
    }
</script>
@endsection
