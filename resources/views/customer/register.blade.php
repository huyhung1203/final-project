@extends('layout.customer')
@section('content')
@section('css')
    @parent
    <style type="text/css">
        .auth .auth-forgotpass {
            width: 100%;
        }

        .order-block__title {
            display: flex;
            align-items: center;
        }

        .order-block__title h3 {
            font-weight: 600;
            font-size: 24px;
            line-height: 32px;
            color: #221f20;
        }

        .text-uppercase {
            transform: text-uppercase;
        }

        #form-regis {
            margin-left: 30%;
        }

        /* .row-flex {
            display: flex ;
            flex-wrap: wrap;
            width: 100%;
            margin-right: -15px;
            margin-left: -15px;
            } */
        /* .row-flex:after, .clearfix:after {
              display: block;
              content: "";
              clear: both;
            } */

        .form-control:not(.rounded) {
            border-radius: 4px;
        }

        #name,
        input[type=email],
        input[type=tel],
        input[type=password],
        input[type=number],
        input[type=search],
        textarea {
            border: 1px solid #E7E8E9;
            border-radius: 4px;
            padding: 15px;
            font-size: 14px;
            color: #57585A;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-regis {
            padding: 12px 24px;
            border-radius: 16px 0px;
            font-size: 16px;
            line-height: 24px;
            background-color: #221f20;
            color: #f7f8f9;
            border: 1px solid transparent;
            margin-bottom: 100px;
        }

        .btn-regis:hover {
            background-color: #f7f8f9;
            color: #221f20;
            border: 1px solid #221f20;
        }

        .notice-delete {
            width: 200px;
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


<div class="container">
    <div class="order-block__title justify-content-center pt-4 pb-2">
        <h3 class="text-uppercase">Đăng ký</h3>
    </div>
    <div class="auth auth-forgotpass" style="left:50%">
        <div style="display: block;" id="form-regis">
            <form enctype="" name="frm_register" method="post" action="{{ route('user-register') }}"
                onsubmit="return validateForm()">
                @csrf
                <div class="col-md-6">
                    <div class="register-summary__overview">
                        <h4 style="text-align: center">Thông tin khách hàng</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Họ:<span style="color: red">*</span></label>
                                <input id="name" type="text" class="form-control" value=""
                                    name="customer_firstname" placeholder="Họ..." style="width: 100%">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tên:<span style="color: red">*</span></label>
                                <input class="form-control" type="text" value="" name="customer_lastname"
                                    placeholder="Tên..." style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Email:<span style="color: red">*</span></label>
                                <input id="email" class="form-control" type="email" name="customer_email"
                                    value="" placeholder="Email..." style="width: 100%">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Điện thoại:<span style="color: red">*</span></label>
                                <input class="form-control" type="text" value="" name="customer_phone"
                                    placeholder="Điện thoại..." style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Tỉnh/TP:<span style="color: red">*</span></label>
                                <select class="form-control" name="city" id="city" style="width: 100%">
                                    <option value="">Chọn Tỉnh/Tp</option>
                                    @foreach ($city as $item)
                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Quận/Huyện:<span style="color: red">*</span></label>
                                <select name="district" id="district" style="width: 100%" class="form-control">
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Phường/Xã:<span style="color: red">*</span></label>
                                <select name="ward" id="ward" style="width: 100%" class="form-control">
                                    <option value="">Chọn Phường/Xã</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Địa chỉ:<span style="color: red">*</span></label>
                                <textarea class="form-control" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="register-summary__overview">
                        <h4>Thông tin mật khẩu</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Mật khẩu:<span style="color: red">*</span></label>
                                <input class="form-control" type="password" value="" name="customer_pass1"
                                    placeholder="Mật khẩu...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Nhập lại mật khẩu:<span style="color: red">*</span></label>
                                <input class="form-control" type="password" value="" name="customer_pass2"
                                    placeholder="Nhập lại mật khẩu...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {{-- <div class="form-check">
                              <input class="form-check-input checkboxs" type="checkbox" name="customer_agree" value="1" id="defaultCheck1">
                              <label style="margin-top: 4px;margin-left: 3px;" class="form-check-label" for="defaultCheck1">
                                  <span> Đồng ý với các <a style="color: #f31f1f" href="https://ivymoda.com/about/chinh-sach-bao-hanh">điều khoản</a> của IVY </span>
                              </label>
                          </div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="bnt_register" class="btn-regis" type="submit"
                                style="width: 100%;margin-top: 15px">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if (session('noti'))
    <div class="notice-delete">
        <div class="notice-content">
            <button onclick="closeNoti()"><ion-icon id="icon-cl" name="close-outline"></ion-icon></button>
            <p><ion-icon id="warning" name="warning-outline"></ion-icon> {{ session('noti') }}</p>
        </div>
    </div>
@endif
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $("#city").change(function() {
                console.log(1);
                var city = $(this).val();
                $.ajax({
                    type: "GET",
                    url: '/get-district/' + city,
                    data: '',
                    dataType: "json",
                    success: function(data) {
                        console.log(data.district);
                        var dataObj = data.district;

                        var html = '<option value="" selected disabled>Quận/Huyện</option>';
                        for (let i = 0; i < dataObj.length; i++) {
                            html += '<option'
                            html += ' value=' + dataObj[i].code
                            html += '>'
                            html += dataObj[i].name
                            html += '</option>'
                        }
                        console.log(html);
                        $("#district").html('');
                        $("#district").append(html);
                    },
                    error: function(data) {}
                });
            });
        });
        $(document).ready(function() {
            $("#district").change(function() {
                console.log("1");

                var district = $(this).val();
                $.ajax({
                    type: "GET",
                    url: '/get-ward/' + district,
                    data: '',
                    dataType: "json",
                    success: function(data) {
                        console.log(data.ward);
                        var dataObj = data.ward;

                        var html = '<option value="" selected disabled>Phường/Xã</option>';
                        for (let i = 0; i < dataObj.length; i++) {
                            html += '<option'
                            html += ' value=' + dataObj[i].code
                            html += '>'
                            html += dataObj[i].name
                            html += '</option>'
                        }
                        console.log(html);
                        $("#ward").html('');
                        $("#ward").append(html);
                    },
                    error: function(data) {}
                });
            });
        });




        function validateForm() {
            // Lấy giá trị từ các trường input
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementsByName('customer_phone')[0].value;
            var city = document.getElementById('city').value;
            var district = document.getElementById('district').value;
            var ward = document.getElementById('ward').value;
            var address = document.getElementsByName('address')[0].value;
            var pass1 = document.getElementsByName('customer_pass1')[0].value;
            var pass2 = document.getElementsByName('customer_pass2')[0].value;

            // Kiểm tra các trường có bị để trống không
            if (name.trim() === '' || email.trim() === '' || phone.trim() === '' || city.trim() === '' ||
                district.trim() === '' || ward.trim() === '' || address.trim() === '' ||
                pass1.trim() === '' || pass2.trim() === '') {
                alert('Vui lòng điền đầy đủ thông tin.');
                return false; // Không submit form
            }

            // Kiểm tra email có đúng định dạng không
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Email không hợp lệ.');
                return false; // Không submit form
            }

            // Kiểm tra số điện thoại có chỉ chứa số và có đúng độ dài không
            var phoneRegex = /^\d{10}$/;
            if (!phone.match(phoneRegex)) {
                alert('Số điện thoại không hợp lệ.');
                return false; // Không submit form
            }

            // Kiểm tra mật khẩu có đủ dài không (tùy chỉnh độ dài theo yêu cầu)
            if (pass1.length < 6) {
                alert('Mật khẩu phải ít nhất 6 ký tự.');
                return false; // Không submit form
            }

            // Kiểm tra xem mật khẩu nhập lại có trùng khớp không
            if (pass1 !== pass2) {
                alert('Mật khẩu nhập lại không trùng khớp.');
                return false; // Không submit form
            }

            // Nếu tất cả điều kiện đều đúng, cho phép submit form
            return true;
        }

        function closeNoti() {
            var noti = document.querySelector(".notice-delete");
            noti.style.display = "none";
        }
    </script>
@endsection
@endsection
