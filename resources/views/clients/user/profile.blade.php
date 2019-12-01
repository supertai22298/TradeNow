@extends('clients.layout.master')
@section('title')
  Người dùng
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
    <div style="margin-top: 15px;">
        <ul class="nav nav-pills nav-stacked">
          <li id="profile" class="active"><a href="#">Tài khoản của tôi</a></li>
          <li id="order"><a href="#">Đơn hàng</a></li>
          <li id="shop"><a href="#">Quản lý bán hàng</a></li>
        </ul>
      </div>
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
        <li role="presentation">
          <a style="font-weight: 600;" href="#three-tab" id="three-tab-button" data-toggle="pill" role="tab" aria-controls="three-tab" aria-selected="true">Hồ sơ</a>
        </li>
      </ul>
    </div>
    <div class="tab-content" style="min-height: 300px;">
      <div class="tab-pane fade active in" id="profile-tab" role="tabpanel" aria-labelledby="profile-tab-button">
        hihi
      </div>
      <div class="tab-pane fade" id="password-tab" role="tabpanel" aria-labelledby="password-tab-button">
        hihi2
      </div>
      <div class="tab-pane fade" id="three-tab" role="tabpanel" aria-labelledby="three-tab-button">
        hihi3
      </div>
    </div>
  </div>
@endsection
@section('id-active')home @endsection