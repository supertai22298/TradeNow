@extends('clients.layout.master')
@section('title')
  Thanh toán
@endsection
@section('css')
    
@endsection

@section('content')
<div class="main-container container">
  <ul class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('client.cart.checkout') }}">Thanh toán</a></li>
  </ul>
  <div class="row">
    <!--Middle Part Start-->
    <div id="content" class="col-sm-12">
      <h2 class="title">Thanh toán</h2>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      @if(session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
    </div>
      @endif
      <div class="row">
      <div class="col-sm-4">
      <form method="POST" action="{{ route('client.cart.handleCheckout') }}" id="formCheckout" class="panel panel-default">
          @csrf
          <input type="hidden" name="contents" id="cartContents" value="">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-user"></i>Thông tin người nhận</h4>
          </div>
          <div class="panel-body">
            <fieldset id="account">
              <div class="form-group required">
                <label class="control-label">Họ tên người nhận</label>
                <input type="text" class="form-control" required minlength="3" placeholder="Họ tên người nhận" value="" name="receive_name">
                @error('receive_name')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group required">
                <label class="control-label">Số điện thoại</label>
                <input type="text" class="form-control"  placeholder="Telephone" value="" name="receive_phone">
                @error('receive_phone')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group required">
                <label class="control-label">Thành phố</label>
                <input type="text" class="form-control"  placeholder="Thành phố" value="" name="receive_city">
                @error('receive_city')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group required">
                <label class="control-label">Địa chỉ</label>
                <input type="text" class="form-control"  placeholder="Thành phố" value="" name="receive_address">
                @error('receive_address')
                  <span class="text text-danger">{{ $message }}</span>
                @enderror
              </div>
            </fieldset>
            </div>
        </form>
      </div>
      <div class="col-sm-8">
        <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-truck"></i> Phương thức vận chuyển</h4>
          </div>
            <div class="panel-body">
            <p>Hiện tại chi phí vận chuyển được tính 30k toàn quốc</p>
            <div class="radio">
              <label>
              <input type="radio" checked="checked" name="Free Shipping">
              Chi phí ship - đ 30.000</label>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-credit-card"></i> Phương thức thanh toán</h4>
          </div>
            <div class="panel-body">
            <p>Phương thức thanh toán được ưa chuộng nhất</p>
            <div class="radio">
              <label>
              <input type="radio" checked="checked" name="payment_method">Trả tiền khi nhận hàng</label>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-ticket"></i>Sử dụng mã khuyến mãi</h4>
          </div>
            <div class="panel-body">
            <label for="input-coupon" class="col-sm-3 control-label">Nhập mã</label>
            <div class="input-group">
              <input type="text" form="formCheckout" class="form-control" id="input-coupon" disabled placeholder="Chức năng đang nâng cấp" value="" name="coupon">
              <span class="input-group-btn">
              <input type="button" class="btn btn-primary" disabled data-loading-text="Loading..." id="button-coupon" value="Xác nhận">
              </span></div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Giỏ hàng</h4>
          </div>
            <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center">Hình ảnh</td>
                    <td class="text-left">Tên sản phẩm</td>
                    <td class="text-left">Số lượng</td>
                    <td class="text-right">Giá</td>
                    <td class="text-right">Tổng cộng</td>
                  </tr>
                </thead>
                <tbody id="viewDetailCart">
                  <!--Phần view cart ở đây, vào file CART.js để sửa đổi-->
                </tbody>
              <tfoot>
                <tr>
                <td class="text-right" colspan="4"><strong>Tổng cộng:</strong></td>
                <td class="text-right" id="viewSubTotal">0 đ</td>
                </tr>
                <tr>
                  <td class="text-right" colspan="4"><strong>Phí vận chuyển:</strong></td>
                  <td class="text-right">30.000 đ</td>
                </tr>
                <tr>
                  <td class="text-right" colspan="4"><strong>Thuế (Đã bao gồm thuế):</strong></td>
                  <td class="text-right">0 đ</td>
                </tr>
                <tr>
                  <td class="text-right" colspan="4"><strong>Total:</strong></td>
                  <td class="text-right" id="viewTotal">0 đ</td>
                </tr>
              </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-pencil"></i>Thêm thông tin để nhận hàng</h4>
          </div>
            <div class="panel-body">
              <textarea rows="4" form="formCheckout" class="form-control" name="description"></textarea>
              <br>
            <label class="control-label" for="confirm_agree">
              <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
              <span>Tôi đồng ý với <a class="agree" href="#"><b>Điều khoản &amp; Chính sách</b></a></span> </label>
            <div class="buttons">
              <div class="pull-right">
                <input type="submit" form="formCheckout" class="btn btn-primary" id="button-confirm" value="Xác nhận thanh toán">
              </div>
            </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <!--Middle Part End -->
    
  </div>
</div>    
@endsection

@section('js')
<script>
  $(document).ready(function () {
    $('#formCheckout').submit(function(event) {
      document.getElementById('cartContents').value = JSON.stringify(CART.contents)
    })
  });
</script>

@endsection