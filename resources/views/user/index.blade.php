
@extends('layout.master')
@section('title','Quản lí người dùng')
@section('name_page','Khách Hàng')
@section('user','active')
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
    <h3 class="card-title">Bảng người dùng</h3>
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
        <th>STT</th>
        <th>Tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Thao Tác</th>
      </tr>
      </thead>
      <tbody>
        <tr>
          @forelse ($users as $user)
             
                <td>{{$user->id}}</td>
                <td>{{$user->first_name}} {{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                  <form action="{{url('user/'.$user->id)}}" method="POST">
                    <a href="{{url('user/'.$user->id.'/edit')}}">
                      <i class="far fa-edit"> Sửa</i>
                    </a>
                    {{-- ||
                    @method("DELETE")
                    @csrf
                    <button type="submit"  style="border: none" onclick=" return ConfirmDelete()">
                      <a href="" style="color: red"><i class="far fa-trash-alt"> Xóa</i></a>
                    </button> --}}
                  </form>
                </td>
              </tr>
          @empty
              <tr>
                <td colspan="5">Doanh thu trống</td>
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
        // var table = $('#example1').DataTable();
        //   table.destroy();
        //   // $('#example1').DataTable();
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,"sort": false,
            "buttons": [ "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          // $('#example2').DataTable({
          //   "paging": true,
          //   "lengthChange": false,
          //   "searching": false,
          //   "ordering": true,
          //   "info": true,
          //   "autoWidth": false,
          //   "responsive": true,
          // });
        });
      </script>
      @endsection 
@endsection
