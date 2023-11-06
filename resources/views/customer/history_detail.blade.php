@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="cart.css">
    <style>
        .btn-back{
            padding: 12px 24px;
            max-width:150px;
            border-radius: 16px 0px;
            font-size: 16px;
            line-height: 24px;
            background-color: #221f20;
            color: #f7f8f9;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid transparent;
            text-transform: uppercase;
            font-family: "Montserrat", sans-serif;
            cursor: pointer;
        }
        .btn-back:hover{
            background-color:#f7f8f9 ;
            color:#221f20 ;
            border:1px solid #221f20 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="cart pt-40 cart-page">
            <div class="row-flex">
                <div class="col-lg-8">
                    <div id="box_product_total_cart">
                        <div class="cart__list">
                            <h2 class="cart-title">
                             
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
                                        @foreach (  $invoice_detail as  $detail)
                                            <tr>
                                               <td>
                                                    <div class="cart__product-item">
                                                        <div class="cart__product-item__img">
                                                            <a href="">
                                                                <img src="/product_images/{{$detail->thumbnail}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="cart__product-item__content">
                                                            <h3 class="cart__product-item__title">{{$detail->product_name}}</h3>
                                                            <div class="cart__product-item__properties">
                                                                <p>Màu Sắc: 
                                                                    <span>{{$detail->color_name}}</span>
                                                                </p>
                                                                <p>Size:
                                                                    <span style="text-transform: uppercase">{{$detail->size_name}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart-price">
                                                    <p>{{$detail->price}}đ</p>
                                                </td>
                                                <td>
                                                    <div class="product-detail__quantity-input">
                                                        <input class="form-control quantity cart_update" id="quantity" min="1" type="number" value="{{$detail->quantity}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart__product-item__price">
                                                        {{$detail->quantity*$detail->price}}đ
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach                                
                                </tbody>
                            </table>
                        </div>
                        <div class="cart__list --attacfa"></div> 
                    </div>
                </div>
                <div class="col-lg-4 cart-page__col-summary">
                    <div class="cart-summary" id="cart-page-summary">   
                        <h3>Tổng tiền đơn hàng</h3>
                        <div class="cart-summary__overview">
                            <div class="cart-summary__overview__item">
                                <p>Tổng Sản Phẩm</p>
                                <p>{{$detail->quantity}}</p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Tổng tiền</p>
                                <p class="total-not-discount">
                                    {{$detail->quantity*$detail->price}}đ
                                </p>
                                
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Phí vận chuyển</p>
                                <p><b>30,000đ</b></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Thành tiền</p>
                                <p>{{number_format($detail->total_amount)}}đ</p>
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
                        @php
                           
                            $date_create=$detail->date_created;
                        @endphp
                        @if ($date==$date_create && $detail->invoice_status==1)
                            <a href="{{url('cancel/'.$detail->invoice_id)}}" class="order">Huỷ đơn hàng</a>    
                        @elseif($date==$date_create && $detail->invoice_status==2)
                            <h3>Đã duyệt</h3>
                        @elseif($detail->invoice_status==0)
                            <h3>Đã Huỷ</h3>
                        @else
                            <h3>Đợi duyệt</h3>
                        @endif
                    </div>   
                </div> 
            </div>
    </div>
    <div class="back">
        <a class="btn-back" href="{{url('history-invoice/'.Auth::guard('user')->user()->id)}}">
            <ion-icon name="arrow-back-outline"></ion-icon> Trở lại</a>
    </div>
@endsection