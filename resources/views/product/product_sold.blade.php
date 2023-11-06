@extends('layout.master')
@section('title','Quản lí sản phẩm')
@section('name_page','Sản phẩm sắp hết hàng')
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
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Bảng Sản phẩm</h3>
    </div>
    <br>
    <div class="row">
      {{-- <div class="col-5"></div> --}}
      
      <div class="col-2" style="margin-left:20px">
          <button type="button" class="btn btn-primary"><a href="{{url('product/create')}}" style="color: white"><i class="fa fa-plus-circle" style="font-size:20px; color: white"></i>Thêm mới</a></button>
      </div>
      <div class="col-5"></div>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã Sản phẩm</th>
            <th>Tên Sản phẩm</th>
            <th>Ảnh neo</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Số lượng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @forelse ($products as $item )
            
            <td> 
              {{$item->id}}
            </td>
            <td>{{ $item->product_code}}</td>
            <td>{{ $item->product_name}}</td>
            <td>
              <img src="/product_images/{{$item->thumbnail}}" style="width:50px" alt="">
            </td>
            <td>{{$item->size_name}}</td>
            <td>{{$item->color_name}}</td>
            <td style="color: rgb(216, 101, 101)">{{$item->product_quantity}}</td>
          </tr>
            @empty
            <tr>
              <td colspan="5">Dữ liệu trống.</td>
            </tr>
            @endforelse 
            
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