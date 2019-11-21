@extends('admins.layout.master')
@section('title')
    Sửa khuyến mãi {{$promotion->title}}
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
              <h1>Sửa khuyến mãi {{ $promotion->title }}</h1>
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
                <h3 class="card-title">Vui lòng sửa đúng sự thật </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <form  action="{{route('admin.promotions.update',[$promotion->id])}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{--  --}}
                                <div class="form-group">
                                    <label for="type" class="form-label">
                                        Loại
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="type"
                                            name="type"
                                            value="{{ $promotion->title }}"
                                            placeholder="Nhập tên loại khuyến mãi"
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                    @error('name')
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
                                            value="{{ $promotion->code }}"
                                            placeholder="Nhập mã khuyến mãi"
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                    @error('name')
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
                                            value="{{ $promotion->title }}"
                                            placeholder="Nhập tên tiêu đề khuyến mãi"
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        Mô tả
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="description"
                                            name="description"
                                            value="{{ $promotion->description }}"
                                            placeholder="Nhập mô tả khuyến mãi"
                                            required
                                            minlength="3"
                                        />
                                    </div>
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="reductionLevel" class="form-label">
                                        reduction level
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="reductionLevel"
                                            name="reduction_level"
                                            value="{{ $promotion->reduction_level }}"
                                            placeholder="Nhập reduction level"
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
                                        Banner<span class="text text-danger"></span>
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
                                    @error('image')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        Banner Thumbnail<span class="text text-danger"></span>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input @error('image')is-invalid @enderror"
                                                id="banner-thumbnail"
                                                name="banner-thumbnail"
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
                                    <label>Ngày bắt đầu  :<span style="color:red"> {{$promotion->started_at}}</span></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="date" value="{{$promotion->started_at}}" name="started_at" class="form-control float-right" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ngày kết thúc: <span style="color:red"> {{$promotion->finished_at}}</span></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="date" value="{{$promotion->finished_at}}" name="finish_at" class="form-control float-right" >
                                    </div>
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
                        <h2>Banner</h2>
                        <img src="{{ asset('thumbnails/'.$promotion->banner)}}" alt="Hình ảnh hiển thị" id="banner-preview" class="img-fluid">
                        <br>
                        <h2>Banner thumbnails</h2>
                        <img src="{{ asset('thumbnails/'.$promotion->banner_thumbnail) }}" alt="Hình ảnh hiển thị" id="banner-thumbnail-preview" class="img-fluid">

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