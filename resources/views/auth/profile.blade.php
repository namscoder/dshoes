<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Required meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Account Setting</title>
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}"> 
        <script src="https://kit.fontawesome.com/07a69f92d2.js" crossorigin="anonymous"></script>  
        <style>
            body{
                background-color: #fff;
            }
        </style> 
    </head>
    <body>
        <div class="container account">
            <div class="row">
                <div class="col-lg-3">
                    @if (Session::has('success'))
                        <strong style="color: green">{{ Session::get('success') }}</strong>
                    @endif
                    <div class="avatar mx-auto">
                        <form class="form" id = "form" action="{{ route('update_avatar') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="upload">
                                <img id="image"  src="{{ Auth::user()->image ? Storage::url(Auth::user()->image): "https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" }}" alt="your image" class="img-fluid"/>            
                      
                              <div class="rightRound" id = "upload">
                                <input type="file" name="image" id = "fileImg" accept="image/*">
                                
                                <i class="fa-solid fa-camera"></i>
                              </div>
                      
                              <div class="leftRound" id = "cancel" style = "display: none;">
                                <i class = "fa fa-times"></i>
                              </div>
                              <div class="rightRound" id = "confirm" style = "display: none;">
                                <input type="submit">
                                <i class = "fa fa-check"></i>
                              </div>
                            </div>
                        </form>
                    </div>
                    <h3>{{ Auth::user()->name }}</h3>
                    <hr>
                    <div class="btn_profile">
                        <h3>Thay đổi mật khẩu</h3>
                        @if (Session::has('success_pw'))
                            <strong style="color: green">{{ Session::get('success_pw') }}</strong><br>
                        @endif
                        <form action="{{ route('doimk') }}" method="POST">
                            @csrf
                            <div class="mb-3" style="text-align: left">
                                <label for="password" class="form-label">Mật Khẩu Cũ</label>
                                <input type="password" class="form-control" name="old_password" id="password">
                                @if (Session::has('error_pw'))
                                    <strong style="color: red">{{ Session::get('error_pw') }}</strong>
                                @endif
                            </div>
                            <div class="mb-3" style="text-align: left">
                                <label for="password" class="form-label">Mật Khẩu Mới</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <span class="@error('password') is-valid  @enderror" style="color: red" >{{ $errors->first('password') }}</span>
                            </div>
                            <div class="mb-3"style="text-align: left">
                                <label for="password" class="form-label">Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password">
                            </div>
                            <button class="btn btn-primary">Cập nhật mật khẩu</button>
                        </form>
                    </div>
                    <hr>
                 
                </div>
                <div class="col-lg-9">
                    <h3>Thông tin tài khoản</h3>
                        @if (Session::has('success_profile'))
                            <strong style="color: green">{{ Session::get('success_profile') }}</strong><br>
                        @endif
                    <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12 col-sm-12">
                            <label for="" class="form-label">Họ tên</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            <span class="@error('name') is-valid  @enderror" style="color: red" >{{ $errors->first('name') }}</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                <span class="@error('email') is-valid  @enderror" style="color: red" >{{ $errors->first('email') }}</span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
                                <span class="@error('phone_number') is-valid  @enderror" style="color: red" >{{ $errors->first('phone_number') }}</span>
                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                                <span class="@error('address') is-valid  @enderror" style="color: red" >{{ $errors->first('address') }}</span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">Birthday</label>
                                <input type="date" name="birthday" class="form-control" value="{{ Auth::user()->birthday }}">
                                <span class="@error('birthday') is-valid  @enderror" style="color: red" >{{ $errors->first('birthday') }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-sm-12">
                                <label for="" class="form-label">Gender</label>
                                <div style="margin-left: 30px">
                                    <div class="form-check">
                                        <input class="form-check-input"  type="radio" name="gender" value="1" id="gioitinh1"  {{ Auth::user()->gender == 1 ? "checked" : "" }}>
                                        <label class="form-check-label" for="gioitinh1">
                                        Nam
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="0" id="gioitinh2" {{ Auth::user()->gender == 0 ? "checked" : "" }}>
                                        <label class="form-check-label" for="gioitinh2">
                                        Nữ
                                        </label>
                                    </div>
                                </div>
                                <span class="@error('gender') is-valid  @enderror" style="color: red" >{{ $errors->first('gender') }}</span>
                            </div>                    
                        </div>
                        <div class=" btn_ud_profile" >
                            <button class="btn btn-primary ">Save</button>
                            <a href="{{ route('home') }}" class="btn btn-primary">Trang chủ</a>
                        </div>
                    </form>
                </div>
            </div>
            
            
        </div>
        <script type="text/javascript">
            document.getElementById("fileImg").onchange = function(){
              document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
      
              document.getElementById("cancel").style.display = "block";
              document.getElementById("confirm").style.display = "block";
      
              document.getElementById("upload").style.display = "none";
            }
      
            var userImage = document.getElementById('image').src;
            document.getElementById("cancel").onclick = function(){
              document.getElementById("image").src = userImage; // Back to previous image
      
              document.getElementById("cancel").style.display = "none";
              document.getElementById("confirm").style.display = "none";
      
              document.getElementById("upload").style.display = "block";
            }
        </script>
        <!--Optional JavaScript-->
        <!--jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        
    </body>
</html>