@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="infor.css">
@endsection
@section('content')
    <div class="container">
      <div class="myacount">
        <div class="row">
          <div class="infor-left">
            <div class="name-user" class="row" style="">
              <ion-icon name="person-circle-outline" style="font-size:30px"></ion-icon> 
              <h4>{{$user->first_name}} {{$user->last_name}}</h4>
            </div>
            <div class="link">
              <ul>
                <li><a class="link-hre" href="{{url('infor-user/'.Auth::guard('user')->user()->id)}}"><ion-icon name="person-outline"></ion-icon> Thông tin tài khoản</a></li>
                <li><a class="link-hre" href="{{url('history-invoice/'.Auth::guard('user')->user()->id)}}"><ion-icon name="reload-outline"></ion-icon> Xem đơn hàng</a></li>
                <li><a class="link-hre" href="{{url('address-user/'.Auth::guard('user')->user()->id)}}"><ion-icon name="location-outline"></ion-icon> Địa chỉ</a></li>
              </ul>
            </div>
          </div>
          <div class="infor-right">
            <div class="header-tilte">
              <h2>Tài khoản của tôi</h2>
            </div>
            <div class="infor-data">
              <p class="alert alert-primary">
                Vì chính sách an toàn thẻ, bạn không thể thay đổi SĐT, Họ tên. Vui lòng liên hệ CSKH 0905898683 để được hỗ trợ
              </p>
              <div class="col col-label">
                <label for="">Họ</label>  
              </div>
              <div class="col col-input">
                <input type="text" value="{{$user->first_name}}" class="form-control" disabled="disabled">
              </div>
              <div class="col col-label">
                <label for="">Tên</label>  
              </div>
              <div class="col col-input">
                <input type="text" value="{{$user->last_name}}" class="form-control" disabled="disabled">
              </div>
              <form action="{{url('infor-user/'.$user->id)}}" method="post">
                @csrf
                <div class="col col-label">
                  <label for="">Email</label>  
                </div>
                <div class="col col-input">
                  <input type="text" value="{{$user->email}}" name="email" required class="form-control">
                </div>
                <div class="action">
                  <button class="btn-update" type="submit">Cập Nhật</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection