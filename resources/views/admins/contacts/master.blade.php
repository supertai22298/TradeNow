@extends('admins.layout.master')


@section('title')
   @parent
@endsection

@section('css')  
<link rel="stylesheet" href="admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<style>
  .page-link {
    line-height: 16px;
  }
  a.text-muted:hover {
    color: orange!important;
  }

</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inbox</h1>
            @include('components.success')
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
              <li class="breadcrumb-item active">Liên hệ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="compose.html" class="btn btn-primary btn-block mb-3">Gửi email</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Chức năng</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="fas fa-inbox"></i> Thư đến
                    <span class="badge bg-primary float-right">{{ $countContact }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.contacts.star') }}" class="nav-link">
                    <i class="fas fa-star"></i> Thư đánh dấu sao
                    <span class="badge bg-warning float-right" id="countStar">{{ $countStar }}</span>
                  </a>
                </li>
                {{-- <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-envelope"></i> Đã gửi
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-file-alt"></i> Thư nháp
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Thùng rác
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
        
        </div>
      @yield('content-mail')
      </div>
  
    </section>
    <!-- /.content -->
@endsection
@section('js')
    
<!-- Page Script -->
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for glyphicon and font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var glyph = $this.hasClass('glyphicon')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (glyph) {
        $this.toggleClass('glyphicon-star')
        $this.toggleClass('glyphicon-star-empty')
      }

      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
    $('button.reload').click(()=>{
      location.reload();
    })
    const starElement = $('a.text.text-muted');
    starElement.click(function(e) {
      e.preventDefault()
      const value = this.dataset.number;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "PUT",
        url: "{{ route('admin.contacts.changeStar') }}",
        data: {
          value: value  
        },
        success: function (response) {
          let classList = $(`i[data-number="${value}"]`).attr('class').split(' ')
          if(classList.includes('text-warning')){
            $(`i[data-number="${value}"]`).removeClass('text-warning')
          }else{
            $(`i[data-number="${value}"]`).addClass('text-warning')
          }
          $('span#countStar').html(response.star)
        }
      });
       
    })
    
   
  })
</script>
<!-- AdminLTE for demo purposes -->
<script src="admins/dist/js/demo.js"></script>
@endsection

