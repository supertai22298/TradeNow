@extends('admins.layout.master')
@section('title')
Thêm mới sản phẩm
@endsection
@section('css')
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
    display: none;
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
            <li class="breadcrumb-item active"><a href="{{ route('admin.categories.index') }}"> Danh mục </a></li>
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
                <label for="name">Tên sản phẩm</label>
                <input id="name" 
                  type="text" 
                  name="name" 
                  value="{{ old('name') }}" 
                  required placeholder="Tên sản phẩm" 
                  oninput="this.className = ''"
                  class="@error('name') invalid @enderror">
                @error('name')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="category_id">Danh mục</label>
                <select id="category_id" name="category_id" required oninput="this.className = ''">
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
              </p>
              <p>
                  <label for="brand_id">Thương hiệu</label>
                  <select id="brand_id" name="brand_id" required oninput="this.className = ''">
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
              </p>
            </div>
            
            <div class="tab">
              <p>
                <label for="amount">Số lượng trong kho</label>
                <input id="amount" 
                  value="{{ old('amount') }}"
                  name="amount" required type="number" 
                  placeholder="Số lượng trong kho" 
                  oninput="this.className = ''"
                  class="@error('amount') invalid @enderror"
                >
                @error('amount')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="description">Mô tả sản phẩm</label>
                <textarea id="description" class="@error('description') invalid @enderror"  name="description" required placeholder="Mô tả sản phẩm" oninput="this.className = ''">{{ old('description') }}</textarea>
                @error('description')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label for="price">Giá bán lẻ</label>
                <input id="price" class="@error('price') invalid @enderror" name="price" value="{{ old('price') }}" required type="number" placeholder="Giá bán lẻ" oninput="this.className = ''">
                @error('price')
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
                  <label>Tên thuộc tính</label>
                  <input type="text" class="@error('detail_type.*') invalid @enderror" required name="detail_type[]" value="{{ old('detail_type.0') }}" multiple placeholder="Kích thước, Màu sắc ..." oninput="this.className = ''">
                </p>
                <p class="d-inline-block col-md-5">
                  <label>Mô tả thuộc tính</label>
                  <input type="text" required class="@error('detail_description.*') invalid @enderror" name="detail_description[]" value="{{ old('detail_description.0') }}" multiple placeholder="30 * 30 * 30, đỏ" oninput="this.className = ''">
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
                  <label>Tên thuộc tính</label>
                  <input type="text" class="@error('detail_type.*') invalid @enderror" required name="detail_type[]" value="{{ old('detail_type.0') }}" multiple placeholder="Kích thước, Màu sắc ..." oninput="this.className = ''">
                </p>
                <p class="d-inline-block col-md-5">
                  <label>Mô tả thuộc tính</label>
                  <input type="text" required name="detail_description[]" class="@error('detail_description.*') invalid @enderror" value="{{ old('detail_description.0') }}" multiple placeholder="30 * 30 * 30, đỏ" oninput="this.className = ''">
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
                <input name="title_seo" value="{{ old('title_seo') }}" type="text" placeholder="Tiêu đề seo" required oninput="this.className = ''">
                @error('title_seo')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
              <p>
                <label>Mô tả seo</label>
                <textarea id="description_seo"  name="description_seo" required placeholder="Mô tả seo" oninput="this.className = ''">{{ old('description_seo') }}</textarea>
                @error('description_seo')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </p>
            </div>
            <div class="tab row">
              <div class="col-md-12 d-inline-block">
                <p>
                  <label for="image">Ảnh nổi bật</label>
                  <input id="image" name="image" type="file" required oninput="this.className = ''">
                  @error('image')
                    <span class="text text-danger">{{ $message }}</span>
                  @enderror
                </p>
                <p>
                  <label for="images">Ảnh khác</label>
                  <input type="file" name="images[]" required multiple>
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
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Trở lại</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Tiếp theo</button>
              </div>
            </div>
            
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
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
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Lưu";
    } else {
        document.getElementById("nextBtn").innerHTML = "Tiếp theo";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("newProductForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

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
@endsection
@section('id-active')#nav-categories @endsection