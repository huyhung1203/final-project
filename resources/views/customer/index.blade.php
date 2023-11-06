@extends('layout.customer')
@section('content')
<div class="slider">
  <div class="aspect-ratio-169">
    <img src="../images/bn1.jpg" alt="">
    <img src="../images/bn2.jpg" alt="">
    <img src="../images/bn3.jpg" alt="">
    <img src="../images/bn4.jpg" alt="">
    <!-- <img src="../img/banner7.jpg" alt=""> -->
  </div>
  <div class="dot-container">
    <div class="dot active" ></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <!-- <div class="dot"></div> -->
  </div>
</div>
<div class="prd-vairal">
  <div class="text-title">
    <h3>Sản phẩm mới</h3>
  </div>
  <div class="items row"> 
  @foreach ($products_new as $product )
  <div class="product-new">
    <div class="thumbnail">
      <img src="/product_images/{{$product->thumbnail}}" alt="">
    </div>
    <div class="info-product">
      <div class="title-product">{{$product->product_name}} </div>
      <div class="price-product">
        Giá: 
        @php
              foreach ($product->product_detail as $item){
                $price = $product->product_detail->first()->price;
              }
        @endphp
        <b>{{number_format($price)}}đ</b>
      </div>
    </div>
    <div class="add-to-cart">
      <a href="{{url('customer/'.$product->id)}}">chi tiết</a>
    </div>
  </div>
  @endforeach  
</div>
  <div class="list-prd-new" style="margin-top:80px">
    <a href="{{url('list-product-status/'.$status=0)}}" class="all-prd">Xem tất cả</a>
  </div>
</div>
<div class="prd-coming">
  <div class="text-title">
    <h3>Sản phẩm sắp về</h3>
  </div>
  <div class="items row">
    @foreach ( $products_coming as $product )
    <div class="upcoming">
      <div class="thumbnail">
        <img src="/product_images/{{$product->thumbnail}}" alt="">
      </div>
      <div class="info-product">
        <div class="title-product">{{$product->product_name}}</div>
        <div class="price-product">
          Giá: 
            @php
            foreach ($product->product_detail as $item){
              $price = $product->product_detail->first()->price;
            }
            @endphp
            <b>{{number_format($price )}}đ</b>
        </div>
      </div>
      <div class="add-to-cart">
        <a href="{{url('customer/'.$product->id)}}">chi tiết</a>
      </div>
    </div>
    @endforeach
   
  </div>
  <div class="list-prd-new">
    <a href="{{url('list-product-status/'.$status=2)}}" class="all-prd">Xem tất cả</a>
  </div>
</div>
@section('scripts')
    @parent
    <script>
      const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
	const imgContainer = document.querySelector(".aspect-ratio-169")
	const dotItem =document.querySelectorAll(".dot")
	let imgNumber = imgPosition.length
	let index =0
	// console.log(imgPosition)
	imgPosition.forEach(function(image,index){
		// console.log(image,index)
		image.style.left = index*100+'%'
		dotItem[index].addEventListener('click',function(){
			slider(index)
		})
	})
	function imgSlide(){
		index++
		if(index >= imgNumber){
			index=0
		}
		slider(index)
	}
	function slider(index){
		imgContainer.style.left = "-" + index*100 + "%"
		const dotActive = document.querySelector(".active")
		dotActive.classList.remove("active")
		dotItem[index].classList.add("active")
	}
	setInterval(imgSlide,5000)
    </script>
@endsection
@endsection