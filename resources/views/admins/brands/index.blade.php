@extends('admins.layout.master')
@section('title')
Quản lý thương hiệu
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
              <h1>Quản lý thương hiệu</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Thương hiệu</li>
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
          <div class="card">
            <div class="card-header">
              <a title="Thêm thương hiệu mới" class="btn btn-flat btn-success" href="{{ route('admin.brands.create') }}">
                  <i class="fas fa-plus-square"></i>  Thêm mới
              </a>
              <form id="massDelete" action="{{ route('admin.brands.massDestroy') }}" method="post" class="d-inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá những dòng đã chọn')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-flat btn-danger"><i class="fas fa-dumpster-fire"></i> Xoá tất cả đã chọn</button>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>
                    <div class="icheck-danger d-inline">
                      <input type="checkbox"  id="check-all">
                      <label for="check-all" ></label>
                    </div>
                  </th>
                  <th>Stt</th>
                  <th>Tên thương hiệu</th>
                  <th>Hình ảnh</th>
                  <th>Mô tả</th>
                  <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($brands as $brand)
                  <tr>
                  <td>
                    <div class="icheck-danger d-inline">
                      <input form="massDelete" type="checkbox" name="ids[]" id="ids-{{ $brand->id }}" value="{{ $brand->id }}">
                      <label for="ids-{{ $brand->id }}" ></label>
                    </div>
                  </td>
                  <td>{{ $brand->id }}</td>
                  <td>{{ $brand->name }}</td>
                  <td>
                    <img width="200px" class="img-fluid" src="{{ asset('thumbnails/' . $brand->thumbnail) }}" alt="{{ $brand->thumbnail }}" >
                  </td>
                  <td>{{ $brand->description }}</td>
                  <td>
                    <a title="Xem thông tin thương hiệu" class="btn btn-xs btn-flat btn-primary" href="{{ route('admin.brands.show', $brand->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a title="Sửa thông tin thương hiệu" href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" title="Xoá thương hiệu {{ $brand->name }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-trash-alt"></i></button>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
$(document).ready(function(){
  $('input#check-all').change(function() {
    if(this.checked){
      $('input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = true
      })
    }else {
      $('input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = false
      })
    }
  })
})
</script>
@endsection
@section('id-active')#nav-brands @endsection