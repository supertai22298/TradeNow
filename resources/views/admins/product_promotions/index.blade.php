@extends('admins.layout.master')
@section('title')
Quản lý sản phẩm khuyến mãi
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
        <h1>Quản lý sản phẩm khuyến mãi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active">Sản phẩm khuyến mãi</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@include('components.success')
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<section class="content">
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-header p-0 pt-1">
          <div class="card-header-func">
            <a title="Thêm sản phẩm mới" class="btn btn-flat btn-success"
              href="{{ route('admin.product_promotions.create') }}">
              <i class="fas fa-plus-square"></i> Thêm mới
            </a>
            <form id="massDelete" action="{{ route('admin.product_promotions.massDestroy') }}" method="post"
              class="d-inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xoá những dòng đã chọn')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-flat btn-danger"><i class="fas fa-dumpster-fire"></i> Xoá tất cả đã
                chọn</button>
            </form>
          </div>
          <div class="card-body">
            <div class="card">
              <div class="card-body">
                <table id="allProduct" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="check-all" class="check-all">
                          <label for="check-all"></label>
                        </div>
                      </th>
                      <th>Tên sản phẩm</th>
                      <th>Loại giảm giá</th>
                      <th>Số lượng giảm giá</th>
                      <th>Giá</th>
                      <th>Giá sau khi giảm</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>
                        <div class="icheck-danger d-inline">
                          <input form="massDelete" type="checkbox" name="ids[]"
                            id="ids-{{ $product->id }}-{{ $product->promotion_id }}"
                            value="{{ $product->id . '-' . $product->promotion_id }}" multiple>
                          <label for="ids-{{ $product->id }}-{{ $product->promotion_id }}"></label>
                        </div>
                      </td>
                      <td>{{ $product->name }}</td>
                      <td>
                        {{ $product->type }}
                      </td>
                      <td>{{ $product->amount }}</td>
                      <td> {{ 'đ '. number_format($product->price, 0, '', '.') }} </td>
                      <td>
                        {{ 'đ '. number_format(getPriceAfterReduce($product->price, $product->reduction_level), 0, '', '.') }}
                      </td>
                      <td>
                        <a title="Xem thông tin sản phẩm khuyến mãi" class="btn btn-xs btn-flat btn-primary"
                          href="{{ route('admin.products.show', $product->id) }}">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a title="Sửa thông tin sản phẩm khuyến mãi"
                          href="{{ route('admin.products.edit', $product->id) }}"
                          class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.product_promotions.destroy', [
                          'product_id' => $product->product_id, 
                          'promotion_id' => $product->promotion_id
                        ]) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá');"
                          style="display: inline-block;">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" title="Xoá sản phẩm {{ $product->name }}"
                            class="btn btn-xs btn-flat btn-danger"> <i class="fas fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
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
<script>
  $(document).ready(function() {
  $('#allProduct').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
  } );
  $('#allProduct input#check-all').change(function() {
    if(this.checked){
      $('#allProduct input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = true
      })
    }else {
      $('#allProduct input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = false
      })
    }
  })
})
</script>
@endsection
@section('id-active')#nav-product-promotions @endsection