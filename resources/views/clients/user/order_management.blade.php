@extends('clients.layout.master')
@section('title')
Đơn hàng
@endsection
@section('content')
@php
$user = Auth::user();
@endphp
<ul class="breadcrumb">
  <li><a href="/"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ route('client.users.order') }}">Đơn đặt hàng</a></li>
</ul>
@include('clients.user.profile_sidebar')
<div class="col-sm-9">
  <div>
    <h1>Đơn hàng đã đặt</h1>
    <p id="noti"></p>
    <hr>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active">
        <a style="font-weight: 600;" href="#all-tab" id="all-tab-button" data-toggle="pill" role="tab"
          aria-controls="all-tab" aria-selected="true">Tất cả</a>
      </li>
      <li role="presentation">
        <a style="font-weight: 600;" href="#delivering-tab" id="delivering-tab-button" data-toggle="pill" role="tab"
          aria-controls="delivering-tab" aria-selected="true">Đang giao</a>
      </li>
      <li role="presentation">
        <a style="font-weight: 600;" href="#delivered-tab" id="delivered-tab-button" data-toggle="pill" role="tab"
          aria-controls="delivered-tab" aria-selected="true">Đã giao</a>
      </li>
      <li role="presentation">
        <a style="font-weight: 600;" href="#cancelled-tab" id="cancelled-tab-button" data-toggle="pill" role="tab"
          aria-controls="cancelled-tab" aria-selected="true">Đã hủy</a>
      </li>
    </ul>
  </div>
  <div class="tab-content" style="min-height: 200px;">
    <div class="tab-pane fade active in" id="all-tab" role="tabpanel" aria-labelledby="all-tab-button">
      <div class="container row">
        @foreach ($orders as $order)
        <div class="row">
          <div class="col-md-2">
            <img style="margin-top: 5px;" src="thumbnails/{{$order->thumbnail}}" alt="Product Image">
          </div>
          <div class="col-md-8">
            <h3 style="margin-top: 5px;"><a
                href="{{route('client.products.show',$order->product_id)}}">{{$order->name}}</a></h3>
            <p><span>Số lượng: </span>{{$order->quantity}}</p>
            <p><span>Trạng thái: </span>{{$order->status}}</p>
          </div>
          <div class="col-md-2">
            <div style="margin-top: 20px;">
              <p>Giá tiền:</p>
              <p style="color: orangered">{{$order->price}} VND</p>
            </div>
          </div>
        </div>
        <hr>
        @php
        $cost = $cost + (int)$order->price;
        @endphp
        @endforeach
        <div class="container pull-right">
          <div>
            <h4>Tổng số tiền: <span>{{$cost}}</span> VND</h4>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="delivering-tab" role="tabpanel" aria-labelledby="delivering-tab-button">
      <div class="container row">
        @php
        $cost = 0;
        @endphp
        @foreach ($orders_delivering as $order_delivering)
        <div class="row">
          <div class="col-md-2">
            <img style="margin-top: 5px;" src="thumbnails/{{$order_delivering->thumbnail}}" alt="Product Image">
          </div>
          <div class="col-md-8">
            <h3 style="margin-top: 5px;">{{$order_delivering->name}}</h3>
            <p><span>Số lượng: </span>{{$order_delivering->quantity}}</p>
            <p><span>Trạng thái: </span>{{$order_delivering->status}}</p>
          </div>
          <div class="col-md-2">
            <div style="margin-top: 20px;">
              <p>Giá tiền:</p>
              <p style="color: orangered">{{$order_delivering->price}} VND</p>
            </div>
          </div>
        </div>
        <hr>
        @php
        $cost = $cost + (int)$order_delivering->price;
        @endphp
        @endforeach
        <div class="container pull-right">
          <div>
            <h4>Tổng số tiền: <span>{{$cost}}</span> VND</h4>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="delivered-tab" role="tabpanel" aria-labelledby="delivered-tab-button">
      <div class="container row">
        @php
        $cost = 0;
        @endphp
        @foreach ($orders_delivered as $order_delivered)
        <div class="row">
          <div class="col-md-2">
            <img style="margin-top: 5px;" src="thumbnails/{{$order_delivered->thumbnail}}" alt="Product Image">
          </div>
          <div class="col-md-8">
            <h3 style="margin-top: 5px;">{{$order_delivered->name}}</h3>
            <p><span>Số lượng: </span>{{$order_delivered->quantity}}</p>
            <p><span>Trạng thái: </span>{{$order_delivered->status}}</p>
          </div>
          <div class="col-md-2">
            <div style="margin-top: 20px;">
              <p>Giá tiền:</p>
              <p style="color: orangered">{{$order_delivered->price}} VND</p>
            </div>
          </div>
        </div>
        <hr>
        @php
        $cost = $cost + (int)$order_delivered->price;
        @endphp
        @endforeach
        <div class="container pull-right">
          <div>
            <h4>Tổng số tiền: <span>{{$cost}}</span> VND</h4>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="cancelled-tab" role="tabpanel" aria-labelledby="cancelled-tab-button">
      <div class="container row">
        @php
        $cost = 0;
        @endphp
        @foreach ($orders_canceled as $order_canceled)
        <div class="row">
          <div class="col-md-2">
            <img style="margin-top: 5px;" src="thumbnails/{{$order_canceled->thumbnail}}" alt="Product Image">
          </div>
          <div class="col-md-8">
            <h3 style="margin-top: 5px;">{{$order_canceled->name}}</h3>
            <p><span>Số lượng: </span>{{$order_canceled->quantity}}</p>
            <p><span>Trạng thái: </span>{{$order_canceled->status}}</p>
          </div>
          <div class="col-md-2">
            <div style="margin-top: 20px;">
              <p>Giá tiền:</p>
              <p style="color: orangered">{{$order_canceled->price}} VND</p>
            </div>
          </div>
        </div>
        <hr>
        @php
        $cost = $cost + (int)$order_canceled->price;
        @endphp
        @endforeach
        <div class="container pull-right">
          <div>
            <h4>Tổng số tiền: <span>{{$cost}}</span> VND</h4>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('id-active')home @endsection
@section('js')
<script>
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#preview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#image").change(function () {
      readURL(this);
  });
  $('.side-option').removeClass('active');
  $('#order').addClass('active');
</script>
@endsection