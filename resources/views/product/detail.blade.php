@extends('layout.master')
@section('title','Quản lí  sản phẩm')
@section('name_page','Thông tin phẩm')
@section('product','active')
@section('content')
@section('css')
@parent
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">

@endsection
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Thông báo: </strong>{{session('success')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Thông báo: </strong>{{session('error')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card-header">
  <h3 class="card-title">Thêm Mới Sản Phẩm</h3>
</div>

  <div class="card-body">
    <div class="row">
       <form action="{{url('product/'.$product->id)}}" method="post" id="quickForm">
        @method('PUT')
        @csrf
          <div class="col6">
            <label for="exampleInputName">Mã sản phẩm</label>
            <input type="text" name="product_code" value="{{ $product->product_code}}" required class="form-control" placeholder="">
          </div>
          
          <div class="col6">
            <label for="exampleInputName">Tên sản phẩm</label>
            <input type="text" name="product_name" value="{{ $product->product_name}}" required class="form-control" placeholder="">
            
          </div>

          <div class="col6">
            <label for="exampleInputName">Tên Hãng</label>
            <select class="form-control" required name="brand_id">
                <option value="" selected></option>
                  @foreach ($brand as $item)
                      <option 
                      @if ($product->brand_id == $item->id)
                      selected="selected"
                      @endif
                      value="{{$item->id}}" 
                      >
                      {{$item->brand_name}}
                    </option>
                  @endforeach
              </select>
          </div>
          <div class="col6">
            <label for="exampleInputName">Tên Loại</label>
            <select class="form-control" required name="type_id">
                <option value="" selected></option>
                  @foreach ($type as $item)
                      <option 
                      @if ($product->type_id == $item->id)
                      selected="selected"
                      @endif
                      value="{{$item->id}}" 
                    >
                      {{$item->type_name}}
                    </option>
                  @endforeach
              </select>
          </div>
          <div class="col6">
            <label for="exampleInputName">Trạng thái</label>
            <select class="form-control" required name="status">
                @if ($product->product_status==0)
                    <option value="0" selected>Hàng sắp về</option>
                    <option value="1">Hàng Sẵn</option>
                    <option value="2">Hàng mới</option>
                @elseif($product->product_status==1)
                    <option value="0" >Hàng sắp về</option>
                    <option value="1"selected>Hàng Sẵn</option>
                    <option value="2">Hàng mới</option>
                @else
                    <option value="0" >Hàng sắp về</option>
                    <option value="1">Hàng Sẵn</option>
                    <option value="2"selected>Hàng mới</option>
                @endif
        
              </select>
              <div class="button" style="margin-top:30px">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </div>
          </div>
       </form>
        <div class="col"></div>
        <form class="col-6" id="quickForm" action="/product/add-images/{{$product->id}}" method="post" enctype="multipart/form-data">
          @csrf
          
            <div style="width:78%;float: left">
              <label for='file' for="exampleInputName">Ảnh sản phẩm</label>
              <input 
              required
                  type="file" 
                  name="product_image[]" 
                  multiple accept="image" 
                  value="{{ old('product_image') }}" 
                  class="form-control" placeholder="">  
                  
            </div>     
            <div style="margin-top:32px;margin-left:20px; float: left;">                 
              <button style="" type="submit" class="btn btn-dark">ADD IMAGE</button>
             </div>
        </form>       
    </div>
    <div class="row mt-4">
     @foreach ($images as $image) 
       <div class="col-md-3 ">
        <div class="card text-white bg-secondary mb-3" style="max-width:20rem">
          <div class="card-body text-center">
            <img src="/product_images/{{$image->url}}" class="card-img-top">
           <a href="/product/remove-image/{{$image->id}}" class="btn btn-danger mt-2">
            <i class="far fa-trash-alt"> Xoá</i>
          </a>
          </div>
        </div>
       </div>
     @endforeach
    </div>
    <div class="title" style="margin-bottom:50px;margin-top: 50px">
      <h4>Bảng sản phẩm chi tiết</h4>
    </div>
    <div class="table-detail ">
      <table id="example1" class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>STT</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($detail as $item)
          <tr>
            <td>{{$item->product_detail_id}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->product_quantity}}</td>
            <td>{{$item->size_name}}</td>
            <td>{{$item->color_name}}</td>
            <th>
              <a href="{{url('product_detail/'.$item->product_detail_id)}}">
                <i class="far fa-edit"> Sửa</i>
              </a>
              </th>
          </tr>
         @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
  @section('scripts')
  @parent
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,"sort":false,
          "buttons": [ "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
  
      function ConfirmDelete()
      {
        var x = confirm("Bạn có chắc chắn muốn xóa không?");
        if (x)
            return true;
        else
          return false;
      }
  </script>
  @endsection 
@endsection
