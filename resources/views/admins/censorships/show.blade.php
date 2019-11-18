@extends('admins.layout.master')
@section('title')
Yêu cầu kiểm duyệt
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
							<h1>Chi tiết yêu cầu kiểm duyệt</h1>
						</div>
						<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
								<li class="breadcrumb-item "><a href="{{ route('admin.censorships.index') }}">Kiểm duyệt</a></li>
								<li class="breadcrumb-item active"> Chi tết kiểm duyệt sản phẩm</li>
						</ol>
						</div>
				</div>
				</div><!-- /.container-fluid -->
		</section>
		@include('components.success')
		@error('violation')
			<div class="alert alert-danger">{{ $message }}</div>
    @enderror
		<!-- Main content -->
		<div class="card card-solid">
				<div class="card-body pb-0">
						<div class="row d-flex align-items-stretch">
						<div class="col-12 col-md-12 d-flex align-items-stretch">
								<div class="card bg-light w-100">
								<div class="card-header text-muted border-bottom-0">
										<h3>Thông tin sản phẩm</h3>
								</div>
								<div class="card-body pt-0">
										<div class="row">
												<div class="col-12 col-sm-6">
														<h3 class="d-inline-block d-sm-none">Thông tin sản phẩm</h3>
														<div class="col-12">
																@foreach ($censorship->images as $image)
																		@if ($image->is_top == 1)
																				<img src="{{"images/" . $image->image }}" class="product-image" alt="Product Image">
																		@endif
																@endforeach
														</div>
														<div class="col-12 product-image-thumbs">
																@foreach ($censorship->images as $image)
																<div class="product-image-thumb active"><img src="{{ "thumbnails/" .$image->thumbnail}}" alt="Product Image"></div>
																@endforeach
														</div>
												</div>
												<div class="col-12 col-sm-6">
														<h3 class="my-3">Thông tin cơ bản sản phẩm</h3>
														<table class="table table-bordered">
																<thead class="bg-olive">
																		<th>Tiêu đề</th>
																		<th>Thông tin</th>
																</thead>
																<tbody>
																		<tr>
																				<td>Tên sản phẩm</td>
																				<td>{{$censorship->name}}</td>
																		</tr>
																		<tr>
																				<td>Kiểm duyệt</td>
																				<td>
																						@if ($censorship->is_checked == 1)
																								{!!"<span class='text-success'>Sản phẩm hợp lệ</span>"!!}
																						@elseif($censorship->is_checked == 2)
																								{!!"<span class='text-danger'>Sản phẩm không hợp lệ</span>"!!}
																						@else
																								{!!"<span class='text-secondary'>Chưa kiểm duyệt</span>"!!}
																						@endif
																				</td>
																		</tr>
																		{!! $censorship->is_checked == 2 ? "<tr><td>Lí do</td><td>$censorship->violation</td></tr>" : ""!!}
																		<tr>
																				<td>Thuộc danh mục hàng</td>
																				<td>{{$censorship->category->name}}</td>
																		</tr>
																		<tr>
																				<td>Thương hiệu</td>
																				<td>{{$censorship->brand->name}}</td>
																		</tr>
																		<tr>
																				<td>Trạng thái</td>
																				<td>{{$censorship->product_status->name}}</td>
																		</tr>
																		<tr>
																				<td>Số lượng hiện có</td>
																				<td>{{$censorship->amount}}</td>
																		</tr>
																		<tr>
																				<td>Mô tả sản phẩm</td>
																				<td>{{$censorship->description}}</td>
																		</tr>
																</tbody>
														</table>

														<hr>
														<h3 class="my-3">Thông tin bán hàng</h3>
														<table class="table table-bordered">
																<thead class="bg-olive">
																		<th>Tiêu đề</th>
																		<th>Thông tin</th>
																</thead>
																<tbody>
																		<tr>
																				<td>Tiêu đề bán hàng</td>
																				<td>{{$censorship->title_seo}}</td>
																		</tr>
																		<tr>
																				<td>Giá bán</td>
																				<td>{{$censorship->price}}</td>
																		</tr>
																		<tr>
																				<td>Mô tả bán hàng</td>
																				<td>{{$censorship->descripton_seo}}</td>
																		</tr>
																</tbody>
														</table>

														<hr>
														<h3 class="my-3">Thông tin chi tiết sản phẩm</h3>
														<table class="table table-bordered">
																<thead class="bg-olive">
																		<th>Tiêu đề</th>
																		<th>Thông tin</th>
																</thead>
																<tbody>
																		@foreach ($censorship->product_details as $product_detail)
																				<tr>
																						<td>{{$product_detail->type}}</td>
																						<td>{{$product_detail->description}}</td>
																				</tr>
																		@endforeach
																</tbody>
														</table>
														</div>
										</div>
								</div>
								<div class="card-footer">
										<div class="text-right">
												<a href="{{ route('admin.censorships.index') }}" class="btn btn-flat btn-default mr-2"><i class="fas fa-arrow-left"></i>Danh sách</a>
												<form action="{{ route('admin.censorships.censored', $censorship->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xác nhận');" style="display: inline-block;">
													<input type="hidden" name="_method" value="PUT">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<button type="submit" title="Xác nhận yêu cầu {{ $censorship->name }}" {{$censorship->is_checked == 1 ? "disabled" : ""}} class="btn btn-flat btn-info" > <i class="fas fa-edit"></i>Xác nhận</button>
												</form>
												<button type="button" data-toggle="modal" {{$censorship->is_checked == 2 ? "disabled" : ""}} data-target="#modal-default-{{$censorship->id}}" title="Không xác nhận yêu cầu {{ $censorship->name }}" class="btn btn-flat btn-warning" ><i class="fas fa-ban"></i>Không xác nhận yêu cầu</button>
										</div>
								</div>
								</div>
						</div>
						
						</div>
						{{-- modal --}}
						<div class="modal fade" id="modal-default-{{$censorship->id}}">
								<div class="modal-dialog">
										<div class="modal-content">
												<form action="{{ route('admin.censorships.notCensored') }}" method="POST" onsubmit="return confirm('Bạn chắc muốn không xác nhận');" style="display: inline-block;">
														<input type="hidden" name="_method" value="PUT">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="id" value="{{$censorship->id}}">
														<div class="modal-header">
																<h4 class="modal-title">Xác nhận lý do không xác nhận sp {{$censorship->id}}</h4>
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
																<button type="submit" title="Không xác nhận yêu cầu {{ $censorship->name }}" class="btn btn-warning" >Đồng ý</button>
														</div>
												</form>
										</div>
										<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
						</div>
				</div>
				<!-- /.card-body -->
		</div>
@endsection
@section('js')
<script>
		
</script>
@endsection