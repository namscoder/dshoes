@extends('templates.layout')
@section('content')
   <div class="container carts">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success_dl'))
                    <strong style="color: green">{{ Session::get('success_dl') }}</strong>
                @endif
                @if (Session::has('success'))
                    <strong style="color: green; font-size: 20px">{{ Session::get('success') }}</strong>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="check-box" id="select-all">
                            </th>
                            <th>Sách</th>
                            <th>Số Lượng</th>
                            <th>Tổng Tiền</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('payment_page') }}" method="post" id="payment_page">
                            @csrf
                            @foreach ($carts as $cart)
                                <tr>
                                    <td> 
                                        <input type="checkbox" name="book_ids[{{ $cart->book_id }}]" class="select-row check-box" value="{{ $cart->promotion_price ? $cart->quantity * $cart->promotion_price : $cart->quantity * $cart->price }}">
                                    </td>
                                    <td>
                                        <img src="{{ Storage::url($cart->image) }}"  alt="" srcset=""><br>
                                        {{ $cart->book_title }}</td>
                                    <td>        
                                        <div class="wrapper"> 
                                            @if ($cart->quantity > 1)
                                                <a href="{{ route('descrease_quantity',['id'=>$cart->book_id]) }}" class="minus">
                                                    <div class="btns">-</div>
                                                </a>
                                            @else
                                                <a href="{{ route('delete_book_cart',['id'=>$cart->book_id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?')" class="minus">
                                                    <div class="btns">-</div>
                                                </a>
                                            @endif   

                                            {{-- <form action="{{ route('update_quantity',['id'=>$cart->book_id]) }}" method="POST" >
                                                @csrf --}}
                                                {{-- <input type="hidden" value="{{ $cart->book_id }}" name="book_id"> --}}
                                                <input type="text" readonly class="num" value="{{ $cart->quantity }}" name="quantity">
                                            {{-- </form>    --}}

                                            <a href="{{ route('increase_quantity',['id'=>$cart->book_id]) }}" class="plus">
                                                <div class="btns">+</div>
                                            </a>
                                        </div>    
                                        <span class="@error('quantity') is-valid  @enderror" style="color: red" >{{ $errors->first('quantity') }}</span>         
                                    </td>

                                    <td>{{$cart->promotion_price ? number_format($cart->quantity * $cart->promotion_price, 0, '', ',') : number_format($cart->quantity * $cart->price, 0, '', ',')}} đ</td>
                                    
                                    <td><a href="{{ route('delete_book_cart',['id'=>$cart->book_id]) }}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?')" class="btn btn-outline-danger"><i class="fa-solid fa-xmark"></i></a></td>
                                </tr>
                            @endforeach
                        </form>
                            <tr>
                                <td colspan="3">Tổng Tiền</td>
                                <td id="total_money"></td>
                                <td>
                                    <button form="payment_page" id="btn" class="btn btn-outline-primary " name="submitButton" value="payment" disabled>Thanh toán</button>
                                    <button form="payment_page" onclick="return confirm('Bạn có chắc muốn xóa những sản phẩm này khỏi giỏ hàng không?')" id="btn_del" class="btn btn-outline-danger" name="submitButton" value="delete" disabled>Xóa</button>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
    <script >
        // Lấy phần tử input
        // var autoSubmitInput = document.getElementById("auto-submit-input");

        // // Gán sự kiện change cho input
        // autoSubmitInput.addEventListener("change", function() {
        //     // Gửi form
        //     this.form.submit();
        // });
        document.getElementById("total_money").innerHTML = 0;      
        // check 
        var selectAll = document.getElementById("select-all");
        var selectRows = document.querySelectorAll(".select-row");
        let total = 0;
        let check = -1;
        var check1=new Array(selectRows.length - 1);
        var totals=new Array(selectRows.length - 1);
        check1.fill(-1);
        totals.fill(0);
        //Gán sự kiện click cho ô input chọn tất cả
        selectAll.onchange= function() {
            total = 0;
            check *= -1;
            // Lặp qua các ô input chọn từng hàng
            for (var i = 0; i < selectRows.length; i++) {
                // Đồng bộ trạng thái với ô input chọn tất cả
                selectRows[i].checked = this.checked;
                 total += parseInt(selectRows[i].value);
            }
            if(check == 1){
                check1.fill(1);     
                document.getElementById("total_money").innerHTML = total; 
                document.getElementById("btn").disabled = false;
                document.getElementById("btn_del").disabled = false;
                total = 0;
            }else{  
                total = 0;
                document.getElementById("total_money").innerHTML = total;   
                document.getElementById("btn").disabled = true;
                document.getElementById("btn_del").disabled = true;
            }
        };
        // Gán sự kiện click cho các ô input chọn từng hàng
        for (var i = 0; i < selectRows.length; i++){ 
            selectRows[i].onchange= function() {
                // Kiểm tra nếu có một ô input chưa được chọn  
                check1[i] *= -1;
                var isAllChecked = true;
                for (var j = 0; j < selectRows.length; j++) {
                    if (!selectRows[j].checked) {
                        isAllChecked = false;
                        check1[j] = -1;
                    }else{
                        check1[j] = 1;
                        total += parseInt(selectRows[j].value) * check1[j];
                    }
                    document.getElementById("total_money").innerHTML = total;
                    if(total > 0){
                        document.getElementById("btn").disabled = false;
                        document.getElementById("btn_del").disabled = false;
                    }else{
                        document.getElementById("btn").disabled = true;
                        document.getElementById("btn_del").disabled = true;
                    }
                }
                // Cập nhật trạng thái cho ô input chọn tất cả
                    selectAll.checked = isAllChecked; 
                    check=-1;
                    if(isAllChecked==true){
                        check=1;
                    }
                    total=0;
            };
        }
    </script>

@endsection