@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="product_category.css">
@endsection
@section('content')
    <div class="container row">
      <div class="content-left">
        <form action="">
          <div class="content-left-top">
            <div class="title-sort">Hãng</div>
              <div class="data-sort">
                <ul>
                  <li>
                    <input type="checkbox" value="" name="brand">
                    <label for="brand_name">NIKE</label>
                  </li>
                  <li>
                    <input type="checkbox" value="" name="brand">
                    <label for="brand_name">ADIDAS</label>
                  </li>
                  <li>
                    <input type="checkbox" value="" name="brand">
                    <label for="brand_name">DIOR</label>
                  </li>
                  <li>
                    <input type="checkbox" value="" name="brand">
                    <label for="brand_name">GUCI</label>
                  </li>
                </ul>
              </div>
              <div class="title-sort">Loại</div>
              <div class="data-sort">
                <ul>
                  <li>
                    <input type="checkbox" name="type" value="">
                    <label for="type_name">Áo</label>
                  </li>
                  <li>
                    <input type="checkbox" name="type" value="">
                    <label for="type_name">Quần</label>
                  </li>
                  <li>
                    <input type="checkbox" name="type" value="">
                    <label for="type_name">Set</label>
                  </li>
                  <li>
                    <input type="checkbox" name="type" value="">
                    <label for="type_name">Phụ kiện</label>
                  </li>
                </ul>
              </div>
          </div>
          <div class="content-left-bot">
            <button type="submit" class="btn-sort">LỌC</button>
          </div>
        </form>
      </div>
      <div class="content-right">
        <div class="item ">
          @foreach ($products as $product )
          <div class="product">
            <div class="thumbnail">
              <img src="/product_images/{{$product->thumbnail}}" alt="">
            </div>
            <div class="info-product">
              <div class="title-product">{{$product->product_name}} </div>
              <div class="price-product">
                @php
                foreach ($product->product_detail as $item){
                  $price = $product->product_detail->first()->price;
                }
                @endphp
                {{number_format($price)}} đ
              </div>
            </div>
            <div class="add-to-cart">
              <a href="{{url('customer/'.$product->id)}}">chi tiết</a>
            </div>
          </div>
          @endforeach 
        </div>
      </div>
    </div>
@endsection