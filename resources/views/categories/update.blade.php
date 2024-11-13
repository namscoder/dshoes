@extends('templates.layout_admin')
@section('content')
<div class="action">
    @if (Session::has('success'))
        <strong style="color: green">{{ Session::get('success') }}</strong>
    @endif
    <form action="{{ route('edit_category',['id'=>$category->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="text-align: center">{{ $title }}</h1>
            <div class="col-lg-6 col-sm-12 mx-auto">
                <label for="" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                <span class="@error('category_name') is-valid  @enderror" style="color: red" >{{ $errors->first('category_name') }}</span>
            </div>
            <div class="col-lg-6 col-sm-12 mx-auto">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" cols="30" class="form-control" rows="5">{{ $category->description }}</textarea>
                <span class="@error('description') is-valid  @enderror" style="color: red" >{{ $errors->first('description') }}</span>
            </div>
            <div class="form-floating col-lg-6 col-sm-12 mx-auto">
                <select class="form-select" id="floatingSelect" name="cate_id" aria-label="Floating label select example">
                    @if ($parent)
                        <option  value="{{ $parent->id }}">{{ $parent->category_name }}</option> 
                    @else
                        <option value="">None</option> 
                    @endif
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                     @endforeach
                </select>
                <label for="floatingSelect">Parent Category</label>
                <span style="color: red" >{{ $m ? $m :''}}</span>
            </div>
        <div class="gap-2 col-2  mx-auto">
            <button class="btn btn-primary ">Save</button>
            <a href="{{ route('categories') }}" class="btn btn-primary">List Category</a>
        </div>
    </form>
</div>
  
@endsection