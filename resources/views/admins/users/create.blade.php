@extends('admins.layout.master')
@section('title')
Thêm mới người dùng
@endsection
@section('css')
<link rel="stylesheet" href="admins/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="admins/plugins/toastr/toastr.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Thêm mới người dùng</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}"> người dùng </a></li>
                <li class="breadcrumb-item active">Thêm mới</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Vui lòng nhập những thông tin người dùng</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <form action="{{ route('admin.users.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card-body">
                                {{--  --}}
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Tên người dùng
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text" id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="Nhập tên người dùng..."
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            type="email" id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Nhập địa chỉ email..."
                                            required
                                        />
                                    </div>
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        Mật khẩu
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('password') is-invalid @enderror"
                                            type="password" id="password"
                                            name="password"
                                            value="{{ old('password') }}"
                                            placeholder="Nhập mật khẩu..."
                                            required
                                            minlength="3"
                                            maxlength="16"
                                        />
                                    </div>
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="avatar" class="form-label">
                                        Hình ảnh<span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input @error('avatar') is-invalid @enderror"
                                                id="image" name="avatar"
                                                required
                                                accept="image/*"
                                                aria-describedby="inputGroupFileAddon02"
                                            >
                                            <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Chọn 1 hình ảnh</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroupFileAddon02"><i class="fas fa-image"></i></span>
                                        </div>
                                        @error('avatar')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="date_of_birth" class="form-label">
                                        Ngày sinh
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            type="date" id="date_of_birth"
                                            name="date_of_birth"
                                            value="{{ old('date_of_birth') }}"
                                            placeholder="Nhập Ngày sinh..."
                                            aria-describedby="datepicker"
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="datepicker"><i class="fas fa-birthday-cake"></i></span>
                                        </div>
                                    </div>
                                    @error('date_of_birth')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="gender" class="form-label">Giới tính
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" >
                                        <option selected="selected" value="false">Nữ</option>
                                        <option value="true">Nam</option>
                                    </select>
                                    @error('gender')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">
                                        Số điện thoại
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            type="text" id="phone_number"
                                            name="phone_number"
                                            value="{{ old('phone_number') }}"
                                            placeholder="Nhập số điện thoại của bạn..."
                                        />
                                    </div>
                                    @error('phone_number')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        Địa chỉ
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('address') is-invalid @enderror"
                                            type="text" id="address"
                                            name="address"
                                            value="{{ old('address') }}"
                                            placeholder="Nhập địa chỉ của bạn..."
                                        />
                                    </div>
                                    @error('address')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="city" class="form-label">
                                        Thành phố
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('city') is-invalid @enderror"
                                            type="text" id="city"
                                            name="city"
                                            value="{{ old('city') }}"
                                            placeholder="Nhập tên thành phố..."
                                        />
                                    </div>
                                    @error('city')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="active" class="form-label">Trạng thái
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select id="active" name="active" class="form-control">
                                        <option selected="selected" value="true">Hoạt động</option>
                                        <option value="false">Khóa</option>
                                    </select>
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="is_admin" class="form-label">Loại tài khoản
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select id="is_admin" name="is_admin" class="form-control">
                                        <option selected="selected" value="false">Người dùng</option>
                                        <option value="true">Admin</option>
                                    </select>
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        Mô tả
                                    </label>
                                    <div class="input-group">
                                        <textarea
                                            class="form-control"
                                            type="text" id="description"
                                            name="description"
                                            placeholder="Mô tả người dùng...">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-save"> </i> Lưu</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-flat btn-secondary ml-5"><i class="fas fa-arrow-left"></i> Danh sách</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <div class="col-md-5 border border-light">
                        <img src="images/default_image.png" alt="Hình ảnh hiển thị" id="preview" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    $("#image").change(function() {
    readURL(this);
    });
    </script>
    <script src="admins/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="admins/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript">
         $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('input').map((index, ele) => {
                ele.addEventListener('invalid', () => {
                    Toast.fire({
                        type: 'error',
                        title: 'Vui lòng nhập đúng định dạng dữ liệu'
                    })
                })
            });
         })
    </script>
@endsection