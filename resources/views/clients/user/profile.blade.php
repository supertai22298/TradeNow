@extends('clients.layout.master')
@section('title')
  Người dùng
@endsection
@section('content')
  @php
      $user = Auth::user();
  @endphp
  <ul class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('client.users.profile') }}">{{ $user->name }}</a></li>
  </ul>
  @include('clients.user.profile_sidebar')
  <div class="col-sm-9">
    <div>
      <h1>Hồ sơ của  tôi</h1>
      <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
      <p id="noti"></p>
      <hr>
      <ul class="nav nav-tabs">
        <li role="presentation" class="active">
          <a style="font-weight: 600;" href="#profile-tab" id="profile-tab-button" data-toggle="pill" role="tab" aria-controls="profile-tab" aria-selected="true">Hồ sơ</a>
        </li>
        <li role="presentation">
          <a style="font-weight: 600;" href="#password-tab" id="password-tab-button" data-toggle="pill" role="tab" aria-controls="password-tab" aria-selected="true">Đổi mật khẩu</a>
        </li>
      </ul>
    </div>
    <div class="tab-content" style="min-height: 200px;">
      <div class="tab-pane fade active in" id="profile-tab" role="tabpanel" aria-labelledby="profile-tab-button">
        <div class="container row">
          <form id="form_profile" class="form-horizontal">
            <div class="col-md-8">
                @csrf
                <div class="form-group">
                  <label class="col-md-4 control-label">Họ tên: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input id="fullName" 
                        name="name" 
                        placeholder="Họ và tên" 
                        class="form-control" 
                        required="true" 
                        value="{{ $user->name }}" 
                        type="text">
                      </div>
                      <small id="noti_name" class="noti"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Email: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <input id="email"
                        placeholder="Địa chỉ email" 
                        class="form-control" 
                        value="{{ $user->email }}"
                        disabled
                        type="email">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Số điện thoại: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-earphone"></i>
                        </span>
                        <input id="phone_number" 
                        name="phone_number" 
                        placeholder="Số điện thoại" 
                        class="form-control" 
                        required="true"
                        min="3"
                        max="13"
                        value=" {{ $user->phone_number }} " 
                        type="text">
                      </div>
                      <small id="noti_phone_number" class="noti"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Giới tính: </label>
                  <div class="controls col-md-8 " style="margin-bottom: 10px">
                    <label class="radio-inline"> 
                      <input type="radio" {{$user->getGender() === 'male' ? 'checked' : '' }} name="gender" id="id_gender_1" value="1" style="margin-bottom: 10px">
                      Nam
                    </label>
                    <label class="radio-inline"> 
                      <input type="radio" {{$user->getGender() === 'female' ? 'checked' : '' }} name="gender" id="id_gender_2" value="0" style="margin-bottom: 10px">
                      Nữ 
                    </label>
                    <label class="radio-inline"> 
                      <input type="radio" {{$user->getGender() === 'orther' ? 'checked' : '' }} name="gender" id="id_gender_2" value="null" style="margin-bottom: 10px">
                      Khác
                    </label>
                 </div>
                 <small id="noti_gender" class="noti"></small>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Ngày sinh: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                        <input id="address" 
                        name="address" 
                        placeholder="Đại chỉ" 
                        class="form-control" 
                        value="{{ $user->date_of_birth }}" 
                        type="date">
                      </div>
                  </div>
                  <small id="noti_date_of_birth" class="noti"></small>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Địa chỉ: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-home"></i>
                        </span>
                        <input id="address" 
                        name="address" 
                        placeholder="Đại chỉ" 
                        class="form-control" 
                        value="{{ $user->address }}" 
                        type="text">
                      </div>
                      <small id="noti_address" class="noti"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Thành phố: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-building"></i>
                        </span>
                        <input id="city" 
                        name="city" 
                        placeholder="Đại chỉ" 
                        class="form-control" 
                        value="{{ $user->city }}" 
                        type="text">
                      </div>
                      <small id="noti_city" class="noti"></small>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
              <img src="thumbnails/{{$user->avatar()}}" alt="Ảnh đại diện" id="preview" class="img-fluid">
              <input
                type="file"
                class="form-control @error('avatar') is-invalid @enderror"
                id="image" name="avatar"
                required
                accept="image/*"
                aria-describedby="inputGroupFileAddon02"
              >
            </div>
            <hr>
            <div class="form-group col-md-12">
              <label class="control-label">Mô tả: </label>
              <small id="noti_description" class="noti"></small>
              <div class="">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-book"></i>
                    </span>
                    <textarea form="form_profile" class="form-control" name="description" id="" rows="5">{{ $user->description }}</textarea>
                  </div>
              </div>
            </div>
          </form>
          <hr>
          <div class="container pull-right">
            <p class="text-center"> 
              <button form="form_profile" type="button" id="btn_profile" class="btn btn-success " href=""><i class="fa fa-check"></i> Lưu thay đổi
              </button>
            </p>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="password-tab" role="tabpanel" aria-labelledby="password-tab-button">
        <div class="row">
          <div class="col-md-8">
              <form id="change_password" class="form-horizontal">
                <div class="form-group">
                  <label class="col-md-4 control-label">Mật khẩu cũ: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input id="old_password" 
                        name="old_password" 
                        placeholder="Mật khẩu cũ" 
                        class="form-control" 
                        required
                        value="" 
                        type="password">
                      </div>
                      <small id="noti_old_password" class="noti"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Mật khẩu mới: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input id="old_password" 
                        name="new_password" 
                        placeholder="Mật khẩu mới" 
                        class="form-control" 
                        required
                        value="" 
                        type="password">
                      </div>
                      <small id="noti_new_password" class="noti"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Nhập lại mật khẩu mới: </label>
                  <div class="col-md-8 ">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input id="re_password" 
                        name="re_password" 
                        placeholder="Nhập lại mật khẩu mới" 
                        class="form-control" 
                        required
                        value="" 
                        type="password">
                      </div>
                      <small id="noti_re_password" class="noti"></small>
                  </div>
                </div>
              </form>
          </div>
          <div class="col-md-4">
            <h3>Cảnh báo <i class="fa fa-exclamation-triangle" style="color: orange"></i></h3>
            <p>Nếu sử dụng cùng một mật khẩu cho nhiều tài khoản, bạn sẽ có nguy cơ bị tấn công cao hơn. Bạn nên sử dụng mật khẩu khác nhau cho mỗi tài khoản.</p>
          </div>
          <hr>
          <div class="container pull-right">
              <p class="text-center"> 
                <button id="btn_change_password" type="button" class="btn btn-success"><i class="fa fa-check"></i> Lưu thay đổi
                </button>
              </p>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('id-active')home @endsection
@section('js')
@include('clients.user.profile_ajax')
@include('clients.user.change_password')
<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#preview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#image").change(function () {
      readURL(this);
  });
</script>
@endsection