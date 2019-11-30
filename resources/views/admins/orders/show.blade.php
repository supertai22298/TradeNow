@extends('admins.layout.master')
@section('title')
Đơn hàng
@endsection
@section('css')
  <!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css "> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="admins/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý đơn hàng</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{ route('admin.orders.index') }}">Thương hiệu</a></li>
                <li class="breadcrumb-item active">{{ $order->name }}</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info d-print-none">
              <h5><i class="fas fa-info text text-danger"></i> Ghi chú:</h5>
              Khi thực hiện thay đổi trạng thái đơn hàng, bạn phải chắc chắn thông tin mình muốn thay đổi. Mọi thông tin sau khi thay đổi sẽ không trở lại trạng thái cũ được
              <div>
                TRẠNG THÁI ĐƠN HÀNG
              </div>
              <div class="progress rounded-pill">
                <div class="progress-bar-striped {{ $order->order_status->priority > 100 ? 'bg-danger' : 'bg-success' }} text-center" 
                  style="width: {{ $order->order_status->priority > 100 ? 100 : $order->order_status->priority }}%"
                >
                  {{ $order->order_status->name }}
                </div>
              </div>
              <form action="{{ route('admin.orders.changeStatus', $order->id) }}" method="post" class="mt-3">
                @csrf
                @method('PUT')
                <div class="form-group">
                  @if ($statuses)
                    <select name="status" id="" class="form-control">
                      @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" @if($status->id === $order->order_status_id) selected @endif>
                          {{ $status->name }}
                        </option>
                      @endforeach
                    </select>
                  @endif
                </div>
                <button 
                  type="submit" class="btn btn-flat btn-primary"
                  onclick="return confirm('Bạn chắc chắn muốn thay đổi?')"
                >
                  Xác nhận thay đổi
                </button>
              </form>
            </div>
            <div class="callout callout-info text-center">
              <h3>HOÁ ĐƠN CHI TIẾT</h3>
            </div>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> TradeNow
                    <small class="float-right">Ngày: {{ Carbon\Carbon::now()->toDateString() }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <strong>Người bán</strong>
                  <address>
                    <strong><em>{{ Auth::user()->name }}</em></strong><br>
                    <strong>Địa chỉ:</strong> {{ Auth::user()->address }}<br>
                    <strong>Thành phố:</strong> {{ Auth::user()->city }}<br>
                    <strong>Số điện thoại:</strong> {{ Auth::user()->phone }}<br>
                    <strong>Email:</strong> {{ Auth::user()->email }}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Người nhận</strong>
                  <address>
                    <strong>{{ $order->receive_name }}</strong><br>
                    <strong>Địa chỉ:</strong> {{ $order->receive_address }}<br>
                    <strong>Thành phố:</strong> {{ $order->receive_city }}<br>
                    <strong>Số điện thoại:</strong> {{ $order->receive_phone }}<br>
                    <strong>Email:</strong> {{ $order->receive_email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Hoá đơn </b><br>
                  <b>ID đơn hàng:</b> {{ $order->id }}<br>
                  <b>Ngày tạo:</b> {{ $order->created_at->toDateString() }}<br>
                  <b>Tài khoản:</b> {{ $order->user->name }}<br>
                  <b>Số điện thoại:</b> {{ $order->user->phone }}<br>
                  <b>Email:</b> {{ $order->user->email }}<br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>STT</th>
                      <th>Sản phẩm</th>
                      <th>Số lượng</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->order_product as $item)
                        <tr>
                          <td>1</td>
                          <td>{{ $item->product->name }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td>{{ $item->description }}</td>
                          <td>{{ $item->getSubTotal() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Phương thức thanh toán:</p>
                    Thanh toán khi nhận hàng

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Khách hàng được phép coi sản phẩm trước khi thanh toán, đối với những sản phẩm khuyến mãi sẽ không hỗ trợ đổi trả
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Ngày đặt hàng: {{ $order->created_at->toDateString() }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Tổng thanh toán:</th>
                        <td>{{ $order->getTotalPayment() }}</td>
                      </tr>
                      <tr>
                        <th>Thuế (0%)</th>
                        <td>00</td>
                      </tr>
                      <tr>
                        <th>Khuyến mãi (0%)</th>
                        <td>00</td>
                      </tr>
                      <tr>
                        <th>Chi phí ship:</th>
                        <td>30.000</td>
                      </tr>
                      <tr>
                        <th>Tổng cộng:</th>
                        <td>{{ $order->getTotalWithShipping(30000, 0) }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" onclick="return window.print()" class="btn btn-default"><i class="fas fa-print"></i> In hoá đơn</button>
                  {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> --}}
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('js')
@endsection
@section('id-active')#nav-orders @endsection