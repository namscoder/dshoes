<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Required meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product_book.css') }}">
        <script src="https://kit.fontawesome.com/07a69f92d2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="containers">
            <div class="header">
                <div class="header_desktop_banner">
                    <img class="img-fluid" src="{{ asset('images/banner_header.jpg') }}" alt="">
                </div>
                <div class="header_top">
                    <div class="container">
                        <div class="row">
                            <div class="logo col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <a href="{{ route('home') }}" class="navbar-brand">
                                    <img src="{{ asset('images/download.png') }}" alt="">
                                    <span class="logo-txt">T-Book</span>
                                </a>
                            </div>
                            <div class="search_box col-lg-6 col-md-8 col-sm-8 col-xs-8 my-auto mx-auto" style="overflow: hidden;">
                                <form action="{{ route('search_book') }}" method="get">
                                  
                                    <input type="text" class="search_txt" name="search" placeholder="Search...">
                                    <button style="border: none; background: #fff;"  class="search_btn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="user col-lg-3 col-md-1 col-sm-1 col-xs-1 row my-auto mx-auto">
                                <div class="alerts col-lg-4">
                                    <a href="#">
                                        <i class="fa-regular fa-bell"></i><br>
                                        Thông báo
                                    </a>
                                </div>
                                <div class="cart col-lg-4" id="cart">
                                    <a href="{{ route('cart') }}">
                                        <i class="fa-solid fa-cart-shopping"></i><span class="total_cart">{{ $total_product_cart ?? 0 }}</span>
                                        <br>
                                        Giỏ Hàng 
                                    </a>
                                </div>
                                <div class="account col-lg-4">
                                    <a href="#">
                                        <i class="fa-regular fa-user"></i><br>
                                        Tài Khoản
                                    </a>
                                    <ul class="menu_user">
                                        @if (Auth::user())
                                            @if (Auth::user()->role == 0)
                                                <li><a href="{{ route('logout') }}" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-right-from-bracket"></i>Đăng Xuất</a></li>
                                                <li><a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                                            @else
                                                <li><a href="{{ route('logout') }}" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-right-from-bracket"></i>Đăng Xuất</a></li>
                                                <li><a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                                                <li><a href="{{ route('admin') }}"><i class="fa-solid fa-people-roof"></i>Trang Admin</a></li>
                                            @endif
                                            
                                        @else
                                            <li><a href="{{ route('register') }}"><i class="fa-solid fa-registered"></i>Đăng Ký</a></li>
                                            <li><a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>Đăng Nhập</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="mobile-header">
                                    <div class="right">
                                        <button class="bi-list"><i class="fa-solid fa-bars"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-container-02">
                <div class="head-02 container">
                    <div class="left mx-auto my-auto">
                        <ul class="menu">
                            <li>
                                <a href="{{ route('product') }}">Danh mục</a>
                                <ul class="submenu">
                                    @foreach ($categories as $category)
                                        @if ($category->cate_id == null) <!-- Nếu là danh mục gốc -->
                                            <li>
                                                <a href="{{ route('product',['id' => $category->id]) }}">{{ $category->category_name }}</a>
                                                @if ($category->children->count() > 0) <!-- Nếu có danh mục con -->
                                                    @include('clients.submenu', ['subcategories' => $category->children]) <!-- Gọi đệ quy view con -->
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('my_order') }}">Đơn hàng của tôi</a></li>
                            <li><a href="{{ route('info') }}">Giới Thiệu T-Book</a></li>
                            {{-- <li><a href="#">gaming</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
       
        <div class="container">
            <div class="offconvas">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close"><i class="fa-solid fa-x"></i></div>
                    <div class="logo">
                        <a href="#" class="navbar-brand">
                            <img src="{{ asset('images/download.png') }}" alt="">
                            <span class="logo-txt">T-Book</span>
                        </a>
                    </div>
    
                    <div class="cart col-lg-4">
                        <a href="#">
                            <i class="fa-solid fa-cart-shopping"></i><br>
                            Giỏ Hàng
                        </a>
                    </div>
                    <div class="account col-lg-4">
    
                    </div>
                    <ul class="menu">
                        <li>
                            <a href="#">
                                <i class="fa-regular fa-bell"></i>Thông báo
                            </a>
                        </li>
                        <li  id="cart">
                            <a href="#">
                                <i class="fa-solid fa-cart-shopping"></i>Giỏ Hàng
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-regular fa-user"></i>Tài Khoản
                            </a>
                        </li>
                        <div class="divider"></div>
                        <li>
                            <a href="{{ route('product') }}">Danh mục</a><i class="fa-solid fa-chevron-right"></i>
                            <ul class="submenu_mobile">
                                @foreach ($categories as $category)
                                    @if ($category->cate_id == null) <!-- Nếu là danh mục gốc -->
                                        <li>
                                            <a href="{{ route('product',['id' => $category->id]) }}">{{ $category->category_name }}</a>
                                            @if ($category->children->count() > 0) <!-- Nếu có danh mục con -->
                                                <i class="fa-solid fa-chevron-right"></i>
                                                @include('clients.submenu_mobile', ['subcategories' => $category->children]) <!-- Gọi đệ quy view con -->
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        
                        <li><a href="{{ route('my_order') }}">Đơn hàng của tôi</a></li>
                        {{-- <li><a href="#">politics</a></li>
                        <li><a href="#">gaming</a></li> --}}
                        <div class="divider"></div>
                        <div class="social-icons">
                            <a href="#" class="bi-facebook"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="bi-instagram"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="bi-vimeo"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="bi-youtube"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="bi-twitter"><i class="fa-brands fa-facebook"></i></a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
 
        <footer>
            <div class="footer_main container row " style="margin: 0 auto;">
                <div class="tag col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align: center">
                    <img style="border:solid 1px gainsboro; border-radius:50%" src="{{ asset('images/download.png') }}">
                    <p>
                        Trang bán sách chính thống, uy tín, luôn cập nhật các mẫu sách mới nhất trên thị trường, đa dạng thể loại, phù hợp với nhiều lứa tuổi, giá cả hợp lý ...
                    </p>
                </div>
        
                <div class="tag col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <h1>Hãy Trở Lại Nào!</h1>
                    <a href="{{ route('home') }}">Trang chủ</a>
                    <a href="{{ route('product') }}">Danh mục</a>
                    <a href="{{ route('my_order') }}">Đơn hàng của tôi</a>
                    <a href="{{ route('info') }}">Giới thiệu T-Book</a>
                    <a href="{{ route('term_of_use') }}">Điều khoản sử dụng</a>
                    <a href="#">Blog</a>
        
                </div>
        
                <div class="tag col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <h1>Liên Hệ</h1>
                    <a href="#"><i class="fa-solid fa-phone"></i>+84 923 896 715</a>
                    <a href="#"><i class="fa-solid fa-phone"></i>+84 787 131 644</a>
                    <a href="#"><i class="fa-solid fa-envelope"></i>tbook@gmail.com</a>
                </div>
        
                <div class="tag col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <h1>Theo Dõi Chúng Tôi </h1>
                    <div class="social_link ">
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                    <h1></h1>
                    <div class="search_bar">
                        <input type="text" placeholder="You email id here">
                        <button type="submit">Đăng Ký</button>
                    </div>
                </div>
        
                {{-- <div class="tag">
                    
                </div> --}}
            </div>
            <p class="end">Thiết kế bởi <span><i class="fa-solid fa-face-grin"></i> Phạm Văn Tài</span></p>
        </footer>
        
        <!--jQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="{{ asset('bootstrap/jquery/dist/jquery.min.js') }}"></script>

        <script src="{{ asset('js/home.js') }}"></script>
        <script>
            const convas_btn = document.querySelectorAll('.bi-list');
            const convas = document.querySelector('.offconvas');
            convas_btn.forEach((element) => {
                element.addEventListener('click', (e) => {
                    convas.classList.toggle('active');
                });
            });
            document.querySelector('.close').onclick = function () {
                convas.classList.remove('active');
            }
        </script>
       <script>
            var canSubmit=false;
            $(document).on('click','.btn_buy',function(e){
                if(!canSubmit){
                    e.preventDefault();
                    var parent=$(this).parents('.p');
                    var cart=$(document).find('#cart');
                    var src=parent.find('img').attr('src');
                    var href=$(this).attr('href');
                    var parTop = parent.offset().top;
                    var parLeft = parent.offset().left;
                    console.log(parent);
                    $('<img >',{
                        class: 'img-product-fly',
                        src: src
                    }).appendTo('body').css({
                        'top': parTop,
                        'left': parLeft + 75
                    });
                    setTimeout(() => {
                        $(document).find('.img-product-fly').css({
                            'top' : cart.offset().top,
                            'left' : cart.offset().left
                        });
                        setTimeout(() => {
                            $(document).find('.img-product-fly').remove();
                            canSubmit=true;
                            window.location.href=href;
                        },1000);
                    }, 500);
                }         
            })
        </script>
    </body>
</html>