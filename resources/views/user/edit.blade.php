@extends('layout.master')
@section('name_page','Chỉnh sửa người dùng')
@section('user','active')   
@section('content')
    <div class="card-header">
      <h4>Chỉnh sửa thông tin người dùng</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('user/'.$user->id)}}">
        @csrf
        @method('PUT')
      
        <div class="form-group">
          <label for="first_name">Họ:</label>
          <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}" required>
        </div>
      
        <div class="form-group">
          <label for="last_name">Tên:</label>
          <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" required>
        </div>
      
        <div class="form-group">
          <label for="phone_number">Số điện thoại:</label>
          <input type="tel" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
        </div>
      
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
      
        <div class="form-group">
          <label for="user_address">Địa chỉ:</label>
          <textarea name="user_address" id="user_address" class="form-control" required>{{ $user->user_address }}</textarea>
        </div>
      
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
      </form>
      
    </div>
@endsection