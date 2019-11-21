@extends('admins.layout.master')
@section('title')
Quản lý quảng cáo
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
              <h1>Quản lý khuyến mãi</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Khuyến mãi</li>
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
              <a title="Thêm khuyến mãi" class="btn btn-flat btn-success" href="{{route('admin.promotions.create')}}">
                  <i class="fas fa-plus-square"></i>  Thêm mới
              </a>
              <form id="massDelete" action="{{route('admin.promotion.massDestroy')}}" method="post" class="d-inline-block" >
                @csrf
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
                      <input type="checkbox"  id="check-all" >
                      <label for="check-all" ></label>
                    </div>
                  </th>
                  <th>Stt</th>
                  <th>Banner</th>
                  <th>Tiêu đề</th>
                  <th>Mô tả</th>
                  <th>Cấp độ</th>
                  <th>Bắt đầu</th>
                  <th>Kết thúc</th>
                  <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions as $promotion)
                <tr>
                  <td>
                    <div class="icheck-danger d-inline">
                      <input type="checkbox" form="massDelete" name="ids[]" id="ids-{{$promotion->id}}"   value="{{$promotion->id}}">
                      <label for="ids-{{$promotion->id}}" ></label>
                    </div>
                  </td>
                  <td>{{$promotion->id}}</td>
                  <td>
                    <img style="width:100%;max-height:120px" src="{{asset('thumbnails/'.$promotion->banner)}}" alt="Hình ảnh hiển thị" id="banner-preview" class="img-fluid">
                  </td>
                  <td>{{$promotion->title}}</td>
                  <td>{{$promotion->description}}</td>
                  <td>{{$promotion->reduction_level}}</td>
                  <td>{{$promotion->started_at}}</td>
                  <td>{{$promotion->finished_at}}</td>
                  <td>
                    <a title="Xem thông tin khuyến mãi" class="btn btn-xs btn-flat btn-primary" href="{{route('admin.promotions.show',$promotion->id)}}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a title="Sửa thông tin khuyến mãi" href="{{route('admin.promotions.edit',[$promotion->id])}}" class="btn btn-xs btn-flat btn-info"><i class="fas fa-edit"></i></a>
                    <form action="{{route('admin.promotions.destroy',['idpr'=>$promotion->id])}}" method="POST"  style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" title="Xoá khuyến mãi {{ $promotion->title }}" class="btn btn-xs btn-flat btn-danger" > <i class="fas fa-trash-alt"></i></button>
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
  
  // choosing or uncheck all items in datalist
  $('input#check-all').change(function() {
    if(this.checked){
      $('input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = true
      });
      
    }else {
      $('input[type="checkbox"][name="ids[]"]').map((index, ele) => {
        ele.checked = false
      });
    }
  })

  // turn off all background color of other topic in sidebar
  let ele = $('.nav-link')
  for(let i = 0; i < ele.length; i++) {
      ele[i].classList.remove('active');
  }

  //change background color to Khuyen Mai in sidebar
  $('#nav-promotions').addClass('active');
})
</script>
@endsection