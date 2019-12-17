@extends('admins.layout.master')
@section('title')
Chỉnh sửa sản phẩm
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
  input,
  select,
  textarea {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid,
  textarea.invalid {
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
        <h1>Chỉnh sửa thông tin sản phẩm</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}"> Sản phẩm </a></li>
          <li class="breadcrumb-item active">Chỉnh sửa</li>
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
      <h3 class="card-title p-3">Vui lòng nhập thông tin sản phẩm</h3>
    </div>
    @if ($errors->all())
    <div class="alert alert-danger">Có lỗi xảy ra</div>
    @endif
    <div class="card-body">
      <div class="container">
        <h3>Chỉnh sửa thông tin sản phẩm</h3>
        <p>Vui lòng nhập thông tin phù hợp</p>
      </div>
      <form id="newProductForm"
        onsubmit="return confirm('Lưu ý nếu xác nhận chỉnh sửa thì sản phẩm của bạn sẽ được kiếm duyệt lại.')"
        method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="tab">
          <p>
            <label for="name">Tên sản phẩm <span class="text text-danger">*</span></label>
            <input id="name" type="text" name="name" value="{{$product->name}}" required placeholder="Tên sản phẩm"
              minlength="3" class="@error('name') invalid @enderror">
            @error('name')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <p>
            <label for="category_id">Danh mục <span class="text text-danger">*</span></label>
            <select id="category_id" name="category_id" required>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" @if ($category->id == $product->category_id)
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
            <label for="brand_id">Thương hiệu <span class="text text-danger">*</span></label>
            <select id="brand_id" name="brand_id" required>
              @foreach ($brands as $brand)
              <option value="{{ $brand->id }}" @if ($brand->id == $product->brand_id)
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
            <input id="amount" value="{{$product->amount}}" name="amount" required type="number"
              placeholder="Số lượng trong kho" class="@error('amount') invalid @enderror">
            @error('amount')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <p>
            <label for="price">Giá bán lẻ <span class="text text-danger">*</span></label>
            <input id="price" class="@error('price') invalid @enderror" name="price" value="{{ $product->price }}"
              required min="1000" step="1000" type="number" placeholder="Giá bán lẻ">
            @error('price')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <hr>
          <p>
            <label for="description">Mô tả sản phẩm <span class="text text-danger">*</span></label>
            <textarea id="description" class="@error('description') invalid @enderror" name="description" minlength="10"
              required placeholder="Mô tả sản phẩm">{{ $product->description }}</textarea>
            @error('description')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>

        </div>
        <hr>
        <div class="tab row" id="productDetail">
          <div class="mb-3 col-md-12">
            <button id="addChild" type="button" class="btn-primary d-block">Thêm thuộc tính</button>
          </div>
          @foreach ($product->product_details as $product_detail)
          <div class="productDetail">
            <p class="d-inline-block col-md-5">
              <label>Tên thuộc tính <span class="text text-danger">*</span></label>
              <input type="text" minlength="2" class="@error('detail_type.*') invalid @enderror" required
                name="detail_type[]" value="{{ $product_detail->type }}" multiple placeholder="Kích thước, Màu sắc ...">
            </p>
            <p class="d-inline-block col-md-5">
              <label>Mô tả thuộc tính <span class="text text-danger">*</span></label>
              <input type="text" minlength="2" required class="@error('detail_description.*') invalid @enderror"
                name="detail_description[]" value="{{ $product_detail->description }}" multiple
                placeholder="30 * 30 * 30, đỏ">
            </p>
            <p class="d-inline-block col-md-1"><button onclick="removeNode(this)" class="btn-sm btn-danger remove-child"
                type="button"><i class="far fa-window-close"></i></button></p>
          </div>
          @error('detail_type.*')
          <span class="text text-danger">{{ $message }}</span>
          @enderror
          @error('detail_description.*')
          <span class="text text-danger">{{ $message }}</span>
          @enderror
          @endforeach
        </div>
        <hr>
        <div class="tab">
          <p>
            <label>Tiêu đề seo</label>
            <input name="title_seo" value="{{ $product->title_seo }}" type="text" placeholder="Tiêu đề seo">
            @error('title_seo')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <p>
            <label>Mô tả seo</label>
            <textarea id="description_seo" name="description_seo"
              placeholder="Mô tả seo">{{ $product->description_seo }}</textarea>
            @error('description_seo')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
        </div>
        <hr>
        <div class="tab row">
          <div class="col-md-12 d-inline-block">
            <p>
              <label for="image">Ảnh nổi bật <span class="text text-danger">*</span></label>
              <div class="bg-light">
                <img width="150px" class="my-3" src="{{ 'thumbnails/'. $product->thumbnail }}" alt="Ảnh nổi bật">
              </div>
              <input id="image" name="image" type="file" accept="image/*">
              <input name="thumbnail" type="hidden">
              @error('image')
              <span class="text text-danger">{{ $message }}</span>
              @enderror
            </p>
            <p>
              <label for="images">Ảnh khác <span class="text text-danger">*</span></label>
              <div class="row mb-3 bg-light">
                @foreach ($product->product_images as $image)
                <img width="150px" class="mr-4 my-3" src="{{ 'thumbnails/'. $image->thumbnail }}" alt="Ảnh mô tả">
                @endforeach
              </div>
              <input type="file" name="images[]" multiple accept="image/*">
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
            <a class="btn btn-flat btn-secondary mr-4" href="{{ route('admin.products.index') }}"><i
                class="fas fa-arrow-left" aria-hidden="true"></i> Danh sách</a>
            <button class="btn btn-flat btn-success" type="submit">Lưu</button>
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