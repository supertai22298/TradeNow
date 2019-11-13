@extends('admins.layout.master')
@section('title')
Thêm mới thương hiệu
@endsection
@section('css')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Thêm mới thương hiệu</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.brands.index') }}"> Thương hiệu </a></li>
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
                <h3 class="card-title">Vui lòng nhập những thông tin víp cà chua</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <form action="{{ route('admin.brands.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card-body">
                                {{--  --}}
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Tên thương hiệu
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input 
                                            class="form-control" 
                                            type="text" id="name" 
                                            name="name" 
                                            value="{{ old('name') }}"
                                            placeholder="Nhập tên thương hiệu..."
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        Hình ảnh<span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input 
                                                type="file" 
                                                class="custom-file-input" 
                                                id="image" name="image"
                                                required
                                                accept="image/*"
                                                aria-describedby="inputGroupFileAddon02"
                                            >
                                            <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Chọn 1 hình ảnh</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroupFileAddon02"><i class="fas fa-image"></i></span>
                                        </div>
                                    </div>
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
                                            placeholder="Mô tả thương hiệu...">{{ old('description') }}</textarea>
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
                        <img src="" alt="Hình ảnh hiển thị" id="preview" class="img-fluid">
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
@endsection