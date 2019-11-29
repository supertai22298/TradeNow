@extends('admins.layout.master')
@section('title')
Sản phẩm {{ $product->name }}
@endsection
@section('css')
  <!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css "> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="admins/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="admins/plugins/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="admins/plugins/owlcarousel/assets/owl.theme.default.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý sản phẩm</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
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
             <h1>{{ $product->name }}</h1>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                    <div class="col-12">
                      <img src="{{ asset('images/'. $product->image) }}" class="product-image" id="product_image" alt="Product Image">
                      <div class="owl-carousel owl-height bg-light product-image-thumbs p-2">
                        <img class="product-image-thumb" src="{{ asset('images/'. $product->image) }}" alt="Product Thumb">
                        @foreach ($product->product_images as $image)
                        <img class="product-image-thumb" src="{{ asset('images/'. $image->image) }}" alt="Product Thumb">
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $product->name }}</h3>
                    <p>{!! $product->limitDescription() !!}</p>
      
                    <hr>
                    <h4>Số lượng còn lại</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <i class="fas fa-circle fa-2x text-{{ $product->changeTextAmountColor() }}"> 
                          {{ $product->amount }}
                        </i>
                    </div>
      
                    <h4 class="mt-3">Trạng thái kiểm duyệt <small class="text text-{{ $product->getColorOfCheck() }}">{{ $product->getTextOfCheck() }}</small></h4>
                    @if ($product->isChecked())
                    <h4>Lý do vi phạm</h4>
                    <div class="d-block border border-dark p-3">
                      {{ $product->violation }}
                    </div>
                    @endif
                    <div class="bg-gray py-2 px-3 mt-4">
                      <h2 class="mb-0">
                        Giá bán lẻ: {{ $product->getFreshPrice() }}
                      </h2>
                      <h4 class="mt-0">
                        <small>Giá sau thuế: {{ $product->getFreshPrice() }} (Đã áp dụng thuế)</small>
                      </h4>
                    </div>
      
                    <div class="mt-4">
                      @if ($product->product_details)
                        <h3>Thông tin chi tiết</h3>
                        <table class="table table-striped">
                          @foreach ($product->product_details as $item)
                            <tr>
                              <th>{{ $item->type }}</th>
                              <td>{{ $item->description }}</td>
                            </tr>
                          @endforeach
                        </table>
                      @endif
                    </div>
      
                    {{-- <div class="mt-4 product-share">
                      <a href="#" class="text-gray">
                        <i class="fab fa-facebook-square fa-2x"></i>
                      </a>
                      <a href="#" class="text-gray">
                        <i class="fab fa-twitter-square fa-2x"></i>
                      </a>
                      <a href="#" class="text-gray">
                        <i class="fas fa-envelope-square fa-2x"></i>
                      </a>
                      <a href="#" class="text-gray">
                        <i class="fas fa-rss-square fa-2x"></i>
                      </a>
                    </div> --}}
      
                  </div>
                </div>
                <hr>
                <div class="row mt-4">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active-default is-active" 
                        id="product-desc-tab" data-toggle="tab" 
                        href="#product-desc" role="tab" aria-controls="product-desc" 
                        aria-selected="true">Mô tả sản phẩm</a>
                      <a class="nav-item nav-link is-active" 
                        id="product-comments-tab" data-toggle="tab" 
                        href="#product-comments" role="tab" 
                        aria-controls="product-comments" aria-selected="false">
                          Bình luận về sản phẩm</a>
                      <a class="nav-item nav-link" 

                        id="product-rating-tab" data-toggle="tab" 
                        href="#product-rating" role="tab" 
                        aria-controls="product-rating" aria-selected="false">Nhận xét sản phẩm</a>
                    </div>
                  </nav>
                  <div class="tab-content p-3 col-md-12" id="nav-tabContent">
                    <div class="tab-pane fade show active" 
                      id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                      {!! $product->description !!}
                    </div>
                    <div class="tab-pane fade col-md-12" id="product-comments" 
                      role="tabpanel" aria-labelledby="product-comments-tab">
                        @if($product->comments)
                          @foreach($product->comments as $comment)
                            <div class="card">
                              <!-- User image -->
                              <div class="card-body bg-light py-1">
                                <p class="card-title">
                                  <span class="username text-bold">{{ $comment->user->name }}</span>
                                  <span class="text-muted float-right ml-3"> {{ $comment->diffFromNow() }}</span>
                                </p>
                                <p class="card-text d-block">
                                  {{ $comment->description }}
                                </p>
                                @if(!$comment->isReplied())
                                <a href="#" style="display: block" onclick="reply(this)" data-id="{{ $comment->id }}" class="text text-warning ml-3">
                                  <span><i class="fas fa-comment-dots"></i> Reply</span>
                                </a>
                                @endif

                                @if($comment->isReplied())
                                <!-- phần reply-->
                                <div class="card bg-white ml-3">
                                  <div class="card-body bg-light py-1">
                                    <p class="card-title">
                                      <span class="username text-bold">{{ Auth::user()->name }}</span>
                                      <span class="text-muted float-right ml-3"> {{ $comment->replied_at }}</span>
                                    </p>
                                    <p class="card-text d-block">
                                      {{ $comment->reply }}
                                    </p>
                                  </div>
                                </div>
                                <!--Hết reply-->
                                @endif
                              </div>  
                              @if(!$comment->isReplied())
                              <div class="card-footer">
                                <form action="" onsubmit="sendReply(this)" id="formReply-{{ $comment->id }}" data-id="{{ $comment->id }}" method="post" class="form-inline" style="display: none">
                                  <input type="text" name="reply" id="" class="form-control rounded-0" required>
                                  <button type="submit" class="btn btn-flat btn-secondary">Trả lời</button>
                                </form>
                              </div>
                              @endif
                              <!-- /.comment-text -->
                            </div>
                          @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="product-rating" 
                      role="tabpanel" aria-labelledby="product-rating-tab">Nhận xét hiển thị ở đây
                    </div>
                  </div>
                </div>
              </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="{{ route('admin.products.index') }}" class="btn btn-flat btn-default mr-2"><i class="fas fa-arrow-left"></i>Danh sách</a>
              <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-flat btn-info"><i class="fas fa-edit"></i>Sửa</a>
            </div>
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
<script src="admins/plugins/owlcarousel/owl.carousel.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      const thumbs = document.getElementsByClassName('product-image-thumb')
      for (const item of thumbs) {

        //nếu xảy ra lỗi thì biến đi cho nhẹ người nhé người anh em
        item.addEventListener('error', function() {
          this.style.display = 'none';
        })

        // ko thì thay đổi source thôi nha con đuỹ chó
        item.addEventListener('click', function() {
          document.getElementById('product_image').src = item.src
          console.log(document.getElementById('product_image').src )
        })
        
      }
    });
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin:10,
      responsiveClass: true,
      autoHeight: false,
      nav: true,
      items: 4,
      navText: ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
      dots: false,
    });

    $(document).ready(function(){
        // active-default
      if(!$('.is-active').hasClass('active')){
        $('.active-default').addClass('active');
      }
    })
      
  </script>
  <script>
  const reply = function(ele) {
    event.preventDefault()
    const formReply = document.getElementById(`formReply-${ele.dataset.id}`)
    ele.style.display = 'none'
    formReply.style.display = 'block'
  }
  const sendReply = function(ele) {
    event.preventDefault()
    const reply = ele.elements[0].value
    const comment = ele.dataset.id
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "PUT",
        url: `/admin/comments/${comment}/replyComment`,
        data: {
          reply: reply  
        },
        success: function (response) {  
          alert(response)
          ele.style.display = 'none'
        }
      })

  }
  </script>
@endsection
@section('id-active')#nav-products @endsection