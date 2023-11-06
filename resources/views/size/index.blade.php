@extends('layout.master')
@section('title','Quản lí size sản phẩm')
@section('name_page','Size')
@section('size','active')
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
    <h3 class="card-title">Bảng size</h3>
  </div>
  <br>
  <!-- /.card-header -->
  <div class="row">
    {{-- <div class="col-5"></div> --}}
    
    <div class="col-2" style="margin-left:20px">
        <button type="button" class="btn btn-primary"><a href="{{url('size/create')}}" style="color: white"><i class="fa fa-plus-circle" style="font-size:20px; color: white"></i>Thêm mới</a></button>
    </div>
    <div class="col-5"></div>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-hover  text-center">
      <thead>
      <tr>
        <th>STT</th>
        <th>Size</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <tr>
          @forelse ($size as $item)
              <td>{{$item->id}}</td>
              <td>{{$item->size_name}}</td>
              <td>
                <form action="{{url('size/'.$item->id)}}" method="POST">
                  <a href="{{url('size/'.$item->id.'/edit')}}">
                    <i class="far fa-edit"> Sửa</i>
                  </a>
                  ||
                  @method("DELETE")
                  @csrf
                  <button type="submit"  style="border: none" onclick=" return ConfirmDelete()">
                    <a href="" style="color: red"><i class="far fa-trash-alt"> Xóa</i></a>
                  </button>
                </form>
              </td>
        </tr>
          @empty
            <tr>
              <td colspan="3">Dữ liệu trống</td>
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