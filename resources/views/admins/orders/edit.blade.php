@extends('admins.layout.master')
@section('title')
Sửa thương hiệu {{ $brand->name }}
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
        <h1>Sửa thương hiệu {{ $brand->name }}</h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('admin.brands.index') }}"> Thương hiệu </a></li>
          <li class="breadcrumb-item active">Chỉnh sửa</li>
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
          <h3 class="card-title">Vui lòng sửa đúng sự thật những thông tin víp cà chua</h3>
      </div>
      <div class="card-body">
          <div class="row">
              <div class="col-md-7">
                  <form onsubmit="return confirm('Bạn chắc chắn muốn sửa')" action="{{ route('admin.brands.update', $brand->id) }}" enctype="multipart/form-data" method="post">
                      @csrf
                      @method('PUT')
                      <div class="card-body">
                          {{--  --}}
                          <div class="form-group">
                              <label for="name" class="form-label">
                                  Tên thương hiệu
                                  <span class="text text-danger">*</span>
                              </label>
                              <div class="input-group">
                                  <input
                                      class="form-control @error('name') is-invalid @enderror"
                                      type="text" id="name"
                                      name="name"
                                      value="{{ $brand->name }}"
                                      placeholder="Nhập tên thương hiệu..."
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
                              <label for="image" class="form-label">
                                  Hình ảnh<span class="text text-danger"></span>
                              </label>
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input
                                          type="file"
                                          class="custom-file-input @error('image')is-invalid @enderror"
                                          id="image" name="image"
                                          accept="image/*"
                                          aria-describedby="inputGroupFileAddon02"
                                      >
                                      <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Chọn 1 hình ảnh</label>
                                  </div>
                                  <div class="input-group-append">
                                      <span class="input-group-text" id="inputGroupFileAddon02"><i class="fas fa-image"></i></span>
                                  </div>
                              </div>
                              @error('image')
                                  <span class="text text-danger">{{ $message }}</span>
                              @enderror
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
                                      placeholder="Mô tả thương hiệu...">{{ $brand->description }}</textarea>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                          <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-save"> </i> Lưu</button>
                          <a href="{{ route('admin.brands.index') }}" class="btn btn-flat btn-secondary ml-5"><i class="fas fa-arrow-left"></i> Danh sách</a>
                      </div>
                      <!-- /.card-footer -->
                  </form>
              </div>
              <div class="col-md-5 border border-light">
                  <img src="{{ asset('thumbnails/' . $brand->thumbnail) }}" alt="Hình ảnh hiển thị" id="preview" class="img-fluid">
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
      })
    })

</script>
@endsection
@section('id-active')#nav-brands @endsection