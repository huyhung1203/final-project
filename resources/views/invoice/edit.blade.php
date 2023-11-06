@extends('layout.master')
@section('title','Quản lí hoá đơn')
@section('name_page','Hoá Đơn')
@section('invoice','active')
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
<style>

  .col-5 {
    width: 20%;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  h4 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  span {
    font-size: 16px;
    color: #666;
  }

  select {
    width: 100%;
    height: 35px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f8f8f8;
    color: #333;
    font-size: 14px;
  }

  option {
    color: #333;
    font-size: 14px;
  }

</style>
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
    <h3 class="card-title">Bảng Hoá Đơn</h3>
  </div>
  <br>
    <div class="card-body">
      <form action="{{url('invoice/'.$invoice->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="">
          <input type="text" name="id" class="form-control" placeholder=""value="{{$invoice->id}}" hidden>
        </div>
        <div class="row">
          <div class="col-5">
            <h4>Họ tên người đặt</h4>
            <span>{{$invoice->receiver_name}}</span>
          </div>
          <div class="col-5">
            <h4>Số ĐT người đặt</h4>
            <span>{{$invoice->receiver_phone}}</span>
          </div>
          <div class="col-5">
            <h4>Địa Chỉ người đặt</h4>
            <span>{{$invoice->receiver_address}}</span>
          </div>
          <div class="col-5">
            <h4>Tổng tiền</h4>
            <span>{{$invoice->total_amount}}</span>
          </div>
          <div class="col-5">
            <h4>Trạng thái</h4>
            <select name="status" id="status" class="form-control">
              @if ($invoice->invoice_status==1)
                  <option value="{{$invoice->invoice_status}}" selected>Đợi duyệt</option>
                  <option value="2" >Duyệt</option>
                  <option value="0">Huỷ</option>
              @elseif($invoice->invoice_status==2)
                  <option value="{{$invoice->invoice_status}}" selected>Đã uyệt</option>
                  <option value="0">Huỷ</option>  
              @else
                  <option value="{{$invoice->invoice_status}}" selected>Huỷ</option>
              @endif
            </select>
          </div>
        </div>
        <br>
        <div style="justify-content: center;align-content: center">
          <button style="align:center" type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
      </form>
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