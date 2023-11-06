@extends('layout.customer')
@section('content')
@section('css')
    @parent
    <style type="text/css">
		.auth-container {
		    max-width: 1170px;
		    width: 100%;
		    padding:100px;
		    -webkit-margin-start: auto;
		    margin-inline-start: auto;
		    -webkit-margin-end: auto;
		    margin-inline-end: auto;
		}
		.auth-row {
		    display: flex;
		    justify-content: space-between;
		    flex-wrap: wrap;
		    margin: 0 -16px;
		    position: relative;
		}
		.auth__login, .auth__register {
		    flex: 0 0 480px;
		    max-width: 100%;
		    padding: 0 15px;
		}
		.auth__title {
		    font-weight: 600;
		    font-size: 20px;
		    line-height: 30px;
		    margin-bottom: 0;
		    color: #221f20;
		}
		.auth__login{
			border-right: 1px solid black;
		}
		.auth__title + .auth__login__content {
		    margin-top: 10px;
		}
		.auth__login .auth__title, .auth__login .auth__description, .auth__register .auth__title, .auth__register .auth__description {
		    text-align: center;
		}
		.auth__description {
		    font-size: 14px;
		    line-height: 24px;
		    margin-bottom: 0;
		    color: #6c6d70;
		}
		.auth__form {
		    margin-top: 24px;
		    width: 390px;
		    max-width: 100%;
		    -webkit-margin-start: auto;
		    margin-inline-start: auto;
		    -webkit-margin-end: auto;
		    margin-inline-end: auto;
		}
		.auth__form .form-control {
		    width: 100%;
		}
		.auth__login .auth__form__options {
		    margin-top: 12px;
		    display: flex;
		    justify-content: space-between;
		    align-items: center;
		}
		.auth__login__content .form-checkbox label {
		    display: flex;
		    min-height: 20px;

		}
		.auth__form__buttons {
		    margin-top: 29px;
		}
		.auth__form__buttons .button {
		    width: 100%;
		    text-transform: uppercase;
		    font-weight: 600;
		}
		.btn--large {
		    padding: 12px 24px;
		    border-radius: 16px 0px;
		    font-size: 16px;
		    line-height: 24px;
		    background-color: #221f20;
		    color: #f7f8f9;
		    border: 1px solid transparent;
		}
		.button {
		    border: 0;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    font-family: "Montserrat", sans-serif;
		    cursor: pointer;
		}
		.button {
		    display: inline-block;
		    font-weight: 400;
		    border-radius: 16px 0px;
		    color: #f7f8f9;
		    text-align: center;
		    vertical-align: middle;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		    background-color: #221f20;
		    border: 1px solid transparent;
		    padding: 0.375rem 0.75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    border-radius: 0.25rem;
		    /*transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;*/
		}
		.button:hover{
			color:#221f20 ;
			 background-color:#f7f8f9;
			 border: 1px solid black;
		}
		.notice-delete{
        width:200px;
        position: absolute;
        right: 30px;
        bottom: 50px;
        background-color: #5eef45;
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

<div class="auth-container">
    <div class="auth-row">
        <div class="auth__login auth__block">
            <h3 class="auth__title">Bạn đã có tài khoản Anna</h3>
            <div class="auth__login__content">
                <p class="auth__description">
                    Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm
                    thành viên và nhận được những ưu đãi tốt hơn!
                </p>
                <form class="auth__form" method="post" action="{{route('user-login')}}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" type="password" placeholder="Mật khẩu">
                    </div>
                                            <div class="auth__form__options">
                        {{-- <div class="form-checkbox">
                            <label>
                                <input class="checkboxs" value="1" name="customer_remember" type="checkbox">
                                <span style="margin-left: 5px"> Ghi nhớ đăng nhập</span>
                            </label>
                        </div> --}}
                    </div>  
                    @if (Session::get('fail'))
                    <div class="alert alert-danger" style="margin-bottom:30px">
                      {{Session::get('fail')}}
                    </div>
                  @endif
                    <div class="auth__form__buttons">
                        <button  type="submit" class="button btn--large">Đăng nhập</button>
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="auth__register auth__block">
            <h3 class="auth__title">Khách hàng mới của ANNA</h3>
            <div class="auth__login__content">
                <p class="auth__description">
                    Nếu bạn chưa có tài khoản trên anna.com, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.
                </p>
                <p class="auth__description">
                    Bằng cách cung cấp cho ANNA moda thông tin chi tiết của bạn, quá trình mua hàng trên  anna.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn!
                </p>

                <div class="auth__form__buttons">
                    <a href="{{route('show-user-register')}}"> <button class="button btn--large">Đăng ký</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('noti'))
    <div class="notice-delete">
        <div class="notice-content">
        <button onclick="closeNoti()"><ion-icon id="icon-cl" name="close-outline"></ion-icon></button>
        <p><ion-icon id="warning" name="person-circle-outline"></ion-icon> {{session('noti')}}</p>
        </div>
    </div> 
@endif
@section('scripts')
		@parent
		<script>
			function closeNoti(){
            var noti = document.querySelector(".notice-delete");
            noti.style.display = "none";
        }
		</script>
@endsection
@endsection
	
