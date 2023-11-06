@extends('layout.master')
@section('title','Quản lí màu sản phẩm')
@section('name_page','Sửa Màu')
@section('color','active')
@section('content')

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
<!-- /.card-header -->
<!-- form start -->
<div class="card-header">
  <h3 class="card-title"> Cập nhật màu</h3>
</div>
<form action="{{url('color/'.$color->id)}}" method="POST" id="quickForm">
  @method('PUT')
  @csrf
  <div class="card-body">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <label for="exampleInputName">Tên Hãng</label>
          <input type="text" name="color_name" value="{{$color->color_name  }}" class="form-control" placeholder="">
          {{-- <span class="alert text-danger  font-italic font-weight-bolder">{{ $errors->first('name') }}</span> --}}
        </div>
        <div class="col"></div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer text-center">
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </div>
</form>
@endsection
