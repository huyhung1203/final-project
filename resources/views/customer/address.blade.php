@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="infor.css">
@endsection
@section('content')
@if(session('successT'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Thông báo: </strong>{{session('successT')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
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
              <h2>Địa chỉ của tôi</h2>
            </div>
           <div class="data" style="border:1px solid; border-radius: 24px 0; padding:20px;width:500px">
              <p class="user--name"><b>{{$user->first_name}} {{$user->last_name}}</b></p>
              <p class="user--phone">Điện thoại: {{$user->phone_number}}</p>
              <p class="user--address">Địa chỉ: {{$user->user_address}}</p>
           </div>
           <div class="action">
              <button id="openEditAddress">Sửa</button>
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="edit-address">
      <div class="fancy-box" style="width:800px;height:600px;background-color: white">
        <div class="title" style="text-align:center">
          <h3>Sửa địa chỉ</h3>
        </div>
        <form action="{{url('address-user/'.Auth::guard('user')->user()->id)}}" method="post">
          @csrf
          <div class="content-data">
            <div class="label">
              <label for="">Tên</label>
            </div>
            <div class="input">
              <input type="text" class="form-control" placeholder="" name="username" value="{{$user->last_name}}" disabled="disabled">
            </div>
            <div class="label">
              <label for="">Điện thoại</label>
            </div>
            <div class="input">
              <input type="tel" class="form-control" placeholder="" name="phone" value="{{$user->phone_number}}" disabled="disabled">
            </div>
            <div class="label">
              <label for="">Thành Phố</label>
            </div>
            <div class="input">
              <select name="city" id="city"  class="form-control" required >
                <option value="">--chọn--</option>
                @foreach ($city as $item)
                    <option value="{{$item->code}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="label">
              <label for="">Quận/huyện</label>
            </div>
            <div class="input">
              <select name="district" id="district" class="form-control" required>
                <option value=""></option>
              </select>
            </div>

            <div class="label">
              <label for="">Phường/xã</label>
            </div>
            <div class="input">
              <select name="ward" id="ward" class="form-control" required>
                <option value=""></option>
              </select>
            </div>
            <div class="label">
              <label for="">Địa chỉ</label>
            </div>
            <div class="input">
              <input type="text" class="form-control" placeholder="" name="address" value="{{$user->user_address}}">
            </div>
          </div>
          <div class="action">
            <button type="submit" class="btn-address">Cập nhật</button>
         </div>
        </form>
        
      </div>
    </div>
    @section('scripts')
        @parent
        <script>
          document.getElementById('openEditAddress').addEventListener('click', function() {
            document.querySelector('.edit-address').classList.add('active');
            document.querySelector('.fancy-box').classList.add('active');
          });
        
          // Ẩn form sửa địa chỉ khi nhấn vào nút hoặc khu vực khác trong pop-up
          document.querySelector('.edit-address').addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-address')) {
              this.classList.remove('active');
            }
          });



      $(document).ready(function() {
      $("#city").change(function() {
        // console.log(1);
          var city = $(this).val();
          console.log(city)
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