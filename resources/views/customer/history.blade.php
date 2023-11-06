@extends('layout.customer')
.@section('css')
    @parent
    <link rel="stylesheet" href="infor.css">
@endsection
@section('content')
    <div class="container">
    <div class="myacoun">
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
            <h2>Đơn hàng của tôi</h2>
          </div>
          <div class="data">
            <table style="width:100%">
              <tr style="">
                <th>tên</th>
                <th>SĐT</th>
                <th>Địa Chỉ</th>
                <th>Tình trạng đơn hàng</th>
                <th>ngày mua hàng</th>
                <th>Tổng tiền</th>
              </tr>
              @forelse ($invoice as $item)
                  <tr style="font-size:14px">
                    <td>{{ $item->receiver_name}}</td>
                    <td>{{ $item->receiver_phone}}</td>
                    <td>{{ $item->receiver_address}}</td>
                    <td>
                      @if ($item->invoice_status==1)
                      <b style="background-color:rgb(235, 237, 120)">Đợi duyệt</b>
                      @elseif($item->invoice_status==2)
                          <b style="background-color:lightgreen">Đã duyệt</b>  
                      @else
                      <b style="background-color:rgb(231, 131, 118)">Đã huỷ</b>      
                      @endif
                    </td>
                    <td>{{$item->date_created}}</td>
                    <td>{{number_format($item->total_amount)}}đ</td>
                    <td>
                      <a href="{{url('history-detail/'.$item->id)}}" style="font-size:13px">Chi tiết</a>
                    </td>
                  </tr>
              @empty
                  
              @endforelse
            </table>
          </div>
        </div>
      </div>
    </div>

      <div class="info-user">
       
      </div>
      <br>
    </div>
@endsection