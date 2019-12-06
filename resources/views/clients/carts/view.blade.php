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
        <h3 class="subtitle no-margin">What would you like to do next?</h3>
        <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        <div class="row">
          <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">Use Coupon Code</h4>
              </div>
              <div id="collapse-coupon" class="panel-collapse collapse in">
                <div class="panel-body">
                  <label class="col-sm-4 control-label" for="input-coupon">Enter your coupon here</label>
                  <div class="input-group">
                    <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control" />
                    <span class="input-group-btn">
                    <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..."  class="btn btn-primary" />
                    </span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">Use Gift Voucher</h4>
              </div>
              <div id="collapse-voucher" class="panel-collapse collapse in">
                <div class="panel-body">
                  <label class="col-sm-4 control-label" for="input-voucher">Enter gift voucher code here</label>
                  <div class="input-group">
                    <input type="text" name="voucher" value="" placeholder="Enter gift voucher code here" id="input-voucher" class="form-control" />
                    <span class="input-group-btn">
                    <input type="submit" value="Apply Voucher" id="button-voucher" data-loading-text="Loading..."  class="btn btn-primary" />
                    </span> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Estimate Shipping &amp; Taxes</h4>
          </div>
          <div id="collapse-shipping" class="panel-collapse collapse in">
            <div class="panel-body">
              <p>Enter your destination to get a shipping estimate.</p>
              <form class="form-horizontal">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-country">Country</label>
                  <div class="col-sm-10">
                    <select name="country_id" id="input-country" class="form-control">
                      <option value=""> --- Please Select --- </option>
                      <option value="244">Aaland Islands</option>
                      <option value="1">Afghanistan</option>
                      <option value="2">Albania</option>
                      <option value="3">Algeria</option>
                      <option value="4">American Samoa</option>
                      <option value="5">Andorra</option>
                      <option value="6">Angola</option>
                      <option value="7">Anguilla</option>
                      <option value="8">Antarctica</option>
                      <option value="9">Antigua and Barbuda</option>
                      <option value="10">Argentina</option>
                      <option value="11">Armenia</option>
                      <option value="12">Aruba</option>
                    </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-zone">Region / State</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="input-zone" name="zone_id">
                      <option value=""> --- Please Select --- </option>
                      <option value="13">Aberdeen</option>
                      <option value="14">Aberdeenshire</option>
                      <option value="15">Anglesey</option>
                      <option value="16">Angus</option>
                      <option value="17">Argyll and Bute</option>
                      <option value="18">Bedfordshire</option>
                      <option value="19">Berkshire</option>
                      <option value="20">Blaenau Gwent</option>
                      <option value="21">Bridgend</option>
                      <option value="22">Bristol</option>
                      <option value="23">Buckinghamshire</option>
                      <option value="24">Caerphilly</option>
                      <option value="25">Cambridgeshire</option>
                    </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
                  <div class="col-sm-10">
                    <input type="text" name="postcode" value="" placeholder="Post Code" id="input-postcode" class="form-control" />
                  </div>
                </div>
                <input type="button" value="Get Quotes" id="button-quote" data-loading-text="Loading..." class="btn btn-primary" />
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">
              <tr>
                <td class="text-right"><strong>Sub-Total:</strong></td>
                <td class="text-right">$940.00</td>
              </tr>
              <tr>
                <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
                <td class="text-right">$4.00</td>
              </tr>
              <tr>
                <td class="text-right"><strong>VAT (20%):</strong></td>
                <td class="text-right">$188.00</td>
              </tr>
              <tr>
                <td class="text-right"><strong>Total:</strong></td>
                <td class="text-right">$1,132.00</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="buttons">
          <div class="pull-left"><a href="index.html" class="btn btn-default">Continue Shopping</a></div>
          <div class="pull-right"><a href="checkout.html" class="btn btn-primary">Checkout</a></div>
        </div>
      </div>
      <!--Middle Part End -->
    
  </div>
</div>    





@endsection

@section('js')
@endsection