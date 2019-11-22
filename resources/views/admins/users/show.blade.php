@extends('admins.layout.master')
@section('title')
Người dùng {{ $user->name }}
@endsection
@section('css')
  <!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css "> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="admins/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Chi tiết Người dùng</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{ route('admin.users.index') }}">Người dùng</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    <!-- Main content -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
            <div class="col-12 col-md-12 d-flex align-items-stretch">
                <div class="card bg-light w-100">
                <div class="card-header text-muted border-bottom-0">
                    <h3>Thông tin tài khoản</h3>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="ml-0 mb-0 fa-ul text-muted text-center">
                                <li class="text-center mb-2">
                                    <img style="width: 150px !important;" src="{{ $user->avatar == null ? asset('thumbnails/' . 'default_image.png') : asset('thumbnails/' . $user->avatar) }}" alt="" class="img-fluid">
                                </li>
                                <li><h2 class="lead"><b>{{$user->name}}</b></h2></li>
                                <li class=""><span class="mr-1"><i class="fas fa-lg fa-envelope"></i></span> Email: {!! $user->email == null ? "<small>Chưa cập nhật</small>" : $user->email !!}</li>
                                <li class=""><span class="mr-1"><i class="fas fa-lg fa-phone"></i></span> Số điện thoại : {!! $user->phone_number == null ? "<small>Chưa cập nhật</small>" : $user->phone_number !!}</li>
                                <li class="">{!! $user->is_admin == true ? "<span class='font-weight-bold'>Admin</span>" : "<span class='font-weight-bold'>Người dùng</span>" !!}</li>
                                <li class="">{!! $user->active == true ? "<small class='text-success'>(Hoạt động)</small>" : "<small class='text-warning'>(Khóa)</small>" !!}</li>
                            </ul>
                        </div>
                        <div class="col-md-7">
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-map-marker-alt"></i></span> Địa chỉ: {!! $user->address == null ? "<span> &nbsp Chưa cập nhật</span>" : $user->address !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-venus-mars"></i></span> Giới tính: {!! $user->gender == 0 ? "<span> &nbsp Nữ</span>" : "<span> &nbsp Nam</span>" !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-birthday-cake"></i></span> Ngày Sinh: {!! $user->date_of_birth == null ? "<span> &nbsp Chưa cập nhật</span>" : $user->date_of_birth !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-user-circle"></i></span> Trạng thái tài khoản: {!! $user->active == true ? "<span class='text-success'> &nbsp Hoạt động</span>" : "<span class='text-warning'>&nbsp Khóa</span>" !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-city"></i></span> Tỉnh/Thành phố: {!! $user->city == null ? "<span> &nbsp Chưa cập nhật</span>" : $user->city !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-calendar-alt"></i></span> Ngày tạo: {!! $user->created_at == null ? "<span> &nbsp Chưa cập nhật</span>" : $user->created_at !!}</li>
                                <li class="row"><span class="col-2 col-md-1"><i class="fas fa-lg fa-calendar-alt"></i></span> Ngày cập nhật gần nhất: {!! $user->updated_at == null ? "<span> &nbsp Chưa cập nhật</span>" : $user->updated_at !!}</li>
                            </ul> 
                        </div>
                        <div class="col-md-12 text-muted mt-3">
                            <b>Mô tả: </b>
                            <p> {!! $user->city == null ? "<small>Chưa cập nhật</small>" : $user->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-flat btn-default mr-2"><i class="fas fa-arrow-left"></i>Danh sách</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-flat btn-info"><i class="fas fa-edit"></i>Sửa</a>
                    </div>
                </div>
                </div>
            </div>
            
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('id-active')#nav-users @endsection