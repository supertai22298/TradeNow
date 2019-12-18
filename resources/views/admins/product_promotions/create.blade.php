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
        <h1>Thêm mới sản phẩm khuyến mãi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('admin.product_promotions.index') }}"> Sản phẩm khuyến
              mãi</a></li>
          <li class="breadcrumb-item active">Thêm sản phẩm khuyến mãi</li>
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
    @if (session('primary'))
    <div class="alert alert-danger">
      {{ session('primary') }}
    </div>
    @endif
    <div class="card-body">
      <div class="container">
        <h3>Thêm mới sản phẩm</h3>
        <p>Vui lòng nhập thông tin phù hợp</p>
      </div>
      <form id="newProductForm" method="POST" action="{{ route('admin.product_promotions.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="tab">
          <p>
            <label for="promotion_id">Chương trình khuyến mãi <span class="text text-danger">*</span></label>
            <select id="promotion_id" name="promotion_id" required>
              @foreach ($promotions as $promo)
              <option value="{{ $promo->id }}" @if ($promo->id == old('promotion_id'))
                selected
                @endif
                >
                {{ $promo->type }}
              </option>
              @endforeach
            </select>
            @error('promotion_id')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <p>
            <label for="product_id">Chọn sản phẩm <span class="text text-danger">*</span></label>
            <select id="product_id" name="product_id" required>
              @foreach ($products as $prod)
              <option value="{{ $prod->id }}" @if ($prod->id == old('product_id'))
                selected
                @endif
                >
                {{ $prod->name }}
              </option>
              @endforeach
            </select>
            @error('product_id')
            <span class="text text-danger">{{ $message }}</span>
            @enderror
          </p>
          <p>
            <label for="amount">Số lượng khuyến mãi<span class="text text-danger"> * </span></label>
            <input type="number" name="amount" id="amount" min="0" required min="0">
          </p>
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