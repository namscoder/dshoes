@extends('templates.layout_admin')
@section('content')
<div class="action">
    @if (Session::has('success'))
        <strong style="color: green">{{ Session::get('success') }}</strong>
    @endif
    <form action="{{ route('add_book') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="text-align: center">{{ $title }}</h1>
        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Book Title</label>
            <input type="text" name="book_title" class="form-control">
            <span class="@error('book_title') is-valid  @enderror" style="color: red" >{{ $errors->first('book_title') }}</span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Price</label>
                <input type="text" name="price" class="form-control">
                <span class="@error('price') is-valid  @enderror" style="color: red" >{{ $errors->first('price') }}</span>
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Promotion Price</label>
                <input type="text" name="promotion_price" class="form-control" value="0">
                <span class="@error('promotion_price') is-valid  @enderror" style="color: red" >{{ $errors->first('promotion_price') }}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control">
                <span class="@error('quantity') is-valid  @enderror" style="color: red" >{{ $errors->first('quantity') }}</span>
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Publishing Year</label>
                <input type="text" name="publishing_year" class="form-control">
                <span class="@error('publishing_year') is-valid  @enderror" style="color: red" >{{ $errors->first('publishing_year') }}</span>
            </div>
        </div> 
        <div class="form-floating col-lg-12 col-sm-12">
            <select class="form-select" id="floatingSelect" name="cate_id" aria-label="Floating label select example">
            <option value="">none</option>
            @foreach ($categories as $cate)
                <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
            @endforeach
            </select>
            <label for="floatingSelect">Book Category</label>
        </div>
        <span class="@error('cate_id') is-valid  @enderror" style="color: red" >{{ $errors->first('cate_id') }}</span>
        <div class="form-floating col-lg-12 col-sm-12 author">
            <select class="form-select" id="author" multiple="multiple" name="author_id[]" >
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
            @endforeach
            </select>
            <label for="author">Book Author</label>
        </div>
        <span class="@error('author_id') is-valid  @enderror" style="color: red" >{{ $errors->first('author_id') }}</span>
        <div class="form-floating col-lg-12 col-sm-12">
            <select class="form-select" id="floatingSelect" name="publisher_id" aria-label="Floating label select example">
            <option value="">none</option>
            @foreach ($publishers as $publisher)
                <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
            @endforeach
            </select>
            <label for="floatingSelect">Book Publisher</label>
        </div>
        <span class="@error('publisher_id') is-valid  @enderror" style="color: red" >{{ $errors->first('publisher_id') }}</span>
        <div class="mb-3">
            <img id="anh_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
            <input type="file" name="image" accept="image/*"
                    class="form-control-file @error('image') is-invalid @enderror" id="cmt_anh">
            <label for="cmt_anh">Image</label><br/>
            <span class="@error('image') is-valid  @enderror" style="color: red" >{{ $errors->first('image') }}</span>
        </div>
        <div class="mb-3">
            <label class="form-label">Book Albums:</label>
            <input type="file" name="list_image[]" class="form-control @error('list_image.*') is-invalid @enderror" multiple>
        </div>
        <span class="@error('list_image.*') is-valid  @enderror" style="color: red" >{{ $errors->first('list_image.*') }}</span>
        <span class="@error('list_image') is-valid  @enderror" style="color: red" >{{ $errors->first('list_image') }}</span>

        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Description</label>
            <textarea name="description" id="" cols="30" class="form-control" rows="5"></textarea>
            <span class="@error('description') is-valid  @enderror" style="color: red" >{{ $errors->first('description') }}</span>
        </div>

        <div class="gap-2 col-2  mx-auto">
            <button class="btn btn-primary ">Save</button>
            <a href="{{ route('books') }}" class="btn btn-primary">List Book</a>
        </div>
    </form>
</div>
  
@endsection