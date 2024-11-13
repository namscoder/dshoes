@extends('templates.layout_admin')
@section('content')
<div class="action">
    @if (Session::has('success'))
        <strong style="color: green">{{ Session::get('success') }}</strong>
    @endif
    <form action="{{ route('add_user') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="text-align: center">{{ $title }}</h1>
        <div class="col-lg-12 col-sm-12">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
            <span class="@error('name') is-valid  @enderror" style="color: red" >{{ $errors->first('name') }}</span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
                <span class="@error('email') is-valid  @enderror" style="color: red" >{{ $errors->first('email') }}</span>
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control">
                <span class="@error('phone_number') is-valid  @enderror" style="color: red" >{{ $errors->first('phone_number') }}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Password Confirm</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <span class="@error('password') is-valid  @enderror" style="color: red" >{{ $errors->first('password') }}</span>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
                <span class="@error('address') is-valid  @enderror" style="color: red" >{{ $errors->first('address') }}</span>
            </div>
            <div class="col-lg-6 col-sm-12">
                <label for="" class="form-label">Birthday</label>
                <input type="date" name="birthday" class="form-control">
                <span class="@error('birthday') is-valid  @enderror" style="color: red" >{{ $errors->first('birthday') }}</span>

            </div>
        </div>
       
        <div class="mb-3">
            <label for="" class="form-label">Gender</label>
            <div style="margin-left: 30px">
                <div class="form-check">
                    <input class="form-check-input"  type="radio" name="gender" value="1" id="gioitinh1">
                    <label class="form-check-label" for="gioitinh1">
                      Nam
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="0" id="gioitinh2">
                    <label class="form-check-label" for="gioitinh2">
                      Nữ
                    </label>
                </div>
            </div>
            <span class="@error('gender') is-valid  @enderror" style="color: red" >{{ $errors->first('gender') }}</span>

        </div>
        <div class="mb-3">
            <img id="anh_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
            <input type="file" name="image" accept="image/*"
                    class="form-control-file @error('image') is-invalid @enderror" id="cmt_anh">
            <label for="cmt_anh">Image</label><br/>
            <span class="@error('image') is-valid  @enderror" style="color: red" >{{ $errors->first('image') }}</span>

        </div>
        <div class="gap-2 col-2  mx-auto">
            <button class="btn btn-primary ">Save</button>
            <a href="{{ route('users') }}" class="btn btn-primary">List User</a>
        </div>
    </form>
</div>
  
@endsection