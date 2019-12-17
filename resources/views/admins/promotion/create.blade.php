@extends('admins.layout.master')
@section('title')
    Thêm khuyến mãi
@endsection
@section('css')
<link rel="stylesheet" href="admins/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="admins/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="admins/plugins/toastr/toastr.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Thêm khuyến mãi</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.promotions.index') }}"> Khuyến mãi </a></li>
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
                        <form action="{{route('admin.promotions.store')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <!-- @method('PUT') -->
                            <div class="card-body">
                                {{--  --}}
                                <div class="form-group">
                                    <label for="type" class="form-label">
                                        Loại
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('type') is-invalid @enderror"
                                            type="text"
                                            id="type"
                                            name="type"
                                            value="{{old('type')}}"
                                            placeholder="Nhập tên loại khuyến mãi"
                                            minlength="3"
                                        />
                                    </div>
                                    @error('type')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="code" class="form-label">
                                        Mã khuyến mãi
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="code"
                                            name="code"
                                            value="{{old('code')}}"
                                            placeholder="Nhập mã khuyến mãi"
                                            minlength="3"
                                        />
                                    </div>
                                    @error('code')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">
                                        Tiêu đề
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="title"
                                            name="title"
                                            value="{{old('title')}}"
                                            placeholder="Nhập tên tiêu đề khuyến mãi"
                                            minlength="3"
                                        />
                                    </div>
                                    @error('title')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        Mô tả
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <textarea 
                                        id="description"
                                        required
                                        class="form-control @error('name') is-invalid @enderror" 
                                        rows="4"
                                        name="description"
                                        placeholder="Nhập mô tả khuyến mãi"
                                    >
                                      {{old('description')}}
                                    </textarea>
                                    @error('description')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="reducetionLevel" class="form-label">
                                        reduction level
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="number"
                                            id="reducetionLevel"
                                            name="reduction_level"
                                            placeholder="Nhập reduction level"
                                            minlength="2"
                                            value="{{old('reduction_level')}}"
                                        />
                                    </div>
                                    @error('reduction_level')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        Banner<span class="text text-danger"> * </span>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input @error('image')is-invalid @enderror"
                                                id="banner" 
                                                name="banner"
                                                accept="image/*"
                                                
                                                aria-describedby="inputGroupFileAddon02"
                                            >
                                            <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Chọn 1 hình ảnh</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroupFileAddon02"><i class="fas fa-image"></i></span>
                                        </div>
                                    </div>
                                    @error('banner')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        Banner Thumbnail<span class="text text-danger"> *</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input @error('image')is-invalid @enderror"
                                                id="banner-thumbnail"
                                                name="banner-thumbnail"
                                                accept="image/*"
                                                require
                                                aria-describedby="inputGroupFileAddon02"
                                            >
                                            <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Chọn 1 hình ảnh</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroupFileAddon02"><i class="fas fa-image"></i></span>
                                        </div>
                                    </div>
                                    @error('banner_thumbnail')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}
                                <div class="form-group">
                                    <label>Ngày bắt đầu:
                                    <span class="text text-danger">*</span>

                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="date" value="" name="started_at" class="form-control float-right" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ngày kết thúc:</label>
                                    <span class="text text-danger">*</span>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="date" value="" name="finish_at" class="form-control float-right" >
                                    </div>
                                    @error('finish_at')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--  -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-save"> </i> Lưu</button>
                                <a href="{{ route('admin.promotions.index') }}" class="btn btn-flat btn-secondary ml-5"><i class="fas fa-arrow-left"></i> Danh sách</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <div class="col-md-5 border border-light">
                        <img src="" alt="Hình ảnh hiển thị" id="banner-preview" class="img-fluid">
                        <br>
                        <img src="" alt="Hình ảnh hiển thị" id="banner-thumbnail-preview" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <!-- date - range - picker -->
    <script src="admins/plugins/plugins/daterangepicker/daterangepicker.js"></script>
    
    <script>
         function readURL(input,name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $(name).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#banner").change(function() {
        readURL(this,'#banner-preview');
        });
        $('#banner-thumbnail').change(function(){
        readURL(this,'#banner-thumbnail-preview');
        })


        $(document).ready(function(){
        
        // turn off all background color of other topic in sidebar
        let ele = $('.nav-link')
        for(let i = 0; i < ele.length; i++) {
            ele[i].classList.remove('active');
        }

        //change background color to Khuyen Mai in sidebar
        $('#nav-promotions').addClass('active');
        })
</script>
@endsection