@extends('admins.contacts.master')


@section('title')
  Gửi email
@endsection
@section('css')
<link rel="stylesheet" href="admins/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="admins/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="admins/plugins/toastr/toastr.min.css">

<link rel="stylesheet" href="admins/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<link rel="stylesheet" href="admins/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="admins/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
@endsection

@section('content-mail')
  <!-- /.col -->
  <div class="col-md-9">
    <form action="{{ route('admin.contacts.sendMail') }}" method="POST" enctype="multipart/form-data" class="card card-primary card-outline">
      @csrf
      <div class="card-header">
        <h3 class="card-title">Trả lời thư</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <input 
            required 
            multiple 
            type="email" 
            class="form-control  @error('email') is-invalid @enderror" 
            name="email" 
            placeholder="To: email người nhận"
            value="{{ $contact->email }}">
            @error('email')
              <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
          <select 
            name="emails[]" 
            class="select2  @error('emails') is-invalid @enderror" 
            multiple 
            data-placeholder="Thêm người nhận" 
            style="width: 100%;"
          >
            @foreach ($emails as $email)
              <option value="{{ $email->email }}" title="{{ $email->name }}">{{ $email->email }}</option>
            @endforeach
          </select>
          @error('emails')
            <span class="text text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="is_muliple" class="text text-default">
            <input type="checkbox" name="is_multiple" id="is_multiple">  Gửi cho tất cả liên hệ
          </label>
        </div>
        <div class="form-group">
          <input 
            required 
            name="subject" 
            type="text" 
            class="form-control  @error('subject') is-invalid @enderror"
            placeholder="Tiêu để..."
            value="Trả lời ý kiến: {{ $contact->subject }}">
            @error('subject')
              <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group bg-light">
          <p class="disabled">
            Nội dung liên hệ: "{{ $contact->description }}"
          </p>
        </div>
        <div class="form-group">
            <textarea 
              required 
              name="description" 
              id="compose-textarea" 
              class="form-control  @error('description') is-invalid @enderror" 
              style="height: 300px"
              placeholder="Nhập nội dung vào đây">{{ old('description') }}</textarea>
            @error('description')
              <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right">
          <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Gửi</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </form>
    <!-- /.card -->
  </div>
@endsection

@section('js')
    
<!-- Summernote -->
<script src="admins/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
  <script src="admins/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="admins/plugins/toastr/toastr.min.js"></script>
  <script src="admins/plugins/select2/js/select2.full.min.js"></script>
  <script src="admins/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
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
      let ele = $('.nav-link')
      for(let i = 0; i < ele.length; i++) {
          ele[i].classList.remove('active');
      }
      $('#nav-contacts').addClass('active')
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('.select2').select2()
    })
  </script>
@endsection

