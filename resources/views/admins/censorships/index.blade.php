@extends('admins.layout.master')
@section('title')
Kiểm duyệt sản phẩm
@endsection
@section('css')
  <!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css "> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="admins/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Kiểm duyệt sản phẩm</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Kiểm duyệt</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    @error('violation')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('ids')
        <div class="alert alert-warning">{{ $message }}</div>
    @enderror
    @php
      $stt = 1;
    @endphp
    <!-- Main content -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <h4>Thao tác hàng loạt</h4>
          </div>
          <div class="card-body">
            <form id="massExecute" action="{{route('admin.censorships.massExecute')}}" method="post" class="d-inline-block" onsubmit="return confirm('Bạn chắc chắn muốn thực hiện')">
              @csrf
              @method('PUT')
              <button type="submit" name="btnCensorship" value="censorship" class="btn btn-flat btn-primary"><i class="fas fa-dumpster-fire"></i> Xác nhận tất cả đã chọn</button>
              <button type="submit" name="btnBan" value="ban" class="btn btn-flat btn-warning"><i class="fas fa-dumpster-fire"></i> Không xác nhận tất cả đã chọn</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active-default is-active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Tất cả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link is-active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Chờ duyệt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link is-active" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Đã xác nhận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link is-active" id="custom-tabs-four-notCensored-tab" data-toggle="pill" href="#custom-tabs-four-notCensored" role="tab" aria-controls="custom-tabs-four-notCensored" aria-selected="false">Không xác nhận</a>
                    </li>
                    </ul>
                </div>
                <div class="card-body p-0 pt-1">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                <h3 class="card-title">Tất cả yêu cầu kiểm duyệt sản phẩm</h3>
                    
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm checkbox-toggle" id="page-1"><i class="far fa-square"> Chọn hàng loạt</i>
                                        </button>
                                    </div>
                                    <!-- /.btn-group -->
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <div class="btn-group" style="margin-bottom: -10px;">
                                                {{$productsAll->links()}}
                                            </div>
                                        </div>
                                    <!-- /.btn-group -->
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <div class="table-responsive mailbox-messages" id="page-cont-1">
                                    <table class="table table-hover">
                                        <thead>
                                            <th></th>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Kiểm duyệt</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Số lượng</th>
                                            <th>Chức năng</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($productsAll as $productAll)
                                            <tr {!!$productAll->is_checked == 0 ? 'style="background: rgba(0,0,0,.05);"' : ""!!}>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="{{$productAll->id}}" name="ids[]" form="massExecute" id="chekc-{{$productAll->id}}">
                                                        <label for="chekc-{{$productAll->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star">
                                                    {{$stt++}}
                                                </td>
                                                <td class="mailbox-name"><a href="{{route('admin.censorships.show', $productAll->id)}}"><h5 class="lead">{{$productAll->name}}</h5></a></td>
                                                <td class="mailbox-name">{{$productAll->category != null ? $productAll->category->name : 'Danh mục không tồn tại'}}</td>
                                                <td class="mailbox-name">
                                                    @if ($productAll->is_checked == 0)
                                                      <span class='text-secondary'><i class="fa fa-file-import"></i></span>
                                                    @elseif($productAll->is_checked == 1)
                                                        <span class='text-success'><i class="fa fa-check"></i></span>
                                                    @else
                                                        <span class='text-danger'><i class="fa fa-ban"></i></span>
                                                    @endif
                                                </td>
                                                <td class="mailbox-subject">{{$productAll->user != null ? $productAll->user->name : 'Tài khoản không tồn tại'}}</td>
                                                <td class="mailbox-subject">{{$productAll->amount}}</td>
                                                <td class="mailbox-date">
                                                    <a title="Xem thông tin yêu cầu" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.censorships.show', $productAll->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.censorships.censored', $productAll->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xác nhận');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" title="Xác nhận yêu cầu {{ $productAll->name }}" {{$productAll->is_checked == 1 ? "disabled" : ""}} class="btn btn-xs btn-flat btn-success" > <i class="fas fa-check"></i></button>
                                                    </form>
                                                    <button type="button" data-toggle="modal" {{$productAll->is_checked == 2 ? "disabled" : ""}} data-target="#modal-default-{{$productAll->id}}" title="Không xác nhận yêu cầu {{ $productAll->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-ban"></i></button>
                                                </td>
                                            {{-- modal --}}
                                            <div class="modal fade" id="modal-default-{{$productAll->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.censorships.notCensored') }}" method="POST" onsubmit="return confirm('Bạn chắc muốn không xác nhận');" style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id" value="{{$productAll->id}}">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Xác nhận lý do không xác nhận sp {{$productAll->id}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-form-label" for="inputWarning">Nhập lý do không xác nhận<span class="text text-danger">*</span></label>
                                                                    <input type="text" name="violation" class="form-control is-warning" id="inputWarning" placeholder="Nhập lý do không xác nhận">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                <button type="submit" title="Không xác nhận yêu cầu {{ $productAll->name }}" class="btn btn-warning" >Đồng ý</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header bg-info">
                              <h3 class="card-title">Tất cả yêu cầu chưa được kiểm duyệt</h3>
                              <div class="card-tools">
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" placeholder="Tìm kiếm">
                                  <div class="input-group-append">
                                      <div class="btn btn-primary">
                                      <i class="fas fa-search"></i>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                              <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0">
                              <div class="mailbox-controls">
                                  <!-- Check all button -->
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default btn-sm checkbox-toggle" id="page-2"><i class="far fa-square"> Chọn hàng loạt</i>
                                      </button>
                                  </div>
                                  <!-- /.btn-group -->
                                  <div class="float-right">
                                      <div class="btn-group">
                                          <div class="btn-group" style="margin-bottom: -10px;">
                                              {{$productsWaitCensored->links()}}
                                          </div>
                                      </div>
                                  <!-- /.btn-group -->
                                  </div>
                                  <!-- /.float-right -->
                              </div>
                              <div class="table-responsive mailbox-messages" id="page-cont-2">
                                  <table class="table table-hover">
                                      <thead>
                                          <th></th>
                                          <th>STT</th>
                                          <th>Tên sản phẩm</th>
                                          <th>Danh mục</th>
                                          <th>Kiểm duyệt</th>
                                          <th>Nhà cung cấp</th>
                                          <th>Số lượng</th>
                                          <th>Chức năng</th>
                                      </thead>
                                      <tbody>
                                          @php
                                              $stt = 1;
                                          @endphp
                                          @foreach ($productsWaitCensored as $productWaitCensored)
                                          <tr {!!$productWaitCensored->is_checked == 0 ? 'style="background: rgba(0,0,0,.05);"' : ""!!}>
                                              <td>
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" value="{{$productWaitCensored->id}}" name="ids[]" form="massExecute" id="chekc-p2-{{$productWaitCensored->id}}">
                                                      <label for="chekc-p2-{{$productWaitCensored->id}}"></label>
                                                  </div>
                                              </td>
                                              <td class="mailbox-star">
                                                  {{$stt++}}
                                              </td>
                                              <td class="mailbox-name"><a href="{{route('admin.censorships.show', $productWaitCensored->id)}}"><h5 class="lead">{{$productWaitCensored->name}}</h5></a></td>
                                              <td class="mailbox-name">{{$productWaitCensored->category != null ? $productWaitCensored->category->name : 'Danh mục không tồn tại'}}</td>
                                              <td class="mailbox-name">
                                                  @if ($productWaitCensored->is_checked == 0)
                                                      <span class='text-secondary'><i class="fa fa-file-import"></i></span>
                                                  @elseif($productWaitCensored->is_checked == 1)
                                                      <span class='text-success'><i class="fa fa-check"></i></span>
                                                  @else
                                                      <span class='text-danger'><i class="fa fa-ban"></i></span>
                                                  @endif
                                              </td>
                                              <td class="mailbox-subject">{{$productWaitCensored->user != null ? $productWaitCensored->user->name : 'Tài khoản không tồn tại'}}</td>
                                              <td class="mailbox-subject">{{$productWaitCensored->amount}}</td>
                                              <td class="mailbox-date">
                                                  <a title="Xem thông tin yêu cầu" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.censorships.show', $productWaitCensored->id) }}">
                                                      <i class="fas fa-eye"></i>
                                                  </a>
                                                  <form action="{{ route('admin.censorships.censored', $productWaitCensored->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xác nhận');" style="display: inline-block;">
                                                      <input type="hidden" name="_method" value="PUT">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <button type="submit" title="Xác nhận yêu cầu {{ $productWaitCensored->name }}" {{$productWaitCensored->is_checked == 1 ? "disabled" : ""}} class="btn btn-xs btn-flat btn-success" > <i class="fas fa-check"></i></button>
                                                  </form>
                                                  <button type="button" data-toggle="modal" {{$productWaitCensored->is_checked == 2 ? "disabled" : ""}} data-target="#modal-default-{{$productWaitCensored->id}}" title="Không xác nhận yêu cầu {{ $productWaitCensored->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-ban"></i></button>
                                              </td>
                                          {{-- modal --}}
                                          <div class="modal fade" id="modal-default-{{$productWaitCensored->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <form action="{{ route('admin.censorships.notCensored') }}" method="POST" onsubmit="return confirm('Bạn chắc muốn không xác nhận');" style="display: inline-block;">
                                                          <input type="hidden" name="_method" value="PUT">
                                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                          <input type="hidden" name="id" value="{{$productWaitCensored->id}}">
                                                          <div class="modal-header">
                                                              <h4 class="modal-title">Xác nhận lý do không xác nhận sp {{$productWaitCensored->id}}</h4>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <div class="form-group">
                                                                  <label class="col-form-label" for="inputWarning">Nhập lý do không xác nhận<span class="text text-danger">*</span></label>
                                                                  <input type="text" name="violation" class="form-control is-warning" id="inputWarning" placeholder="Nhập lý do không xác nhận">
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer justify-content-between">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                              <button type="submit" title="Không xác nhận yêu cầu {{ $productWaitCensored->name }}" class="btn btn-warning" >Đồng ý</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                                  <!-- /.modal-content -->
                                              </div>
                                              <!-- /.modal-dialog -->
                                          </div>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                  <!-- /.table -->
                              </div>
                              <!-- /.mail-box-messages -->
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header bg-info">
                              <h3 class="card-title">Tất cả yêu cầu đã được kiểm duyệt</h3>
                              <div class="card-tools">
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" placeholder="Tìm kiếm">
                                  <div class="input-group-append">
                                      <div class="btn btn-primary">
                                      <i class="fas fa-search"></i>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                              <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0">
                              <div class="mailbox-controls">
                                  <!-- Check all button -->
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default btn-sm checkbox-toggle" id="page-3"><i class="far fa-square"> Chọn hàng loạt</i>
                                      </button>
                                  </div>
                                  <!-- /.btn-group -->
                                  <div class="float-right">
                                      <div class="btn-group">
                                          <div class="btn-group" style="margin-bottom: -10px;">
                                              {{$productsCensored->links()}}
                                          </div>
                                      </div>
                                  <!-- /.btn-group -->
                                  </div>
                                  <!-- /.float-right -->
                              </div>
                              <div class="table-responsive mailbox-messages" id="page-cont-3">
                                  <table class="table table-hover">
                                      <thead>
                                          <th></th>
                                          <th>STT</th>
                                          <th>Tên sản phẩm</th>
                                          <th>Danh mục</th>
                                          <th>Kiểm duyệt</th>
                                          <th>Nhà cung cấp</th>
                                          <th>Số lượng</th>
                                          <th>Chức năng</th>
                                      </thead>
                                      <tbody>
                                          @php
                                              $stt = 1;
                                          @endphp
                                          @foreach ($productsCensored as $productCensored)
                                          <tr {!!$productCensored->is_checked == 0 ? 'style="background: rgba(0,0,0,.05);"' : ""!!}>
                                              <td>
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" value="{{$productCensored->id}}" name="ids[]" form="massExecute" id="chekc-p3-{{$productCensored->id}}">
                                                      <label for="chekc-p3-{{$productCensored->id}}"></label>
                                                  </div>
                                              </td>
                                              <td class="mailbox-star">
                                                  {{$stt++}}
                                              </td>
                                              <td class="mailbox-name"><a href="{{route('admin.censorships.show', $productCensored->id)}}"><h5 class="lead">{{$productCensored->name}}</h5></a></td>
                                              <td class="mailbox-name">{{$productCensored->category != null ? $productCensored->category->name : 'Danh mục không tồn tại'}}</td>
                                              <td class="mailbox-name">
                                                  @if ($productCensored->is_checked == 0)
                                                      <span class='text-secondary'><i class="fa fa-file-import"></i></span>
                                                  @elseif($productCensored->is_checked == 1)
                                                      <span class='text-success'><i class="fa fa-check"></i></span>
                                                  @else
                                                      <span class='text-danger'><i class="fa fa-ban"></i></span>
                                                  @endif
                                              </td>
                                              <td class="mailbox-subject">{{$productCensored->user != null ? $productCensored->user->name : 'Tài khoản không tồn tại'}}</td>
                                              <td class="mailbox-subject">{{$productCensored->amount}}</td>
                                              <td class="mailbox-date">
                                                  <a title="Xem thông tin yêu cầu" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.censorships.show', $productCensored->id) }}">
                                                      <i class="fas fa-eye"></i>
                                                  </a>
                                                  <form action="{{ route('admin.censorships.censored', $productCensored->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xác nhận');" style="display: inline-block;">
                                                      <input type="hidden" name="_method" value="PUT">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <button type="submit" title="Xác nhận yêu cầu {{ $productCensored->name }}" {{$productCensored->is_checked == 1 ? "disabled" : ""}} class="btn btn-xs btn-flat btn-success" > <i class="fas fa-check"></i></button>
                                                  </form>
                                                  <button type="button" data-toggle="modal" {{$productCensored->is_checked == 2 ? "disabled" : ""}} data-target="#modal-default-{{$productCensored->id}}" title="Không xác nhận yêu cầu {{ $productCensored->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-ban"></i></button>
                                              </td>
                                          {{-- modal --}}
                                          <div class="modal fade" id="modal-default-{{$productCensored->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <form action="{{ route('admin.censorships.notCensored') }}" method="POST" onsubmit="return confirm('Bạn chắc muốn không xác nhận');" style="display: inline-block;">
                                                          <input type="hidden" name="_method" value="PUT">
                                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                          <input type="hidden" name="id" value="{{$productCensored->id}}">
                                                          <div class="modal-header">
                                                              <h4 class="modal-title">Xác nhận lý do không xác nhận sp {{$productCensored->id}}</h4>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <div class="form-group">
                                                                  <label class="col-form-label" for="inputWarning">Nhập lý do không xác nhận<span class="text text-danger">*</span></label>
                                                                  <input type="text" name="violation" class="form-control is-warning" id="inputWarning" placeholder="Nhập lý do không xác nhận">
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer justify-content-between">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                              <button type="submit" title="Không xác nhận yêu cầu {{ $productCensored->name }}" class="btn btn-warning" >Đồng ý</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                                  <!-- /.modal-content -->
                                              </div>
                                              <!-- /.modal-dialog -->
                                          </div>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                  <!-- /.table -->
                              </div>
                              <!-- /.mail-box-messages -->
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-notCensored" role="tabpanel" aria-labelledby="custom-tabs-four-notCensored-tab">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header bg-info">
                              <h3 class="card-title">Tất cả yêu cầu không duyệt</h3>
                              <div class="card-tools">
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" placeholder="Tìm kiếm">
                                  <div class="input-group-append">
                                      <div class="btn btn-primary">
                                      <i class="fas fa-search"></i>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                              <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0">
                              <div class="mailbox-controls">
                                  <!-- Check all button -->
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default btn-sm checkbox-toggle" id="page-4"><i class="far fa-square"> Chọn hàng loạt</i>
                                      </button>
                                  </div>
                                  <!-- /.btn-group -->
                                  <div class="float-right">
                                      <div class="btn-group">
                                          <div class="btn-group" style="margin-bottom: -10px;">
                                              {{$productsNotCensored->links()}}
                                          </div>
                                      </div>
                                  <!-- /.btn-group -->
                                  </div>
                                  <!-- /.float-right -->
                              </div>
                              <div class="table-responsive mailbox-messages" id="page-cont-4">
                                  <table class="table table-hover">
                                      <thead>
                                          <th></th>
                                          <th>STT</th>
                                          <th>Tên sản phẩm</th>
                                          <th>Danh mục</th>
                                          <th>Kiểm duyệt</th>
                                          <th>Nhà cung cấp</th>
                                          <th>Số lượng</th>
                                          <th>Chức năng</th>
                                      </thead>
                                      <tbody>
                                          @php
                                              $stt = 1;
                                          @endphp
                                          @foreach ($productsNotCensored as $productNotCensored)
                                          <tr {!!$productNotCensored->is_checked == 0 ? 'style="background: rgba(0,0,0,.05);"' : ""!!}>
                                              <td>
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" value="{{$productNotCensored->id}}" name="ids[]" form="massExecute" id="chekc-p3-{{$productNotCensored->id}}">
                                                      <label for="chekc-p3-{{$productNotCensored->id}}"></label>
                                                  </div>
                                              </td>
                                              <td class="mailbox-star">
                                                  {{$stt++}}
                                              </td>
                                              <td class="mailbox-name"><a href="{{route('admin.censorships.show', $productNotCensored->id)}}"><h5 class="lead">{{$productNotCensored->name}}</h5></a></td>
                                              <td class="mailbox-name">{{$productNotCensored->category != null ? $productNotCensored->category->name : 'Danh mục không tồn tại'}}</td>
                                              <td class="mailbox-name">
                                                  @if ($productNotCensored->is_checked == 0)
                                                      <span class='text-secondary'><i class="fa fa-file-import"></i></span>
                                                  @elseif($productNotCensored->is_checked == 1)
                                                      <span class='text-success'><i class="fa fa-check"></i></span>
                                                  @else
                                                      <span class='text-danger'><i class="fa fa-ban"></i></span>
                                                  @endif
                                              </td>
                                              <td class="mailbox-subject">{{$productNotCensored->user != null ? $productNotCensored->user->name : 'Tài khoản không tồn tại'}}</td>
                                              <td class="mailbox-subject">{{$productNotCensored->amount}}</td>
                                              <td class="mailbox-date">
                                                  <a title="Xem thông tin yêu cầu" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.censorships.show', $productNotCensored->id) }}">
                                                      <i class="fas fa-eye"></i>
                                                  </a>
                                                  <form action="{{ route('admin.censorships.censored', $productNotCensored->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xác nhận');" style="display: inline-block;">
                                                      <input type="hidden" name="_method" value="PUT">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <button type="submit" title="Xác nhận yêu cầu {{ $productNotCensored->name }}" {{$productNotCensored->is_checked == 1 ? "disabled" : ""}} class="btn btn-xs btn-flat btn-success" > <i class="fas fa-check"></i></button>
                                                  </form>
                                                  <button type="button" data-toggle="modal" {{$productNotCensored->is_checked == 2 ? "disabled" : ""}} data-target="#modal-default-{{$productNotCensored->id}}" title="Không xác nhận yêu cầu {{ $productNotCensored->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-ban"></i></button>
                                              </td>
                                          {{-- modal --}}
                                          <div class="modal fade" id="modal-default-{{$productNotCensored->id}}">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <form action="{{ route('admin.censorships.notCensored') }}" method="POST" onsubmit="return confirm('Bạn chắc muốn không xác nhận');" style="display: inline-block;">
                                                          <input type="hidden" name="_method" value="PUT">
                                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                          <input type="hidden" name="id" value="{{$productNotCensored->id}}">
                                                          <div class="modal-header">
                                                              <h4 class="modal-title">Xác nhận lý do không xác nhận sp {{$productNotCensored->id}}</h4>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <div class="form-group">
                                                                  <label class="col-form-label" for="inputWarning">Nhập lý do không xác nhận<span class="text text-danger">*</span></label>
                                                                  <input type="text" name="violation" class="form-control is-warning" id="inputWarning" placeholder="Nhập lý do không xác nhận">
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer justify-content-between">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                              <button type="submit" title="Không xác nhận yêu cầu {{ $productNotCensored->name }}" class="btn btn-warning" >Đồng ý</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                                  <!-- /.modal-content -->
                                              </div>
                                              <!-- /.modal-dialog -->
                                          </div>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                  <!-- /.table -->
                              </div>
                              <!-- /.mail-box-messages -->
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                      </div>
                    </div>
                </div>
                </div>
                <!-- /.card -->
                </div>
            </div>
            </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script >
// $(document).ready(function() {
//     $('#example').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     } );
// } );
</script>
<script>
$(document).ready(function(){
  //Enable check and uncheck all functionality
    $('.checkbox-toggle#page-1').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('.mailbox-messages#page-cont-1 input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle#page-1 .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.mailbox-messages#page-cont-1 input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle#page-1 .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })
    //page2
    $('.checkbox-toggle#page-2').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('.mailbox-messages#page-cont-2 input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle#page-2 .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.mailbox-messages#page-cont-2 input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle#page-2 .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })
    //page3
    $('.checkbox-toggle#page-3').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('.mailbox-messages#page-cont-3 input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle#page-3 .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.mailbox-messages#page-cont-3 input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle#page-3 .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })
    //page4
    $('.checkbox-toggle#page-4').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('.mailbox-messages#page-cont-4 input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle#page-4 .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.mailbox-messages#page-cont-4 input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle#page-4 .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })
})
// active-default
if(!$('.is-active').hasClass('active')){
  $('.active-default').addClass('active');
}
</script>
@endsection
@section('id-active')#nav-censorships @endsection