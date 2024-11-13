@extends('templates.layout')
@section('content')
    <div class="slider">
        <div class="list">
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide1.jpg') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide2.jpg') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide3.jpg') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide4.jpg') }}" alt="">
            </div>
            <div class="item">
                <img class="img-fluid" src="{{ asset('images/slide5.jpg') }}" alt="">
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
                    @foreach ($book_outstandings as $book)
                            <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                                <form action="" method="post" class="p">
                                    <a href="{{ route('product_detail',['id'=>$book->id]) }}">
                                        <div class="img">
                                            <img class="rounded" src="{{ Storage::url($book->image) }}" alt="">
                                        </div>
                                        <div class="title">
                                            {{-- <h5>{{ $book->book_title }}</h5> --}}
                                            <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                                {{ $book->book_title }}
                                            </h5>
                                        </div>
                                        <div class="price">
                                            @if ($book->promotion_price >0)
                                                <h6>
                                                    {{number_format($book->promotion_price, 0, '', ',')  }}đ
                                                    <span style="padding: 0 5px;position: absolute; font-size:17px;margin-bottom: 10px;  
                                                    border-radius: 20px; background: red; color: aliceblue; font-weight: bold">
                                                        - {{ round(($book->price - $book->promotion_price)*100/$book->price)  }}  %
                                                    </span>  
                                                </h6>
                                                <del class="text-decoration-line-through">{{ number_format($book->price, 0, '', ',') }}đ</del>
                                            @else
                                                <h6>{{number_format($book->price , 0, '', ',') }}đ</h6>
                                            @endif
                                        </div>
                                        <div class = "product-rating">
                                            @php
                                                $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                                // Đổ màu vàng vào sao dựa trên giá trị của $a
                                                for ($i = 0; $i < floor($book->avg_rating); $i++) {
                                                    // Đổi màu sao thứ $i thành vàng
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                                }
                                                // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                                if ($book->avg_rating != floor($book->avg_rating)) {
                                                    // Đổi màu một nửa của sao thứ $a thành vàng
                                                    $stars[floor($book->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                                }
                                                // Đổ màu nâu vào những sao còn lại
                                                for ($i = ceil($book->avg_rating); $i < 5; $i++) {
                                                    // Đổi màu sao thứ $i thành nâu
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                                }
                                                echo implode('', $stars);
                                            @endphp
                                            <span>({{ $book->total_reviews }})</span>
                                        </div>
                                    </a> 
                                    <div class="d-grid gap-2 ">
                                        <a href="{{ route('add_to_cart',['id' => $book->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>
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
                    @foreach ($new_books as $book)
                        <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                            <form action="" method="post" class="p">
                                <a href="{{ route('product_detail',['id'=>$book->id]) }}">
                                    <div class="img">
                                        <img class="rounded" src="{{ Storage::url($book->image) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                            {{ $book->book_title }}
                                        </h5>
                                    </div>
                                    <div class="price">
                                        @if ($book->promotion_price >0)
                                            <h6>
                                                {{number_format($book->promotion_price, 0, '', ',')  }}đ
                                                <span style="padding: 0 5px;position: absolute; font-size:17px;margin-bottom: 10px;  
                                                border-radius: 20px; background: red; color: aliceblue; font-weight: bold">
                                                    - {{ round(($book->price - $book->promotion_price)*100/$book->price)  }}  %
                                                </span>  
                                            </h6>
                                            <del class="text-decoration-line-through">{{ number_format($book->price, 0, '', ',') }}đ</del>
                                        @else
                                            <h6>{{number_format($book->price , 0, '', ',') }}đ</h6>
                                        @endif
                                    </div>
                                    <div class = "product-rating">
                                        @php
                                            $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                            // Đổ màu vàng vào sao dựa trên giá trị của $a
                                            for ($i = 0; $i < floor($book->avg_rating); $i++) {
                                                // Đổi màu sao thứ $i thành vàng
                                                $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                            }
                                            // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                            if ($book->avg_rating != floor($book->avg_rating)) {
                                                // Đổi màu một nửa của sao thứ $a thành vàng
                                                $stars[floor($book->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                            }
                                            // Đổ màu nâu vào những sao còn lại
                                            for ($i = ceil($book->avg_rating); $i < 5; $i++) {
                                                // Đổi màu sao thứ $i thành nâu
                                                $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                            }
                                            echo implode('', $stars);
                                        @endphp
                                        <span>({{ $book->total_reviews }})</span>
                                    </div>
                                </a> 
                                <div class="d-grid gap-2 ">
                                    <a href="{{ route('add_to_cart',['id' => $book->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>
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
{{-- Giảm Giá Sốc --}}
    <div class="product">
        <div class="container" style="border: solid 1px #ef3b36">
            <div class="product_txt" style="background: linear-gradient(to right, #ee0979, #ff6a00);">
                * Sách Hot - Giá Giảm Sốc *
            </div>
            <div class="product_item">
                <button class="pre-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="nxt-btn"><i class="fa-solid fa-chevron-right"></i></button>
                <div class="row product_item_card ">
                    @foreach ($shocking_discount as $book)
                            <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                                <form action="" method="post" class="p">
                                    <a href="{{ route('product_detail',['id'=>$book->id]) }}">
                                        <div class="img">
                                            <img class="rounded" src="{{ Storage::url($book->image) }}" alt="">
                                        </div>
                                        <div class="title">
                                            <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                                {{ $book->book_title }}
                                            </h5>
                                        </div>
                                        <div class="price">
                                            @if ($book->promotion_price >0)
                                                <h6>
                                                    {{number_format($book->promotion_price, 0, '', ',')  }}đ
                                                    <span style="padding: 0 5px;position: absolute; font-size:17px;margin-bottom: 10px;  
                                                    border-radius: 20px; background: red; color: aliceblue; font-weight: bold">
                                                        - {{ round(($book->price - $book->promotion_price)*100/$book->price)  }}  %
                                                    </span>  
                                                </h6>
                                                <del class="text-decoration-line-through">{{ number_format($book->price, 0, '', ',') }}đ</del>
                                            @else
                                                <h6>{{number_format($book->price , 0, '', ',') }}đ</h6>
                                            @endif
                                        </div>
                                        <div class = "product-rating">
                                            @php
                                                $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                                // Đổ màu vàng vào sao dựa trên giá trị của $a
                                                for ($i = 0; $i < floor($book->avg_rating); $i++) {
                                                    // Đổi màu sao thứ $i thành vàng
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                                }
                                                // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                                if ($book->avg_rating != floor($book->avg_rating)) {
                                                    // Đổi màu một nửa của sao thứ $a thành vàng
                                                    $stars[floor($book->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                                }
                                                // Đổ màu nâu vào những sao còn lại
                                                for ($i = ceil($book->avg_rating); $i < 5; $i++) {
                                                    // Đổi màu sao thứ $i thành nâu
                                                    $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                                }
                                                echo implode('', $stars);
                                            @endphp
                                            <span>({{ $book->total_reviews }})</span>
                                        </div>
                                    </a> 
                                    <div class="d-grid gap-2 ">
                                        <a href="{{ route('add_to_cart',['id' => $book->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>
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

{{-- Bán chạy nhất --}}
<div class="product">
    <div class="container" style="border: solid 1px #4cb8c4">
        <div class="product_txt" style="background: linear-gradient(to right, #4cb8c4, #3cd3ad);">
            * Bán Chạy Nhất *
        </div>
        <div class="product_item">
            <button class="pre-btn"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="nxt-btn"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="row product_item_card ">
                @foreach ($bestselling_books as $book)
                        <div class="product_item_1 col-lg-3 col-md-4 col-sm-6" >
                            <form action="" method="post" class="p">
                                <a href="{{ route('product_detail',['id'=>$book->id]) }}">
                                    <div class="img">
                                        <img class="rounded" src="{{ Storage::url($book->image) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <h5 style="width: 100%; overflow: hidden; text-overflow: ellipsis; line-height: 25px; -webkit-line-clamp: 2; height: 50px; display: -webkit-box; -webkit-box-orient: vertical;">
                                            {{ $book->book_title }}
                                        </h5>
                                    </div>
                                    <div class="price">
                                        @if ($book->promotion_price >0)
                                            <h6>
                                                {{number_format($book->promotion_price, 0, '', ',')  }}đ
                                                <span style="padding: 0 5px;position: absolute; font-size:17px;margin-bottom: 10px;  
                                                border-radius: 20px; background: red; color: aliceblue; font-weight: bold">
                                                    - {{ round(($book->price - $book->promotion_price)*100/$book->price)  }}  %
                                                </span>  
                                            </h6>
                                            <del class="text-decoration-line-through">{{ number_format($book->price, 0, '', ',') }}đ</del>
                                        @else
                                            <h6>{{number_format($book->price , 0, '', ',') }}đ</h6>
                                        @endif
                                    </div>
                                    <div class = "product-rating">
                                        @php
                                            $stars = array_fill(0, 5, '<i class = "fas fa-star"></i>');
                                            // Đổ màu vàng vào sao dựa trên giá trị của $a
                                            for ($i = 0; $i < floor($book->avg_rating); $i++) {
                                                // Đổi màu sao thứ $i thành vàng
                                                $stars[$i] = '<i class = "fas fa-star" style="color: #ffd700;"></i>';
                                            }
                                            // Nếu $a không phải là số nguyên, đổ màu vàng vào một nửa của sao thứ $a
                                            if ($book->avg_rating != floor($book->avg_rating)) {
                                                // Đổi màu một nửa của sao thứ $a thành vàng
                                                $stars[floor($book->avg_rating)] = '<i class = "fas fa-star-half-alt" style="color: #ffd700;"></i>';
                                            }
                                            // Đổ màu nâu vào những sao còn lại
                                            for ($i = ceil($book->avg_rating); $i < 5; $i++) {
                                                // Đổi màu sao thứ $i thành nâu
                                                $stars[$i] = '<i class = "fas fa-star" style="color: gainsboro;"></i>';
                                            }
                                            echo implode('', $stars);
                                        @endphp
                                        <span>({{ $book->total_reviews }})</span>
                                        <span style="color: gray; font-size:14px">({{ $book->sold }} đã bán)</span>
                                    </div>
                                </a> 
                                <div class="d-grid gap-2 ">
                                    <a href="{{ route('add_to_cart',['id' => $book->id]) }}" id="btn_buy" class="btn_buy btn btn-primary"><i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng</a>
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



@endsection