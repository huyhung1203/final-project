@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="cart.css">
    <style>
.notice-delete{
  width:200px;
  position: absolute;
  right: 30px;
  bottom: 50px;
  background-color: #ea9f09;
  border-radius: 10px;
  animation: 1s ease-in-out;
  /*animation: fadeOut 5s*/
}
.notice-content {
  align-items: center;
  text-align: center;
  padding: 5px 0 5px 0;
  line-height: 30px;

}
.notice-content p {
  font-size: 16px;
}
.notice-content button {
    top: 0;
    right: 0;
    position: absolute;
    cursor: pointer;
    border: none;
    background: transparent;
}
    </style>
@endsection
@section('content')
<div class="container">
    <form action="">
        <div class="cart pt-40 cart-page">
            <div class="row-flex">
                <div class="col-lg-8">
                    <div id="box_product_total_cart">
                        <div class="cart__list">
                            <h2 class="cart-title">
                                Giỏ hàng của bạn:
                               <b>
                                <span class="cart-total">{{ count((array) session('cart')) }}</span>
                                sản phẩm
                               </b>
                            </h2>
                            <table class="cart__table">
                                <thead>
                                    <tr>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng Tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total =0 ;
                                        $quantity = 0;
                                    @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart')  as $id => $details)
                                        @php
                                            $total += $details['price'] * $details['quantity']                                            
                                        @endphp
                                            <tr data-id="{{$id}}">
                                               <td>
                                                    <div class="cart__product-item">
                                                        <div class="cart__product-item__img">
                                                            <a href="">
                                                                <img src="/product_images/{{$details['thumbnail']}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="cart__product-item__content">
                                                            <h3 class="cart__product-item__title">{{$details['product_name']}}</h3>
                                                            <div class="cart__product-item__properties">
                                                                <p>Màu Sắc: 
                                                                    <span>{{$details['color']}}</span>
                                                                </p>
                                                                <p>Size:
                                                                    <span style="text-transform: uppercase">{{$details['size']}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart-price">
                                                    <p>{{number_format($details['price'])}}đ</p>
                                                </td>
                                                <td>
                                                    <div class="product-detail__quantity-input">
                                                        <input class="form-control quantity cart_update" id="quantity" min="1" max="" type="number" value="{{$details['quantity']}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart__product-item__price">
                                                        {{number_format($details['quantity']*$details['price'])}}đ
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="remove-item-cart cart_remove">
                                                        <ion-icon name="trash-outline"></ion-icon>
                                                    </a>
                                                </td> 
                                            </tr>
                                        @endforeach                                
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="cart__list --attacfa"></div> 
                    </div>
                    <a href="javascript: window.history.back()" class="btn btn--large btn--outline btn-cart-continue mb-3"><ion-icon name="arrow-back-outline"></ion-icon>Tiếp tục mua hàng</a>
                </div>
                <div class="col-lg-4 cart-page__col-summary">
                    <div class="cart-summary" id="cart-page-summary">   
                        <h3>Tổng tiền giỏ hàng</h3>
                        <div class="cart-summary__overview">
                            <div class="cart-summary__overview__item">
                                <p>Tổng Sản Phẩm</p>
                                <p>{{count((array) session('cart'))}}</p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Tổng tiền</p>
                                <p class="total-not-discount">
                                    {{number_format($total)}}đ
                                </p>
                                
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Phí vận chuyển</p>
                                <p><b>30,000đ</b></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Thành tiền</p>
                                <p>{{number_format($total+30000)}}đ</p>
                            </div>
                        </div>
                        <div class="cart-summary__note">
                            <div class="inner-note d-flex">
                                <div class="left-inner-note">
                                    <ion-icon name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="content-inner-note">
                                    <p><b>Đổi Trả</b> trong <b>7</b> ngày</p>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="cart-summary__button">
                    <a href="{{url('check-out')}}" class="order">đặt hàng</a>    
                    </div>   
                </div> 
            </div>
        </div>
    </form>
</div>
@if (session('noti'))
    <div class="notice-delete">
        <div class="notice-content">
        <button onclick="closeNoti()"><ion-icon id="icon-cl" name="close-outline"></ion-icon></button>
        <p><ion-icon id="warning" name="warning-outline"></ion-icon> Đã xoá sản phẩm</p>
        </div>
    </div> 
@endif
@section('scripts')
    @parent
    <script>
        
    $(".cart_update").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
    
    $(".cart_remove").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Xoá sản phẩm này khỏi giỏ hàng?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    const input = document.getElementById('quantity');
  
  input.addEventListener('input', function() {
    if (this.value < 0) {
      // Hiển thị thông báo lỗi
      alert('Vui lòng nhập giá trị không âm');
      // Xóa giá trị nhập vào
      this.value = '';
    }
  });

  function closeNoti(){
            var noti = document.querySelector(".notice-delete");
            noti.style.display = "none";
        }
    </script>
@endsection
@endsection