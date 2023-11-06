@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="checkout.css">
@endsection
@section('content')
<div class="container">
    <form action="{{route('payment')}}" method="post">
      @csrf
        <div class="cart pt-40 cart-page">
            <div class="row">
                <div class="col-lg-8 col-2xl-9">
                  <div class="checkout-address-delivery">
                    <div class="row">
                      <div class="col-12 col-2xl-7 pb-3">
                        <h3 class="checkout-title">Địa chỉ giao hàng
                        </h3>
                        <label for="" class="ds_item">
                          <span>Địa chỉ</span>
                          <div class="ds__item__contact-info">
                            <div class="row">
                              <div class="col-6 form-group">
                                <input type="text" name="receiver_name" class="form-control" placeholder="Họ Tên" value="{{$user->first_name}} {{$user->last_name}}">
                                <input type="hidden" name="user_id" class="form-control" value="{{Auth::guard('user')->user()->id}}">
                              </div>
                              <div class="col-6 form-group">
                                <input type="text" name="receiver_phone" class="form-control" placeholder="Số điện thoại" value="{{$user->phone_number}}">
                              </div>
                              <div class="col-6 form-group">
                                <select name="city" class="form-control" id="city">
                                  <option value="#">Tỉnh/Thành Phố</option>
                                  @foreach ($city as $item )
                                      <option 
                                      @if ($item->code==$findCity->code)
                                          selected="selected"
                                          value="{{$item->code}}"
                                      @endif>{{$item->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-6 form-group">
                                <select name="district" class="form-control" id="district">
                                  @if ($district_value!=null)
                                    <option value="{{$district_value->code}}">{{$district_value->name}}</option>
                                  @else
                                  <option value="">--chọn--</option>
                                  @endif
                                     
                                </select>
                              </div>
                              <div class="col-6 form-group">
                                <select name="ward" class="form-control" id="ward">
                                    {{-- @foreach ($ward as $w) --}}
                                      <option value="{{$ward_value->code}}">{{$ward_value->name}}</option>
                                  {{-- @endforeach --}}
                                </select>
                              </div>
                              <div class="col-6 form-group">
                                <input type="text" name="receiver_address" class="form-control" placeholder="Địa chỉ củ thể" value="{{$user->user_address}}">
                              </div>
                            </div>
                          </div>
                        </label>
                      </div>
                      <div class="col-12 col-2xl-5"></div>
                    </div>
                  </div>
                    
                </div>
                <div class="col-lg-4 cart-page__col-summary">
                  
 									 @php
                    $total =0 ;
                   
                @endphp
                @if (session('cart'))
                    @foreach (session('cart')  as $id => $details)
                    @php
                        $total += $details['price'] * $details['quantity']                                            
                    @endphp
                       
                    @endforeach                                
                @endif
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
                                <input type="hidden" name="total" value="{{$total+30000}}">
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
                    <button type="submit" class="order">Thanh Toán</button>  
                    </div>   
                </div> 
            </div>
        </div>
    </form>
</div>
  @section('scripts')
      @parent
      <script>
       $(document).ready(function() {
      $("#city").change(function() {
        console.log(1);
          var city = $(this).val();
          $.ajax({
              type: "GET",
              url:'/get-district/'+city,
              data:'',
              dataType: "json",
              success: function (data){
                console.log(data.district);
                  var dataObj = data.district;

                  var html = '<option value="" selected disabled>Quận/Huyện</option>';
                  for(let i=0; i<dataObj.length; i++) {
                      html += '<option'
                      html += ' value='+dataObj[i].code
                      html += '>'
                      html += dataObj[i].name
                      html += '</option>'
                  }
                  console.log(html);
                  $("#district").html('');
                  $("#district").append(html);
              },
              error: function (data) {}
          });
      });
    });
    $(document).ready(function() {
      $("#district").change(function() {
          console.log("1");
        
          var district = $(this).val();
          $.ajax({
              type: "GET",
              url:'/get-ward/'+district,
              data:'',
              dataType: "json",
              success: function (data){
                console.log(data.ward);
                  var dataObj = data.ward;

                  var html = '<option value="" selected disabled>Phường/Xã</option>';
                  for(let i=0; i<dataObj.length; i++) {
                      html += '<option'
                      html += ' value='+dataObj[i].code
                      html += '>'
                      html += dataObj[i].name
                      html += '</option>'
                  }
                  console.log(html);
                  $("#ward").html('');
                  $("#ward").append(html);
              },
              error: function (data) {}
          });
      });
    });
      </script>
  @endsection
@endsection