@extends('admins.layout.master')
@section('title')
Quản lý người dùng
@endsection
@section('css')
  <!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css "> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="admins/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('content')
@php
    $user = Auth::user();
@endphp
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hồ sơ cá nhân</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
              <li class="breadcrumb-item active">Hồ sơ cá nhân</li>
          </ol>
          </div>
        </div>
        <p id="noti"></p>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0 bg-light">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active-default is-active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Hồ sơ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link is-active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Đổi mật khẩu</a>
                </li>
                </ul>
            </div>
            <div class="card-body p-0 pt-1">
              <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body p-2">
                        <form id="form_profile" class="form-horizontal">
                          <div class="row">
                              <div class="col-md-8">
                                  @csrf
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Họ tên: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                            </span>
                                          </div>
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
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Email: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="fa fa-envelope"></i>
                                            </span>
                                          </div>
                                          <input id="email"
                                          placeholder="Địa chỉ email" 
                                          class="form-control" 
                                          value="{{ $user->email }}"
                                          disabled
                                          type="email">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Số điện thoại: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="fa fa-phone"></i>
                                            </span>
                                          </div>
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
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Giới tính: </label>
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
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Ngày sinh: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                            </span>
                                          </div>
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
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Địa chỉ: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="fa fa-home"></i>
                                            </span>
                                          </div>
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
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label ">Thành phố: </label>
                                    <div class="col-md-8 ">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                            </span>
                                          </div>
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
                                <img style="margin: auto;" src="thumbnails/{{$user->avatar()}}" alt="Ảnh đại diện" id="preview" class="img-fluid">
                                <input
                                  type="file"
                                  class="form-control @error('avatar') is-invalid @enderror"
                                  id="image" name="avatar"
                                  required
                                  accept="image/*"
                                  aria-describedby="inputGroupFileAddon02"
                                >
                              </div>
                          </div>
                          <hr>
                          <div class="form-group col-md-12">
                            <label class="col-form-label ">Mô tả: </label>
                            <small id="noti_description" class="noti"></small>
                            <div class="">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="fa fa-book"></i>
                                    </span>
                                  </div>
                                  <textarea form="form_profile" class="form-control" name="description" id="" rows="5">{{ $user->description }}</textarea>
                                </div>
                            </div>
                          </div>
                        </form>
                        <hr>
                        <div class="container">
                          <p class="text-right"> 
                            <button form="form_profile" type="button" id="btn_profile" class="btn btn-success " href=""><i class="fa fa-check"></i> Lưu thay đổi
                            </button>
                          </p>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body p-2">
                        <div class="row">
                          <div class="col-md-8">
                              <form id="change_password" class="form-horizontal">
                                <div class="form-group row">
                                  <label class="col-md-4 ">Mật khẩu cũ: </label>
                                  <div class="col-md-8 ">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                          <i class="fa fa-lock"></i>
                                          </span>
                                        </div>
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
                                <div class="form-group row">
                                  <label class="col-md-4 ">Mật khẩu mới: </label>
                                  <div class="col-md-8 ">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                          <i class="fa fa-lock"></i>
                                          </span>
                                        </div>
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
                                <div class="form-group row">
                                  <label class="col-md-4 ">Nhập lại mật khẩu mới: </label>
                                  <div class="col-md-8 ">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                          <i class="fa fa-lock"></i>
                                          </span>
                                        </div>
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
                          <div class="container">
                              <p class="text-right"> 
                                <button id="btn_change_password" type="button" class="btn btn-success"><i class="fa fa-check"></i> Lưu thay đổi
                                </button>
                              </p>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script>
  $(document).ready(function(){
    // active-default
    if(!$('.is-active').hasClass('active')){
      $('.active-default').addClass('active');
    }
  })
</script>
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