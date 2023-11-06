@extends('layout.customer')
@section('css')
    @parent
    <link rel="stylesheet" href="product_category.css">
    <style>
    .page-link {
    color: #141414;
    text-decoration: none;
    background-color:#ffffff;
    border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
  .page-item.active .page-link {
    z-index: 3;
    color: #141313;
    background-color: #d8d9db;
    border-color: #efeff0;
}
    </style>
@endsection
@section('content')
    <div class="container row">
      <div class="content-left">
        <form action="{{route('fillter-product')}}" method="get">
          <div class="content-left-top">
            <div class="title-sort">Hãng</div>
              <div class="data-sort">
                <ul>
                  <li>
                    <input type="checkbox" value="1" name="brand">
                    <label for="brand_name">NIKE</label>
                  </li>
                  <li>
                    <input type="checkbox" value="2" name="brand">
                    <label for="brand_name">ADIDAS</label>
                  </li>
                  <li>
                    <input type="checkbox" value="3" name="brand">
                    <label for="brand_name">DIOR</label>
                  </li>
                  <li>
                    <input type="checkbox" value="4" name="brand">
                    <label for="brand_name">GUCI</label>
                  </li>
                </ul>
              </div>
              <div class="title-sort">Loại</div>
              <div class="data-sort">
                <ul>
                  <li>
                    <input type="checkbox" name="type" value="1">
                    <label for="type_name">Áo</label>
                  </li>
                  <li>
                    <input type="checkbox" name="type" value="2">
                    <label for="type_name">Quần</label>
                  </li>
                  <li>
                    <input type="checkbox" name="type" value="3">
                    <label for="type_name">Set</label>
                  </li>
                  {{-- <li>
                    <input type="checkbox" name="type" value="">
                    <label for="type_name">Phụ kiện</label>
                  </li> --}}
                </ul>
              </div>
          </div>
          <div class="title-sort">Giá</div>
          <div class="data-sort">
            <span>Từ</span>
            <input type="number" id="price" name="price" value="" min="0" max="2000000"   step="10000" >
            {{-- <div id="priceDisplay"></div> --}}
          </div>
          <div class="content-left-bot" style="margin-top:50px">
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
              <div class="price-product">Giá: 
                @php
                foreach ($product->product_detail as $item){
                  $price = $product->product_detail->first()->price;
                
                }
                @endphp
                <b>{{number_format($price )}} đ</b> 
              </div>
            </div>
            <div class="add-to-cart">
              <a href="{{url('customer/'.$product->id)}}">chi tiết</a>
            </div>
          </div>
          @endforeach 
         
        </div>
        
        <div class="pagination" style="margin-top:80px">
          <ul class="pagination justify-content-center">
              @if ($products->onFirstPage())
                  <li class="page-item disabled"><span class="page-link">Previous</span></li>
              @else
                  <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">Quay lại</a></li>
              @endif
      
              @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                  @if ($page == $products->currentPage())
                      <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                  @else
                      <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                  @endif
              @endforeach
      
              @if ($products->hasMorePages())
                  <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">Tiếp theo</a></li>
              @else
                  <li class="page-item disabled"><span class="page-link">Next</span></li>
              @endif
          </ul>
      </div>
       
      </div>
    </div>
    @section('scripts')
        @parent
        
        <script>
          const priceInput = document.getElementById('price');
          const priceDisplay = document.getElementById('priceDisplay');

          // priceInput.addEventListener('input', function() {
          //   const selectedPrice = this.value;
          //   const formattedPrice = Number(selectedPrice).toLocaleString();
          //   priceDisplay.textContent = formattedPrice +"vnd";
          // });
          // const input = document.getElementById('quantity');
  
  input.addEventListener('price', function() {
    if (this.value < 0) {
      // Hiển thị thông báo lỗi
      alert('Vui lòng nhập giá trị không âm');
      // Xóa giá trị nhập vào
      this.value = '';
    }
  });
        </script>
    @endsection
@endsection