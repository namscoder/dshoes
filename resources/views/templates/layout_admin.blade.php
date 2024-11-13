<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <script src="https://kit.fontawesome.com/07a69f92d2.js" crossorigin="anonymous"></script>
    <title>Admin D-shoes</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('home') }}" class="logo">
            <img style="height: 100px; width: 100px;" src="{{ asset('images/dshoes.png') }}" alt="">
        </a>
        <ul class="side-menu">
{{--            <li class="active"><a href="{{ route('admin') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>--}}
            <li><a href="{{ url('/admin/users') }}"><i class='bx bx-group'></i>Users</a></li>
            <li><a href="{{ url('/admin/categories') }}"><i class='bx bx-category'></i>Categories</a></li>
            <li><a href="{{ url('/admin/products') }}"><i class='bx bx-book-open'></i>Products</a></li>
            <li><a href="{{ url('/admin/publishers') }}"><i class='bx bx-buildings'></i>Publishers</a></li>
            <li><a href="{{ url('/admin/orders') }}"><i class='bx bx-money-withdraw'></i>Orders</a></li>
            <li><a href="{{ url('/admin/reviews') }}"><i class='bx bx-comment'></i>Reviews</a></li>
            <li><a href="{{ url('/admin/promotions') }}"><i class='bx bxs-discount'></i>Discounts</a></li>
            {{-- <li><a href="#"><i class='bx bx-scatter-chart'></i>Statistics</a></li> --}}
        </ul>
        <ul class="side-menu">
{{--            <li>--}}
{{--                <a href="{{ route('logout') }}" class="logout">--}}
{{--                    <i class='bx bx-log-out-circle'></i>--}}
{{--                    Logout--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="nav-admin">
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <!-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a> -->
{{--            <a href="#" class="profile">--}}
{{--                <img src="{{ Storage::url(Auth::user()->image) }}" alt>--}}
{{--            </a>--}}
        </nav>

        <!-- End of Navbar -->

        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('bootstrap/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#cmt_anh").change(function () {
                readURL(this, '#anh_preview');
            });
        });
    </script>
    <script>
        new MultiSelectTag('author')  // id
    </script>
</body>

</html>
