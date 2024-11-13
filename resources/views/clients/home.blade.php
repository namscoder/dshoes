@extends('templates.layout')
@section('content')
    <div class="slider">
        <div class="list">
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide1.webp') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide2.webp') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide3.webp') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide4.webp') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide6.webp') }}" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
{{-- sản phẩm nổi bật --}}
    <div class="product">
        <div class="container">
            <div class="product_txt">
                * Nổi Bật Nhất *
            </div>
            <div class="product_item">
                <button class="pre-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="nxt-btn"><i class="fa-solid fa-chevron-right"></i></button>
                <div class="row product_item_card ">
                    @foreach ($product_outstandings as $product)
                            <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                                <form action="" method="post" class="p">
{{--                                    <a href="{{ route('product_detail',['id'=>$product->id]) }}">--}}
                                        <div class="img">
                                            <img class="rounded" src="{{ Storage::url($product->image) }}" alt="">
                                        </div>
                                        <div class="title">
                                            <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                                {{ $product->$name }}
                                            </h5>
                                        </div>
                                        <div class="price">
                                                <del class="text-decoration-line-through">{{ number_format($product->price, 0, '', ',') }}đ</del>
                                        </div>
                                        <div class = "product-rating">
                                            @php
                                                $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                                // Đổ màu vàng vào sao dựa trên giá trị của $a
                                                for ($i = 0; $i < floor($product->avg_rating); $i++) {
                                                    // Đổi màu sao thứ $i thành vàng
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                                }
                                                // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                                if ($product->avg_rating != floor($product->avg_rating)) {
                                                    // Đổi màu một nửa của sao thứ $a thành vàng
                                                    $stars[floor($product->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                                }
                                                // Đổ màu nâu vào những sao còn lại
                                                for ($i = ceil($product->avg_rating); $i < 5; $i++) {
                                                    // Đổi màu sao thứ $i thành nâu
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                                }
                                                echo implode('', $stars);
                                            @endphp
                                            <span>({{ $product->total_reviews }})</span>
                                        </div>
                                    </a>
                                    <div class="d-grid gap-2 ">
                                        <a href="{{ route('add_to_cart',['id' => $product->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </form>
                            </div>

                    @endforeach

                </div>
                <hr>
                <div class="d-grid gap-2 col-4 mx-auto ">
                    <a href="#" class="btn_all btn btn-outline-primary" >Xem Thêm</a>
                </div>
            </div>
        </div>
    </div>
{{-- Sản phẩm mới --}}
    <div class="product">
        <div class="container" style="border: solid 1px #74ebd5">
            <div class="product_txt" style="background: linear-gradient(to right, #74ebd5, #acb6e5)">
                * Sản Phẩm Mới *
            </div>
            <div class="product_item">
                <button class="pre-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="nxt-btn"><i class="fa-solid fa-chevron-right"></i></button>
                <div class="row product_item_card ">
                    @foreach ($new_products as $product)
                        <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                            <form action="" method="post" class="p">
{{--                                <a href="{{ route('product_detail',['id'=>$product->id]) }}">--}}
                                    <div class="img">
                                        <img class="rounded" src="{{ Storage::url($product->image) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                            {{ $product->name }}
                                        </h5>
                                    </div>
                                    <div class="price">

                                            <h6>{{number_format($product->price , 0, '', ',') }}đ</h6>

                                    </div>
                                    <div class = "product-rating">
                                        @php
                                            $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                            // Đổ màu vàng vào sao dựa trên giá trị của $a
                                            for ($i = 0; $i < floor($product->avg_rating); $i++) {
                                                // Đổi màu sao thứ $i thành vàng
                                                $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                            }
                                            // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                            if ($product->avg_rating != floor($product->avg_rating)) {
                                                // Đổi màu một nửa của sao thứ $a thành vàng
                                                $stars[floor($product->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                            }
                                            // Đổ màu nâu vào những sao còn lại
                                            for ($i = ceil($product->avg_rating); $i < 5; $i++) {
                                                // Đổi màu sao thứ $i thành nâu
                                                $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                            }
                                            echo implode('', $stars);
                                        @endphp
                                        <span>({{ $product->total_reviews }})</span>
                                    </div>
                                </a>
{{--                                <div class="d-grid gap-2 ">--}}
{{--                                    <a href="{{ route('add_to_cart',['id' => $product->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>--}}
{{--                                </div>--}}
                            </form>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="d-grid gap-2 col-4 mx-auto ">
                    <a href="#" class="btn_all btn btn-outline-primary" >Xem Thêm</a>
                </div>
                </div>
        </div>
    </div>




@endsection
