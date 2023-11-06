@extends('layout.master')
@section('title','Quản lí sản phẩm')
@section('name_page','Sửa chi tiết sản phẩm')
@section('product','active')
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
  <h3 class="card-title">Thêm Mới Hãng</h3>
</div>
<form action="{{url('product/edit-detail/'.$detail->id.'/'.$detail->product_id)}}" method="POST" id="quickForm">
  @csrf
  {{-- @method('PUT') --}}
  <div class="card-body">
    <div class="row">
        <div class="col-6">
            <label for="exampleInputName">ID sản phẩm</label>
            {{-- <h3>{{$detail->id}}</h3> --}}
            <input type="number" name="id" value="{{$detail->id }}" class="form-control" hidden>
            <input type="number" name="product_id" value="{{$detail->product_id}}" class="form-control" disabled="disabled">
        </div>

        <div class="col-6">
            <label for="exampleInputName">Số lượng</label>
            <input type="number" name="quantity" value="{{$detail->product_quantity }}" class="form-control" placeholder="">
        </div>
        <div class="col-6">
          <label for="exampleInputName">Giá</label>
          <input type="number" name="price" value="{{$detail->price }}" class="form-control" placeholder="">
      </div>
      <div class="col-6">
        <label for="exampleInputName">Size</label>
        <select name="size" id="size" class="form-control">
          @foreach ($size as $item)
              <option 
              @if ($item->id == $detail->size_id)
                selected
              @endif
              value="{{$item->id}}">{{$item->size_name}}</option>
          @endforeach
        </select>
    </div>
      <div class="col-6">
        <label for="exampleInputName">Màu</label>
        <select name="color" id="color" class="form-control">
          @foreach ($color as $item)
              <option 
              @if ($item->id == $detail->size_id)
                selected
              @endif
              value="{{$item->id}}">{{$item->color_name}}</option>
          @endforeach
        </select>
    </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer text-center">
    <button type="submit" class="btn btn-primary">Thêm</button>
  </div>
</form>
@endsection
