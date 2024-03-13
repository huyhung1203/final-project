@extends('layout.master')
@section('title', 'Quản lí sản phẩm')
@section('name_page', 'Thêm sản phẩm')
@section('product', 'active')
@section('css')
    @parent
    <style>
        /* Định dạng cho form */
        .product-form {
            width: 100%;
            /* Độ rộng của form */
            margin: auto;
            /* Căn giữa form */
            padding: 20px;
            /* Khoảng cách viền ngoài */
            border: 1px solid #ccc;
            /* Viền của form */
            border-radius: 5px;
            /* Bo góc cho form */
            background-color: #f9f9f9;
            /* Màu nền của form */
        }

        /* Định dạng cho input và select */
        .product-form input,
        .product-form select {
            width: 100%;
            /* padding: 10px; */
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Định dạng cho các nút thêm (addBtn) */
        .product-form #addBtn {
            color: #00b300;
            /* Màu chữ */
            font-size: 18px;
            cursor: pointer;
        }

        /* Định dạng cho bảng sản phẩm chi tiết */
        .product-form table {
            width: 100%;
            border-collapse: collapse;
            /* Xóa viền các ô trong bảng */
        }

        .product-form th,
        .product-form td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .product-form th {
            background-color: #f2f2f2;
            /* Màu nền tiêu đề bảng */
        }

        .product-form tr:hover {
            background-color: #f2f2f2;
            /* Màu nền khi di chuột vào hàng */
        }

        /* Định dạng cho nút Thêm */
        .product-form .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-form .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>


@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ session('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ session('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card">
        <div class="card-header">
            <h3>Thêm Mới Sản Phẩm</h3>
        </div>

        {{-- @method('PUT') --}}
        <div class="card-body">
            <div class="product-form">
                <form action="{{ url('product') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="col"></div> --}}
                        <div class="col-6">
                            <label for="exampleInputName">Mã sản phẩm</label>
                            <input type="text" name="product_code" value="{{ old('product_code') }}" class="form-control"
                                placeholder="">
                        </div>

                        <div class="col-6">
                            <label for="exampleInputName">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control"
                                placeholder="">
                            {{-- <span class="alert text-danger  font-italic font-weight-bolder">{{ $errors->first('name') }}</span> --}}
                        </div>
                        <div class="col-6">
                            <label for="exampleInputName">Thumnail</label>
                            <input type="file" name="thumbnail_upload" class="form-control" accept="image">
                        </div>
                        <div class="col-6">
                            <label for='file' for="exampleInputName">Ảnh sản phẩm</label>
                            <input type="file" name="product_image[]" multiple accept="image"
                                value="{{ old('product_image') }}" class="form-control" placeholder="">
                        </div>
                        <div class="col"></div>
                        <div class="row col-6" style="">
                            <div style="width:50%">
                                <label for="exampleInputName">Tên Hãng</label>
                                <select class="form-control" name="brand_id">
                                    <option value="##" selected>--chọn--</option>
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width:50%">
                                <label for="exampleInputName">Tên Loại</label>
                                <select class="form-control" name="type_id">
                                    <option value="##" selected>--chọn--</option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="examplInputName">Tình Trạng</label>
                            <select class="form-control" name="product_status">
                                <option value="##" selected>--chọn--</option>
                                <option value="0">Hàng mới</option>
                                <option value="1">Hàng sẵn</option>
                                <option value="2">Hàng sắp về</option>
                            </select>
                        </div>
                        {{-- <div class="col"></div> --}}
                    </div>
                    <br><br>
                    {{-- sản phẩm chi tiêt --}}
                    <div class="title">
                        <h4>Sản phẩm chi tiết</h4>
                    </div>

                    <div>
                        <table id="prd_detail">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th class="col-sm-2">Size</th>
                                    <th class="col-sm-2">Màu</th>
                                    <th>Sô lượng</th>
                                    <th>Giá</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="number" name="product_detail[1]" readonly style="width:50px"
                                            class="form-control" value="1"></td>
                                    <td>
                                        <select class="form-control" name="size[]">
                                            <option value="##" selected>-----chọn-----</option>
                                            @foreach ($size as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->size_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="color[]">
                                            <option value="##" selected>-----chọn-----</option>
                                            @foreach ($color as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->color_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" style="min-width:150px"
                                            name="quantity[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" style="min-width:150px" name="price[]">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-success font-18" title="Add"
                                            id="addBtn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <label for="exampleInputName">Thông tin sản phẩm</label><br>
                        {{-- <textarea name="description" id="description" cols="60" rows="60"></textarea> --}}
                        <textarea name="product_description" cols="60" rows="5" id="product_description"></textarea>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('scripts')
    @parent
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        var rowIdx = 1;

        $("#addBtn").on("click", function() {
            $("#prd_detail tbody").append(`
        <tr id="R${++rowIdx}">
              <td>
              <input type="number" readonly name="product_detail[${rowIdx}]"  style="width:50px" class="form-control" value="${rowIdx}">
              </td>
              <td> 
                <select class="form-control" name="size[]">
                  <option value="##" selected>--chọn--</option>
                    @foreach ($size as $item)
                        <option 
                        value="{{ $item->id }}" 
                      >
                        {{ $item->size_name }}
                      </option>
                    @endforeach
              </select>
            </td>
            <td>
              <select class="form-control" name="color[]">
                <option value="##" selected>--chọn--</option>
                  @foreach ($color as $item)
                      <option 
                      value="{{ $item->id }}" 
                     >
                      {{ $item->color_name }}
                    </option>
                  @endforeach
              </select>
            </td>
            <td>
              <input type="number" class="form-control" style="min-width:150px" name="quantity[]" >
            </td>
            <td>
              <input type="number" class="form-control" style="min-width:150px"name="price[]" >
            </td>
            <td>
              <a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove">
                <i class="fa fa-trash"></i>
                </a>
            </td>
            </tr>
	 		`);
        });
        $("#prd_detail tbody").on("click", ".remove", function() {

            // Removing the current row.
            $(this).closest("tr").remove();

            // Decreasing total number of rows by 1.
            rowIdx--;
        });
        CKEDITOR.replace('product_description');
    </script>
@endsection
@endsection
