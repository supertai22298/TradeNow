@extends('clients.layout.master')
@section('title')
  Người dùng
@endsection
@section('css')
    <style>
      .my-input-group{
        margin: 10px 0px;
      }
      .my-input-group input{
        height: 35px;
        /* box-shadow: 1px 1px 5px 0px; */
        border: 0.5px gray solid;
        border-radius: 3px;
      }
      .my-input-group label{
        padding: 10px 15px;
      }
    </style>
@endsection
@section('content')
  <div class="col-sm-3" style="margin-top: 20px;">
    <div class="row">
      <div class="col-sm-3">
        <img src="images/2019-Nov-Fri-1573786413913.jpg" alt="Ảnh đại diện">
      </div>
      <div class="col-sm-9">
        <h4><span style="font-weight: 700;">Nguyễn Chiếm Hảo</span></h4>
      </div>
    </div>
    <hr>
    <div style="margin-top: 15px;">
      <ul class="nav nav-pills nav-stacked">
        <li id="profile" class="active"><a href="#"><i class="fa fa-user"></i> Tài khoản của tôi</a></li>
        <li id="order"><a href="#"><i class="fa fa-sticky-note"></i> Đơn hàng</a></li>
        <li id="shop"><a href="#"><i class="fa fa-cogs"></i> Quản lý bán hàng</a></li>
      </ul>
    </div>
    <hr>
  </div>
  <div class="col-sm-9">
    <div>
      <h3>Hồ sơ của  tôi</h3>
      <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
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
          <div class="col-md-8">
              <form class="form-horizontal">
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
                        value="" 
                        type="text">
                      </div>
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
                        name="email" 
                        placeholder="Địa chỉ email" 
                        class="form-control" 
                        required="true" 
                        value="" 
                        type="text">
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
                        value="" 
                        type="text">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Giới tính: </label>
                  <div class="controls col-md-8 " style="margin-bottom: 10px">
                      <label class="radio-inline"> 
                        <input type="radio" name="gender" id="id_gender_1" value="M" style="margin-bottom: 10px">
                        Nam
                      </label>
                      <label class="radio-inline"> 
                        <input type="radio" name="gender" id="id_gender_2" value="F" style="margin-bottom: 10px">
                        Nữ 
                      </label>
                      <label class="radio-inline"> 
                        <input type="radio" name="gender" id="id_gender_2" value="F" style="margin-bottom: 10px">
                        Khác
                      </label>
                 </div>
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
                        required="true" 
                        value="" 
                        type="date">
                      </div>
                  </div>
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
                        required="true" 
                        value="" 
                        type="text">
                      </div>
                  </div>
                </div>
              </form>
          </div>
          <div class="col-md-4">
            <img src="images/default_image.png" alt="Ảnh đại diện" id="preview" class="img-fluid">
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
            <div class="">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-book"></i>
                  </span>
                  <textarea class="form-control" name="" id="" rows="5"></textarea>
                </div>
            </div>
          </div>
          <hr>
          <div class="container pull-right">
            <p class="text-center"> 
              <a class="btn btn-success " href="cart.html"><i class="fa fa-check"></i> Lưu thay đổi
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="password-tab" role="tabpanel" aria-labelledby="password-tab-button">
        <div class="row">
          <div class="col-md-8">
              <form class="form-horizontal">
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
                        required="true" 
                        value="" 
                        type="password">
                      </div>
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
                        required="true" 
                        value="" 
                        type="password">
                      </div>
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
                        required="true" 
                        value="" 
                        type="password">
                      </div>
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
                <button type="submit" class="btn btn-success" href="cart.html"><i class="fa fa-check"></i> Lưu thay đổi
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