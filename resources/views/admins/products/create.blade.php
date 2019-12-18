@extends('admins.layout.master')
@section('title')
Thêm mới sản phẩm
@endsection
@section('css')
<link rel="stylesheet" href="admins/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="admins/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="admins/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="admins/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
    /* Style the form */
    #newProductForm {
        background-color: #ffffff;
        margin: 30px auto;
        padding: 40px;
        width: 80%;
        min-width: 300px;
    }

    /* Style the input fields */
    input, select, textarea {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid, textarea.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
    /* display: none; */
    }

    /* Make circles that indicate the steps of the form: */
    .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
    opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
    background-color: #4CAF50;
    }
    button {
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }
    .row {
      box-sizing: border-box;
    }

</style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thêm mới sản phẩm</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}"> Sản phẩm </a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
@include('components.success')
<!-- Main content -->
<section class="content">
  <div class="card card-success">
      <div class="card-header">
          <h3 class="card-title p-3">Vui lòng nhập những thông tin víp cà chua</h3>
      </div>
      @if ($errors->all())
        <div class="alert alert-danger">Có lỗi xảy ra</div>
      @endif
      <div class="card-body">
          <div class="container">
              <h3>Thêm mới sản phẩm</h3>
              <p>Vui lòng nhập thông tin phù hợp</p>
          </div>
          <form id="newProductForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="tab">
              <p>
                <label for="name">Tên sản phẩm <span class="text text-danger">*</span></label>
                <input id="name" 
                  type="text" 
                  name="name" 
                  value="{{ old('name') }}" 
                  required placeholder="Tên sản phẩm" minlength="3"
                  class="@error('name') invalid @enderror">
                @error('name')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="category_id">Danh mục  <span class="text text-danger">*</span></label>
                <select id="category_id" name="category_id" required >
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                      @if ($category->id == old('category_id'))
                        selected
                      @endif
                    >
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                  <label for="brand_id">Thương hiệu  <span class="text text-danger">*</span></label>
                  <select id="brand_id" name="brand_id" required >
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}"
                        @if ($brand->id == old('brand_id'))
                        selected
                      @endif
                      >
                        {{ $brand->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('brand_id')
                    <span class="text text-danger">{{ $message }}</span>
                  @enderror
              </p>
            </div>
            
            <div class="tab">
              <p>
                <label for="amount">Số lượng trong kho <span class="text text-danger">*</span></label>
                <input id="amount" 
                  value="{{ old('amount') }}"
                  name="amount" required type="number" 
                  placeholder="Số lượng trong kho" 
                  class="@error('amount') invalid @enderror"
                >
                @error('amount')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="price">Giá bán lẻ <span class="text text-danger">*</span></label>
                <input id="price" 
                  class="@error('price') invalid @enderror" 
                  name="price" value="{{ old('price') }}" 
                  required min="1000"
                  step="1000"
                  type="number" 
                  placeholder="Giá bán lẻ">
                @error('price')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="description">Mô tả sản phẩm <span class="text text-danger">*</span></label>
                <textarea id="description" 
                  class="@error('description') invalid @enderror"  
                  name="description" 
                  minlength="10"
                  required placeholder="Mô tả sản phẩm" >{{ old('description') }}</textarea>
                @error('description')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              
            </div>
            
            <div class="tab row" id="productDetail">
              <div class="mb-3 col-md-12">
                <button id="addChild" type="button" class="btn-primary d-block">Thêm thuộc tính</button>
              </div>
              <div class="productDetail">
                <p class="d-inline-block col-md-5">
                  <label>Tên thuộc tính <span class="text text-danger">*</span></label>
                  <input type="text" 
                    minlength="2"
                    class="@error('detail_type.*') invalid @enderror" 
                    required name="detail_type[]" 
                    value="{{ old('detail_type.0') }}" 
                    multiple placeholder="Kích thước, Màu sắc ..." 
                    >
                </p>
                <p class="d-inline-block col-md-5">
                  <label>Mô tả thuộc tính <span class="text text-danger">*</span></label>
                  <input type="text" 
                    minlength="2"
                    required class="@error('detail_description.*') invalid @enderror" 
                    name="detail_description[]" value="{{ old('detail_description.0') }}" 
                    multiple placeholder="30 * 30 * 30, đỏ" 
                    >
                </p>
                <p class="d-inline-block col-md-1"><button onclick="removeNode(this)" class="btn-sm btn-danger remove-child" type="button"><i class="far fa-window-close"></i></button></p>
              </div>
              @error('detail_type.*')
              <span class="text text-danger">{{ $message }}</span>
              @enderror
              @error('detail_description.*')
              <span class="text text-danger">{{ $message }}</span>
              @enderror
              <div class="productDetail">
                <p class="d-inline-block col-md-5">
                  <label>Tên thuộc tính <span class="text text-danger">*</span></label>
                  <input type="text" class="@error('detail_type.*') invalid @enderror" 
                    required name="detail_type[]" 
                    minlength="2"
                    value="{{ old('detail_type.1') }}" 
                    multiple placeholder="Kích thước, Màu sắc ..." >
                </p>
                <p class="d-inline-block col-md-5">
                  <label>Mô tả thuộc tính <span class="text text-danger">*</span></label>
                  <input type="text" 
                    minlength="2"
                    required name="detail_description[]" 
                    class="@error('detail_description.*') invalid @enderror" 
                    value="{{ old('detail_description.1') }}" 
                    multiple placeholder="30 * 30 * 30, đỏ" >
                </p>
                <p class="d-inline-block col-md-1"><button onclick="removeNode(this)" class="btn-sm btn-danger remove-child" type="button"><i class="far fa-window-close"></i></button></p>
              </div>
              @error('detail_type.*')
              <span class="text text-danger">{{ $message }}</span>
              @enderror
              @error('detail_description.*')
              <span class="text text-danger">{{ $message }}</span>
              @enderror
            </div>
            
            <div class="tab">
              <p>
                <label >Tiêu đề seo</label>
                <input name="title_seo" 
                  value="{{ old('title_seo') }}" type="text" 
                  placeholder="Tiêu đề seo">
                @error('title_seo')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label>Mô tả seo</label>
                <textarea id="description_seo"  
                  name="description_seo" placeholder="Mô tả seo" 
                  >{{ old('description_seo') }}</textarea>
                @error('description_seo')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
            </div>
            <div class="tab row">
              <div class="col-md-12 d-inline-block">
                <p>
                  <label for="image">Ảnh nổi bật <span class="text text-danger">*</span></label>
                  <input id="image" name="image" type="file" required accept="image/*">
                  @error('image')
                    <span class="text text-danger">{{ $message }}</span>
                  @enderror
                </p>
                <p>
                  <label for="images">Ảnh khác <span class="text text-danger">*</span></label>
                  <input type="file" name="images[]" required multiple accept="image/*">
                  @error('images')
                    <span class="text text-danger">{{ $message }}</span>
                  @enderror
                </p>
              </div>
              {{-- <div class="col-md-4 d-block mt-0">
                <img src="" id="preview" alt="" class="img-fluid" >
              </div> --}}
            </div>
            <div style="overflow:auto;">
              <div style="float:right;">
                {{-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Trở lại</button> --}}
                {{-- <button type="button" id="nextBtn" onclick="nextPrev(1)">Tiếp theo</button> --}}
                <button type="submit">Lưu</button>
              </div>
            </div>
          </form>
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
<script src="admins/plugins/select2/js/select2.full.min.js"></script>
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
<script>
  let btnAddChild = document.getElementById('addChild')
  btnAddChild.onclick = function() {
    let node = document.getElementsByClassName('productDetail')[0]
    let clone = node.cloneNode(true)
    document.getElementById("productDetail").appendChild(clone);
  }

  function removeNode(ele) {
    const grandEle = ele.parentElement.parentElement
    console.log(grandEle.parentElement.childElementCount)
    if(grandEle.parentElement.childElementCount === 2) return false
    else
      grandEle.remove()
    return
  }
</script>
<script src="admins/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function () {
  //Add text editor
  $('textarea').summernote()
})
</script>
@endsection
@section('id-active')#nav-products @endsection