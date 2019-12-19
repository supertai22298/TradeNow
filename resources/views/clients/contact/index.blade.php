@extends('clients.layout.master')
@section('title')
Danh sách yêu thích
@endsection
@section('content')
@csrf

<ul class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ route('client.contact.show') }}">Liên hệ</a></li>
</ul>

<div class="row">
  <div id="content" class="col-sm-12">
    <div class="page-title">
      <h2>Liên hệ với chúng tôi</h2>
    </div>
    <div class="info-contact clearfix">
      <div class="col-lg-4 col-sm-4 col-xs-12 info-store">
        <div class="row">
          <div class="name-store">
            <h3>Hệ thống</h3>
          </div>
          <address>
            <div class="address clearfix form-group">
              <div class="icon">
                <i class="fa fa-home"></i>
              </div>
              <div class="text">DTU, 254 Nguyễn Văn Linh, Đà Nẵng</div>
            </div>
            <div class="phone form-group">
              <div class="icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="text">Phone : 0123456789</div>
            </div>
            <div class="comment">
              Liên hệ với chúng tôi nếu có bất cứ thắc mắc hoặc góp ý gì.<br/>
              Đóng góp của bạn sẽ là 1 phần để chúng tôi hoàn thiệt hệ thống.
            </div>
          </address>
        </div>
      </div>
      <div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>
            <legend>Thông tin liên hệ:</legend>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-name">Họ và tên</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="" id="input-name" class="form-control">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-email">Địa chỉ E-Mail</label>
              <div class="col-sm-10">
                <input type="text" name="email" value="" id="input-email" class="form-control">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-enquiry">Nội dung</label>
              <div class="col-sm-10">
                <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
              </div>
            </div>
          </fieldset>
          <div class="buttons">
            <div class="pull-right">
              <button class="btn btn-default buttonGray" type="submit">
                <span>Gửi</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('id-active-page')contact @endsection
@section('js')
<script>
  $(document).ready(function(){
    $('.side-option').removeClass('active');
    $('#wish-list').addClass('active');
  });
</script>
@endsection