
@extends('layout.master')
@section('title','Thống kê Doanh thu')
@section('name_page','Thống kê')
@section('content')
@section('css')
@parent
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
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
    <h3 class="card-title">Bảng doanh thu</h3>
  </div>
  <br>
  <!-- /.card-header -->
  <div class="row">
    {{-- <div class="col-5"></div> --}}
    
    <div class="col-5"></div>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover  text-center">
      <thead>
      <tr>
        <th>Tháng </th>
        <th>Năm</th>
        <th>Doanh Thu</th>
        <th>Chi tiết</th>
      </tr>
      </thead>
      <tbody>
          @forelse ($revenue as $item)
              <tr>
                <td>{{\Carbon\Carbon::parse($item->month)->format('m')}}</td>
                <td>{{\Carbon\Carbon::parse($item->month)->format('Y')}}</td>
                <td>{{number_format($item->total)}}đ</td>
                <td>
                  <a href="{{url('revenue/detail/'.$item->month)}}">xem</a>
                </td>
              </tr>
          @empty
              <tr>
                <td colspan="3">Doanh thu trống</td>
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
            "responsive": true, "lengthChange": false, "autoWidth": false,"sort": false,
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
      </script>
      @endsection 
@endsection
