@extends('layout.customer')
@section('content')
@section('css')
    @parent
    <link rel="stylesheet" href="product_detail.css">
@endsection
<div class="product-detail">
    <div class="">
        <div class="product-content">
            <form action="{{ route('add_to_cart', $product->id) }}" method="post"
                onSubmit="return validateAndAddToCart()">
                @csrf
                <div class="row">
                    <div class="product-content-left row">
                        <div class="product-content-left-big-img">
                            <img src="/product_images/{{ $product->thumbnail }}" alt="">
                            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                        </div>
                        <div class="product-content-left-small-img">
                            @foreach ($image as $item)
                                <img src="/product_images/{{ $item->url }}" alt="">
                            @endforeach
                        </div>
                    </div>
                    <div class="product-content-right">
                        <div class="product-detail-name">
                            <input type="hidden" value="" name="product_name">
                            <h1>{{ $product->product_name }}</h1>
                            <p>MSP: {{ $product->product_code }}</p>
                        </div>
                        <div class="product-detail-price">
                            <input type="hidden" value="" name="product_price">
                            Giá:
                            <b id="price">
                                @php
                                    foreach ($product->product_detail as $item) {
                                        $price_f = $product->product_detail->first()->price;
                                        $price_l = $product->product_detail->last()->price;
                                    }
                                @endphp
                                {{ number_format($price_f) }}đ - {{ number_format($price_l) }}đ
                            </b>
                        </div>
                        <div class="product-detail-color">
                            <p>Màu sắc</p>
                            <div class="list-color row">
                                {{-- đây là code color mới --}}
                                {{-- <div class="color-options">
                                    @foreach ($colors as $color)
                                        <label for="{{ $color->color_name }}" class="color-option"
                                            data-color="{{ $color->color_id }}">{{ $color->color_name }}</label>
                                        <input type="radio" id="{{ $color->color_name }}"
                                            value="{{ $color->color_id }}" name="color">
                                    @endforeach
                                </div> --}}
                                {{--  --}}
                                <select name="color" id="color" class="form-control"
                                    style="width: 150px; border-radius: 15px;text-align: center;">
                                    <option value="" selected>--chọn--</option>
                                    @foreach ($colors as $item)
                                        <option value="{{ $item->color_id }}">{{ $item->color_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="product-detail-size">
                            <div class="size-options" id="size-options">

                            </div>
                            <p>Size:</p>
                            <div class="list-size">
                                <select name="size" id="size" class="form-control"
                                    style="width: 150px; border-radius: 15px;text-align: center;">
                                    <option value="">--chọn--</option>
                                </select>
                                <div class="input-detail-id">
                                    {{-- <input type="number" name="detail_id" id="detail_id" value=""> --}}

                                </div>
                            </div>
                            <div class="product-detail-quantity row">
                                <p
                                    style="font-size: 16px; font-weight: 500; line-height: 48px; vertical-align: baseline; margin-bottom: 0">
                                    Số lượng: </p>
                                <div class="product-detail-quantity-input">
                                    <b id="quantity"></b>
                                </div>
                            </div>
                            <div class="product-detail-action">
                                <button type="submit" id="addToCart" name="btn-buy" onclick=""
                                    class="btn btn--large add-to-cart-detail">
                                    thêm vào giỏ
                                </button>

                                {{-- <a href="javascript:void(0)" id="purchase"  style="">
                          <button class="buy-now btn--outline">mua hàng</button>
                        </a> --}}
                            </div>
                            <div class="product-detail-description">
                                <div class="product-detail-description-top">
                                    &#8744;
                                </div>
                                <div class="product-detail-description-bottom active-detail">
                                    <div class="product-detail-description-title row">
                                        <div class="product-detail-description-title-item chitiet">
                                            <p>Chi tiết</p>
                                        </div>
                                        <div class="product-detail-description-title-item baoquan">
                                            <p>Bảo quản</p>
                                        </div>
                                        {{-- <div class="product-detail-description-title-item">
                                          <p>Tham khảo size</p>
                                      </div> --}}
                                    </div>
                                    <div class="product-detail-description-content">
                                        <div class="product-detail-description-content-chitiet">
                                            <b>
                                                {!! $product->product_description !!}
                                            </b>
                                        </div>
                                        <div class="product-detail-description-content-baoquan">
                                            Chi tiết bảo quản sản phẩm : <br><br>

                                            * Các sản phẩm thuộc dòng cao cấp (Senora) và áo khoác (dạ, tweed, lông,
                                            phao) chỉ giặt khô, tuyệt đối không giặt ướt. <br><br>

                                            * Vải dệt kim: sau khi giặt sản phẩm phải được phơi ngang tránh bai dãn.
                                            <br><br>

                                            * Vải voan, lụa, chiffon nên giặt bằng tay. <br><br>

                                            * Vải thô, tuytsi, kaki không có phối hay trang trí đá cườm thì có thể giặt
                                            máy. <br><br>

                                            * Vải thô, tuytsi, kaki có phối màu tường phản hay trang trí voan, lụa, đá
                                            cườm thì cần giặt tay. <br><br>

                                            * Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm phai màu jeans. Nếu giặt
                                            thì nên lộn trái sản phẩm khi giặt, đóng khuy, kéo khóa, không nên giặt
                                            chung cùng đồ sáng màu, tránh dính màu vào các sản phẩm khác. <br><br>

                                            * Các sản phẩm cần được giặt ngay không ngâm tránh bị loang màu, phân biệt
                                            màu và loại vải để tránh trường hợp vải phai. Không nên giặt sản phẩm với xà
                                            phòng có chất tẩy mạnh, nên giặt cùng xà phòng pha loãng. <br><br>

                                            * Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế độ giặt nhẹ, vắt mức
                                            trung bình và nên phân các loại sản phẩm cùng màu và cùng loại vải khi giặt.
                                            <br><br>

                                            * Nên phơi sản phẩm tại chỗ thoáng mát, tránh ánh nắng trực tiếp sẽ dễ bị
                                            phai bạc màu, nên làm khô quần áo bằng cách phơi ở những điểm gió sẽ giữ màu
                                            vải tốt hơn. <br><br>

                                            * Những chất vải 100% cotton, không nên phơi sản phẩm bằng mắc áo mà nên vắt
                                            ngang sản phẩm lên dây phơi để tránh tình trạng rạn vải.<br><br>

                                            * Khi ủi sản phẩm bằng bàn là và sử dụng chế độ hơi nước sẽ làm cho sản phẩm
                                            dễ ủi phẳng, mát và không bị cháy, giữ màu sản phẩm được đẹp và bền lâu hơn.
                                            Nhiệt độ của bàn là tùy theo từng loại vải. <br><br><br>
                                        </div>
                                        {{-- <div class="product-detail-description-content-size"></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            <div class="product-same">
                <div class="item ">
                    @foreach ($product_same as $product)
                        <div class="product">
                            <div class="thumbnail">
                                <img src="/product_images/{{ $product->thumbnail }}" alt="">
                            </div>
                            <div class="info-product">
                                <div class="title-product">{{ $product->product_name }} </div>
                                <div class="price-product">Giá:
                                    @php
                                        foreach ($product->product_detail as $item) {
                                            $price = $product->product_detail->first()->price;
                                        }
                                    @endphp
                                    <b>{{ $price }}</b>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <a href="{{ url('customer/' . $product->id) }}">chi tiết</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        // // code js cua color
        // const colorOptions = document.querySelectorAll("label");
        // const sizeOptionsContainer = document.getElementById("size-options");
        // let id = document.getElementById("product_id").value;
        // console.log(id);
        // colorOptions.forEach((colorOption) => {
        //     colorOption.addEventListener("click", () => {
        //         colorOptions.forEach((option) => {
        //             option.classList.remove("selected");

        //         });
        //         colorOption.classList.add("selected");
        //     });
        // });

        // colorOptions.forEach((colorOption) => {
        //     colorOption.addEventListener("click", () => {
        //         // Lấy giá trị "for" từ label
        //         const inputId = colorOption.getAttribute("for");

        //         // Sử dụng inputId để lấy đối tượng input
        //         const input = document.getElementById(inputId);

        //         // Lấy giá trị size từ input và hiển thị ra console
        //         const colorValue = input.value;
        //         console.log("Màu đã chọn:", colorValue);
        //     });
        // });


        // $(document).ready(function() {
        //     $('.color-option').click(function() {
        //         var color = $(this).data('color');
        //         $.ajax({
        //             url: '{{ URL::to('get-list') }}' + '/' + id + '/' + color,
        //             method: 'GET',
        //             data: {

        //             },
        //             dataType: "json",
        //             success: function(data) {
        //                 var dataObj = data.size;
        //                 console.log(dataObj);
        //                 var html = '';
        //                 // var html = ''
        //                 for (let i = 0; i < dataObj.length; i++) {
        //                     html += '<label for="' + dataObj[i].size_id + '" id="size">';
        //                     html += dataObj[i].size_name;
        //                     html += '</label>';
        //                     html += '<input value="' + dataObj[i].size_id +
        //                         '" name="size" type="radio" id="' + dataObj[i].size_id + '">';

        //                 }
        //                 $("#size-options").html('');
        //                 $("#size-options").append(html);
        //             }
        //         });
        //     });
        // });
        // //js chon size
        // const sizeOptions = document.querySelectorAll("#size-options label");
        
        // sizeOptions.forEach((sizeOption) => {
        //     sizeOption.addEventListener("click", () => {
        //         sizeOptions.forEach((otherLabel) => {
        //           otherLabel.classList.remove("selected");
        //             console.log(1)
        //         });
        //         sizeOption.classList.add("selected");
        //         var inputId = label.getAttribute('for');
        //         var input = document.getElementById(inputId);

        //         // Thiết lập giá trị input được chọn (hoặc xử lý logic tương tự)
        //         input.checked = true;
        //     });
        // });
        // 
        const bigImg = document.querySelector(".product-content-left-big-img img")
        const smallImg = document.querySelectorAll(".product-content-left-small-img img")
        smallImg.forEach(function(imgItem, X) {
            imgItem.addEventListener("click", function() {
                bigImg.src = imgItem.src
            })
        })

        ///detail-product
        const baoquan = document.querySelector(".baoquan")
        const chitiet = document.querySelector(".chitiet")
        if (baoquan) {
            baoquan.addEventListener("click", function() {
                document.querySelector(".product-detail-description-content-chitiet").style.display = "none"
                document.querySelector(".product-detail-description-content-baoquan").style.display = "block"
            })
        }
        if (chitiet) {
            chitiet.addEventListener("click", function() {
                document.querySelector(".product-detail-description-content-baoquan").style.display = "none"
                document.querySelector(".product-detail-description-content-chitiet").style.display = "block"
            })
        }

        const butTon = document.querySelector(".product-detail-description-top")
        if (butTon) {
            butTon.addEventListener("click", function() {
                document.querySelector(".product-detail-description-bottom").classList.toggle("active-detail")
            })
        }

        //validate 

        function validateAndAddToCart() {
            const sizeSelect = document.getElementById('size');
            const colorSelect = document.getElementById('color');
            if (colorSelect.value === '') {
                alert('Vui lòng chọn màu sắc.');
                return false;
            }
            if (sizeSelect.value === '') {
                alert('Vui lòng chọn kích thước.');
                return false;
            }



            // Nếu dữ liệu hợp lệ, tiến hành submit form
            // document.getElementById('addToCartForm').submit();
            return true;
        }
        /// dữ liệu


        $(document).ready(function($) {
            var id = $("#product_id").val();
            $("#color").change(function() {
                var color = $(this).val();
                console.log(id);
                console.log(color);
                $.ajax({
                    type: "get",
                    url: '{{ URL::to('get-list') }}' + '/' + id + '/' + color,

                    data: {

                    },
                    dataType: "json",
                    success: function(data) {
                        var dataObj = data.size;
                        console.log(dataObj);
                        var html = '<option value="" selected disabled>--chọn--</option>';
                        // var html = ''
                        for (let i = 0; i < dataObj.length; i++) {
                            html += '<option'
                            html += ' value=' + dataObj[i].size_id
                            html += '>'
                            html += dataObj[i].size_name
                            html += '</option>'

                            // html += '<label for="">'
                            // html += '<input '
                            // html += 'type="radio" name="size"'
                            // html += 'value=' +dataObj[i].size_id
                            // html += '>'
                            // html += '<span>'
                            // html += dataObj[i].size_name
                            // html += '</span>'
                            // html += '</label>'
                        }
                        $("#size").html('');
                        $("#size").append(html);


                        // $(".list-size").html('');
                        // $(".list-size").append(html);
                    }
                })
            })
        })
        $(document).ready(function() {
            var id = $("#product_id").val();
            // var color = $("#color").val();
            $("#size" || "#color").change(function() {
                var color = $("#color").val();
                var size = $("#size").val();
                console.log(id);
                console.log(color);
                console.log(size);
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('get-detail-id') }}' + '/' + id + '/' + color + '/' + size,

                    data: '',
                    dataType: "json",
                    success: function(data) {
                        var dataObj = data.detailId;
                        var html = ''
                        for (let i = 0; i < dataObj.length; i++) {
                            html += '<input type="hidden" name="detail_id" '
                            html += 'value=' + dataObj[i].detail_id
                            html += '>'
                        }
                        console.log(html);
                        $(".input-detail-id").html('');
                        $(".input-detail-id").append(html)

                    }
                })
            })
        })

        function formatNumberToCurrency(number) {
            return number.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'vnd'
            });
        }
        $(document).ready(function() {
            var id = $("#product_id").val();
            // var color = $("#color").val();
            $("#size" || "#color").change(function() {
                var color = $("#color").val();
                var size = $("#size").val();
                console.log(id);
                console.log(color);
                console.log(size);
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('get-detail-id') }}' + '/' + id + '/' + color + '/' + size,

                    data: '',
                    dataType: "json",
                    success: function(data) {
                        var dataObj = data.detailId;
                        var html = ''

                        for (let i = 0; i < dataObj.length; i++) {

                            html += formatNumberToCurrency(dataObj[i].price)

                        }
                        console.log(html);
                        $("#price").html('');
                        $("#price").append(html)

                    }
                })
            })
        })
        $(document).ready(function() {
            var id = $("#product_id").val();
            // var color = $("#color").val();
            $("#size" || "#color").change(function() {
                var color = $("#color").val();
                var size = $("#size").val();
                console.log(id);
                console.log(color);
                console.log(size);
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('get-detail-id') }}' + '/' + id + '/' + color + '/' + size,

                    data: '',
                    dataType: "json",
                    success: function(data) {
                        var dataObj = data.detailId;
                        var btnAdd = document.getElementById('addToCart')
                        var btnBuy = document.getElementById('purchase')
                        var html = ''
                        for (let i = 0; i < dataObj.length; i++) {
                            if (dataObj[i].quantity == 0) {
                                btnAdd.disabled = true;
                                // btnBuy.setAttribute('disabled', 'disabled');
                                // btnBuy.style.pointerEvents = 'none';
                                // btnBuy.style.color = 'gray';
                                html += 'Sản phẩm hết hàng! Vui lòng chọn sản phẩm khác'
                                $("#quantity").html('');
                                $("#quantity").append(html);
                            } else {
                                btnAdd.disabled = false;
                                // btnBuy.style.pointerEvents = '';
                                // btnBuy.style.color = '';
                                html += dataObj[i].quantity + ' sản phẩm'
                                $("#quantity").html('');
                                $("#quantity").append(html);
                            }
                        }
                    }
                })
            })
        })
    </script>
@endsection
@endsection
