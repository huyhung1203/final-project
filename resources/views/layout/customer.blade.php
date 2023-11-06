<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<base href="{{asset('')}}css/">
	@section('css')
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="customer.css">
	@show
	<style>
		.popup {
    /*display: none;*/
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    width: 400px;
    height: 400px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    text-align: center;
}

.popup button {
    top: 0;
    right: 0;
    position: absolute;
    cursor: pointer;
    border: none;
    background: transparent;
}
.popup-content #check-bag{
  font-size: 150px;
  color: #221f20;
}

	</style>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="{{url('customer')}}"><img src="../images/logoAnna.png" style="width: 120px;" alt=""></a>
		</div>
		<div class="menu">
				<li>
					<a href="{{ url('product-type/'.$type_id=1)}}">áo</a>
						
				</li>
				<li>
					<a href="{{ url('product-type/'.$type_id=2)}}">quần</a>
					
				</li>
				{{-- <li>
					<a href="">phụ kiện</a>

				</li> --}}
				<li><a href="{{url('product-list')}}">Tất cả Sản phẩm</a></li>
				<li><a href="https://ivymoda.com/about/gioi-thieu" target="_blank">Về chúng tôi</a></li>
		</div>
		<div class="orther">
			<form action="{{url('customer/result')}}" method="get">
				<li><input type="text" name="search" placeholder="Tìm kiếm"></li>
				<li><button type="submit"><ion-icon class="icon" id="icon-search" name="search"></ion-icon></button></li>
			</form>
			<!-- <li><ion-icon name="at-circle"></ion-icon></li> -->
			@if (Auth::guard('user')->check())
					<li>
						<div class="dropdown">
							<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
								<ion-icon class="icon" name="person-sharp"></ion-icon>
							</button>
							<ul class="dropdown-menu">
								<li>
								<a href="">
									<h3 class="subtitle" style="
									font-weight: 600; 
									font-size: 14px;
									line-height: 16px; 
									color: #221F20; margin-left: 20px">
										Tài khoản của tôi
									</h3>
								</a>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li>
									<a class="dropdown-item" href="{{url('infor-user/'.Auth::guard('user')->user()->id)}}">
										<ion-icon name="person-outline" style="font-size:16px;font-weight:600;margin-right: 12px;"></ion-icon>Quản Lí Tài khoản
									</a>
								</li>
								<li>
									
									<a class="dropdown-item" href="{{url('history-invoice/'.Auth::guard('user')->user()->id)}}">
									<ion-icon name="reload-outline"  style="font-size:16px;font-weight:600;margin-right: 12px;"></ion-icon>Quản Lí đơn hàng
									</a>
								</li>
								
								<li>
									<a class=" dropdown-item btn-logout" href="{{route('user-logout')}}">
										<ion-icon name="log-out-outline" style="font-size:16px;font-weight:600;margin-right: 12px;"></ion-icon>Đăng xuất
									</a>
								</li>
							</ul>
						</div>
					</li>
			@else
				<li>
					<a href="{{route('show-user-login')}}"><ion-icon class="icon" name="person-sharp"></ion-icon></a>
				</li>
			@endif

			<li> <div class="dropdown">
						<button class="btn btn-primary" onclick="openNav()" type="button" >
							<ion-icon class="icon" name="bag-handle-sharp"></ion-icon>
						</button>
						<span class="count-product">{{ count((array) session('cart')) }}</span>
						
						<div id="mySidenav" class="sidenav">
							<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
								<div class="top-action">
									<h3>
										Giỏ hàng:
										<span class="count-prd">{{ count((array) session('cart')) }}</span>
									</h3>
								</div>
								<div class="main-action">
									@php $total = 0 @endphp
									@if(session('cart'))
									@foreach(session('cart') as $id => $details)
										<div class="item-product-cart d-flex">
											<div class="thumb-product-cart">
												<img src="/product_images/{{$details['thumbnail']}}" alt="">
											</div>
											<div class="info-product-cart">
												<h3>{{$details['product_name']}}</h3>
												<div class="info-properties d-flex">
														<p class="properties-color">Màu sắc: <strong>{{$details['color']}}</strong></p>
														<p>Size: <strong style="text-transform: uppercase">{{$details['size']}}</strong></p>
												</div>
												<div class="info-price-mini d-flex">
													<div class="price-quantity-mini">
														<p style="font-size:14px">Số lượng: <strong>{{$details['quantity']}}</strong></p>
													</div>
													<div class="price-cart-mini">
														<ins>
															<span>{{number_format($details['price'])}}đ</span>
														</ins>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@endif
								</div>
								<div class="bottom-action">
									<div class="total-price">
										@foreach((array) session('cart') as $id => $details)
											@php $total += $details['price'] * $details['quantity'] @endphp
										@endforeach
										Tổng cộng: <strong>{{number_format($total)}}đ</strong>
									</div>
									@if (session('cart'))
									<div class="box-action">
										<a href="{{route('cart')}}" class="action-view-cart">Xem giỏ Hàng</a>
									</div>
									@endif
								</div>
							{{-- <div class="Results">
									<button class="btnRs">Lọc</button>
							</div> --}}
						</div>
					</div>
				
			</li>
		</div>
	</div>
	<div class="content">
		@if(session('success'))
		<div class="popup">
			<div class="popup-content">
			 <ion-icon id="check-bag" name="bag-check-outline"></ion-icon>
				<h3>Thông báo</h3><span>{{session('success')}}</span>
				 <button  onclick="closePopup()"><ion-icon style="font-size: 18px" name="close-circle-outline"></ion-icon></button>
			</div>
		</div>
		@endif
		@yield('content')
	</div>
	<div class="footer">
			<div class="side-footer">
				<div class="side-left">
					<div class="top-side">
						<h4>Mạng xã hội</h4>
						<p>Số điện thoại: 0243 205 2222/ 090 589 8683</p>
						<p>Email: cskh@anna.com.vn</p>
					</div>
					<div class="mid-side">
						<ul class="list-social">
							<li><a href=""><ion-icon name="logo-facebook"></ion-icon></a></li>
							<li><a href=""><ion-icon name="logo-instagram"></ion-icon></a></li>
							<li><a href=""><ion-icon name="logo-twitter"></ion-icon></a></li>
							<li><a href=""><ion-icon name="logo-pinterest"></ion-icon></a></li>
						</ul>
					</div>
					<div class="bottom-side">
						<div class="hot-line">
							<a href="tel:02466623434">Hotline: 0246 662 3434</a>
						</div>
					</div>
				</div>
				<div class="side-center">
					<div class="about-shop">
						<h4>Giới thiệu</h4>
						<a href="">giới thiệu về Anna</a>
					</div>						
				</div>
				<div class="contact">
					<h4>Liên hệ</h4>
					<ul>
						<li><a href="tel:02466623434">Hotline</a></li>
						<li><a href="mailto:saleadmin@ivy.com.vn">Email</a></li>
						<li><a href="http://messenger.com/t/thoitrangivymoda" target="_blank">Messenger</a></li>
					</ul>
				</div>
				<div class="side-right">
					<h4>Liên kết mua hàng</h4>
					<ul>
						<li>
							<a href="">Shoppe: https://shopee.vn/thebadgod</a>
						</li>
						<li>
							<a href="">Lazada: https://www.lazada.vn/shop/the-bad-god-vn</a>
						</li>	
					</ul>
				</div>
			</div>
			<div class="foot-bottom">
				<h5>&copy;Anna All rights reserved</h5>
			</div>
	</div>
</body>
@section('scripts')
<script>
	const header = document.querySelector(".header")
	window.addEventListener("scroll",function(){
		x = window.pageYOffset
		// console.log(x)
		if(x>0){
			header.classList.add("sticky")
		}
		else{
			header.classList.remove("sticky")
		}
	})
	function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
function closePopup(){
            var popup = document.querySelector(".popup");
            popup.style.display = "none";
        }
</script>
@show
</html>