@extends('layout.master')
@section('title','Quản lí size sản phẩm')
@section('name_page','Thêm Size')
@section('size','active')
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
  <h3 class="card-title">Thêm Mới Size</h3>
</div>
<form action="{{url('size')}}" method="POST" id="quickForm">
  @csrf
  {{-- @method('PUT') --}}
  <div class="card-body">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <label for="exampleInputName">Tên Size</label>
          <input type="text" name="size_name" value="{{ old('size_name') }}" class="form-control" placeholder="">
          {{-- <span class="alert text-danger  font-italic font-weight-bolder">{{ $errors->first('name') }}</span> --}}
        </div>
        <div class="col"></div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer text-center">
    <button type="submit" class="btn btn-primary">Thêm</button>
  </div>
</form>
@endsection
