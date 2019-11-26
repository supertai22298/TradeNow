@extends('admins.layout.master')
@section('title')
Quản lý người dùng
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
              <h1>Quản lý người dùng</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">người dùng</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('components.success')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0 bg-light">
                <div class="my-2">
                    <a title="Thêm người dùng mới" class="btn btn-flat btn-success" href="{{ route('admin.users.create') }}">
                        <i class="fas fa-plus-square"></i>  Thêm mới
                    </a>
                    <form id="massDelete" action="{{ route('admin.users.massDestroy') }}" method="post" class="d-inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá những dòng đã chọn')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-flat btn-danger"><i class="fas fa-dumpster-fire"></i> Xoá tất cả đã chọn</button>
                    </form>
                </div>
                <hr>
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active-default is-active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link is-active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Người dùng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link is-active" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Nhà cung cấp</a>
                </li>
                </ul>
            </div>
            <div class="card-body p-0 pt-1">
              <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-0">
                              <table id="allUser" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th>
                                    <div class="icheck-danger d-inline">
                                      <input type="checkbox"  id="check-allUser">
                                      <label for="check-allUser" ></label>
                                    </div>
                                  </th>
                                  <th>STT</th>
                                  <th>Tên</th>
                                  <th>Email</th>
                                  <th>Loại tài khoản</th>
                                  <th>Trạng thái</th>
                                  <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $stt = 1;
                                    @endphp
                                @foreach ($users as $user)
                                  <tr>
                                  <td>
                                    <div class="icheck-danger d-inline">
                                      <input  form="massDelete" type="checkbox" name="ids[]" id="ids-{{ $user->id }}" value="{{ $user->id }}">
                                      <label for="ids-{{ $user->id }}" ></label>
                                    </div>
                                  </td>
                                  <td>{{ $stt++ }}</td>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>{{ $user->is_admin == true ? "Admin" : "Người dùng" }}</td>
                                  <td>{!! $user->active == true ? "<span class='text-success font-weight-bold'>Hoạt động</span>" : "<span class='text-danger font-weight-bold'>Khóa<span>" !!}</td>
                                  <td>
                                    <a title="Xem thông tin người dùng" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a title="Sửa thông tin người dùng" href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" title="Xoá người dùng {{ $user->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                  </td>
                                  </tr>
                                @endforeach
                
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <div class="col-md-12">
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <table id="allCustomer" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>
                                  <div class="icheck-danger d-inline">
                                    <input type="checkbox"  id="check-allCustomer">
                                    <label for="check-allCustomer" ></label>
                                  </div>
                                </th>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Loại tài khoản</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                              </tr>
                              </thead>
                              <tbody>
                                  @php
                                    $stt = 1;   
                                  @endphp
                              @foreach ($allCustomers as $customer)
                                <tr>
                                <td>
                                  <div class="icheck-danger d-inline">
                                    <input  form="massDelete" type="checkbox" name="ids[]" id="ids-customer-{{ $customer->id }}" value="{{ $customer->id }}">
                                    <label for="ids-customer-{{ $customer->id }}" ></label>
                                  </div>
                                </td>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->is_admin == true ? "Admin" : "Người dùng" }}</td>
                                <td>{!! $customer->active == true ? "<span class='text-success font-weight-bold'>Hoạt động</span>" : "<span class='text-danger font-weight-bold'>Khóa<span>" !!}</td>
                                <td>
                                  <a title="Xem thông tin người dùng" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.users.show', $customer->id) }}">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <a title="Sửa thông tin người dùng" href="{{ route('admin.users.edit', $customer->id) }}" class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                                  <form action="{{ route('admin.users.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá');" style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button type="submit" title="Xoá người dùng {{ $customer->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-trash-alt"></i></button>
                                  </form>
                                </td>
                                </tr>
                              @endforeach
              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-body p-0">
                            <table id="allSuplier" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>
                                  <div class="icheck-danger d-inline">
                                    <input type="checkbox"  id="check-allSuplier">
                                    <label for="check-allSuplier" ></label>
                                  </div>
                                </th>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Loại tài khoản</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                              </tr>
                              </thead>
                              <tbody>
                                  @php
                                    $stt = 1;   
                                  @endphp
                              @foreach ($allSuppliers as $supplier)
                                <tr>
                                <td>
                                  <div class="icheck-danger d-inline">
                                    <input  form="massDelete" type="checkbox" name="ids[]" id="ids-suppelier-{{ $supplier->id }}" value="{{ $supplier->id }}">
                                    <label for="ids-suppelier-{{ $supplier->id }}" ></label>
                                  </div>
                                </td>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->is_admin == true ? "Admin" : "Người dùng" }}</td>
                                <td>{!! $supplier->active == true ? "<span class='text-success font-weight-bold'>Hoạt động</span>" : "<span class='text-danger font-weight-bold'>Khóa<span>" !!}</td>
                                <td>
                                  <a title="Xem thông tin người dùng" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.users.show', $supplier->id) }}">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <a title="Sửa thông tin người dùng" href="{{ route('admin.users.edit', $supplier->id) }}" class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                                  <form action="{{ route('admin.users.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá');" style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button type="submit" title="Xoá người dùng {{ $supplier->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-trash-alt"></i></button>
                                  </form>
                                </td>
                                </tr>
                              @endforeach
              
                              </tbody>
                            </table>
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
          <!-- /.card -->
        </div>
        <!-- /.col -->
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
  $(document).ready(function() {
      $('#allUser').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
      $('#allCustomer').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
      $('#allSuplier').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
  } );
</script>
<script>
  $(document).ready(function(){
    $('#allUser input#check-allUser').change(function() {
      if(this.checked){
        $('#allUser input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = true
        })
      }else {
        $('#allUser input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = false
        })
      }
    })
    $('#allCustomer input#check-allCustomer').change(function() {
      if(this.checked){
        $('#allCustomer input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = true
        })
      }else {
        $('#allCustomer input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = false
        })
      }
    })
    $('#allSuplier input#check-allSuplier').change(function() {
      if(this.checked){
        $('#allSuplier input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = true
        })
      }else {
        $('#allSuplier input[type="checkbox"][name="ids[]"]').map((index, ele) => {
          ele.checked = false
        })
      }
    })
    // active-default
    if(!$('.is-active').hasClass('active')){
      $('.active-default').addClass('active');
    }
  })
</script>
@endsection
@section('id-active')#nav-users @endsection