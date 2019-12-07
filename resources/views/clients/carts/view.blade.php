@extends('clients.layout.master')
@section('title')
  Xem giỏ hàng
@endsection
@section('css')
    
@endsection

@section('content')
<div class="main-container container">
  <ul class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('client.cart.view') }}">Giỏ hàng</a></li>
  </ul>
  
  <div class="row">
    <!--Middle Part Start-->
      <div id="content" class="col-sm-12">
        <h2 class="title">Giỏ hàng</h2>
          <div class="table-responsive form-group">
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
            </table>
          </div>
        <h3 class="subtitle no-margin">Bạn có muốn tiếp tục mua sắm?</h3>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">
              <tr>
                <td class="text-right"><strong>Tổng cộng:</strong></td>
                <td class="text-right" id="viewSubTotal">0 đ</td>
              </tr>
              <tr>
                <td class="text-right"><strong>Phí vận chuyển:</strong></td>
                <td class="text-right">30.000 đ</td>
              </tr>
              <tr>
                <td class="text-right"><strong>Thuế (đã bao gồm thuế):</strong></td>
                <td class="text-right">0 đ</td>
              </tr>
              <tr>
                <td class="text-right"><strong>Tổng thanh toán:</strong></td>
                <td class="text-right" id="viewTotal">0 đ</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="buttons">
          <div class="pull-left"><a href="/" class="btn btn-default">Tiếp tục mua sắm</a></div>
        <div class="pull-right"><a href="{{ route('client.cart.checkout') }}" class="btn btn-primary">Thanh toán</a></div>
        </div>
      </div>
      <!--Middle Part End -->
    
  </div>
</div>    





@endsection

@section('js')
@endsection