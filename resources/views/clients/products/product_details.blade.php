@extends('clients.layout.master')

@section('title')Sản phẩm {{ $product->name }}
@endsection
@section('css')
<link href="clients/js/lightslider/lightslider.css" rel="stylesheet">
<style>
  .bg-light {
    background: rgba(100, 100, 100, 0.035);
    padding: 10px;
    margin-bottom: 20px;
  }
</style>
@endsection
@section('content')
<!-- Main Container  -->
<div class="main-container container">
  <ul class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('client.products.show', $product->id) }}">{{ $product->name }}</a></li>
  </ul>
  <div class="row">
    <div id="content" class="col-md-12 col-sm-12">
      <div class="product-view row">
        <div class="left-content-product col-lg-12 col-xs-12">
          <div class="row">
            <div class="content-product-left  col-sm-6 col-xs-12 ">
              <div id="thumb-slider-vertical" class="thumb-vertical-outer">
                <span class="btn-more prev-thumb nt"><i class="fa fa-chevron-up"></i></span>
                <span class="btn-more next-thumb nt"><i class="fa fa-chevron-down"></i></span>
                <ul class="thumb-vertical">
                  <li class="owl2-item">
                    <a style="padding: 5px;" data-index="0" class="img thumbnail"
                      data-image="thumbnails/{{$product->thumbnail}}">
                      <img src="thumbnails/{{$product->thumbnail}}"
                        alt="Product image">
                    </a>
                  </li>
                  @foreach ($product->product_images as $item)
                  <li class="owl2-item">
                    <a style="padding: 5px;" data-index="1" class="img thumbnail "
                      data-image="thumbnails/{{$item->thumbnail}}">
                      <img src="thumbnails/{{$item->thumbnail}}"
                        alt="product image">
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="large-image vertical">
                <img itemprop="image" data-update class="product-image-zoom" src="images/{{$product->image}}"
                  data-zoom-image="images/{{$product->image}}" alt="Product image">
              </div>
              {{-- <a class="thumb-video pull-left" href="../../../../https@www.youtube.com/watch@v=HhabgvIIXik"><i
                  class="fa fa-youtube-play"></i></a> --}}
            </div>

            <div class="content-product-right col-sm-6 col-xs-12">
              <div class="title-product">
                <h1>{{$product->name}}</h1>
              </div>
              <!-- Review ---->
              <div class="box-review form-group">
                <div class="ratings">
                  <div class="rating-box">
                    {!!$product->getHtmlRate()!!}
                  </div>
                </div>

                <a class="reviews_button" href="default.htm"
                  onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">{{$product->countReviews()}}
                  đánh giá</a> |
                <a class="write_review_button" href="default.htm"
                  onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Viết đánh giá</a>
              </div>

              <div class="product-label form-group">
                <div class="stock"><span>Trạng thái:</span> <span
                    class="status-stock">{{$product->checkAmount()}}</span></div>
                <div class="product_page_price price" itemprop="offerDetails" itemscope=""
                  itemtype="http://data-vocabulary.org/Offer">
                  <span class="price-new" itemprop="price">{{$product->formatMoney($product->price)}}</span>
                  {{-- <span class="price-old">{{$product->getPriceAfterReduce()}}</span> --}}
                </div>
              </div>

              <div class="product-box-desc">
                <div class="inner-box-desc">
                  <div class="price-tax"><span>Thuế:</span> ...</div>
                  <div class="brand"><span>Thương hiệu</span><a href="#"> {{$product->brand->name}}</a> </div>
                  <div class="model"><span>Mã sản phẩm:</span> {{$product->id}} </div>
                  <div class="model"><span>Số lượng:</span> {{$product->amount}} </div>
                </div>
              </div>

              <div id="product">
                <h4>Tùy chọn</h4>
                <div class="image_option_type form-group required">
                  {{-- <label class="control-label">Colors</label>
                    <ul class="product-options clearfix"id="input-option231">
                      <li class="radio active">
                        <label>
                          <input class="image_radio" type="radio" name="option[231]" value="33"> <img src="clients/image/demo/colors/blue.jpg"
                          data-original-title="blue +$12.00" class="img-thumbnail icon icon-color">				<i class="fa fa-check"></i>
                          <label> </label>
                        </label>
                      </li>
                      <li class="radio">
                        <label>
                          <input class="image_radio" type="radio" name="option[231]" value="34"> <img src="clients/image/demo/colors/brown.jpg"
                          data-original-title="brown -$12.00" class="img-thumbnail icon icon-color">				<i class="fa fa-check"></i>
                          <label> </label>
                        </label>
                      </li>
                      <li class="radio">
                        <label>
                          <input class="image_radio" type="radio" name="option[231]" value="35"> <img src="clients/image/demo/colors/green.jpg"
                          data-original-title="green +$12.00" class="img-thumbnail icon icon-color">				<i class="fa fa-check"></i>
                          <label> </label>
                        </label>
                      </li>
                      <li class="selected-option">
                      </li>
                    </ul> --}}
                </div>
                <div class="form-group box-info-product">
                  {{-- <div class="option quantity">
                    <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;">
                      <label>Số lượng</label>
                      <input class="form-control" type="text" name="quantity" value="1">
                      <input type="hidden" name="product_id" value="50">
                      <span class="input-group-addon product_quantity_down">−</span>
                      <span class="input-group-addon product_quantity_up">+</span>
                    </div>
                  </div> --}}
                  <div class="cart">
                    <input type="button" class="addToCart" data-toggle="tooltip" title="" value="Thêm vào giỏ hàng"
                      data-loading-text="Loading..." id="button-cart" class="btn btn-mega btn-lg"
                      data-id="{{$product->id}}" data-original-title="Thêm vào giỏ hàng">
                  </div>
                  <div class="add-to-links wish_comp">
                    <ul class="blank list-inline">
                      <li class="wishlist">
                        @csrf
                        <a type="button" data-toggle="tooltip" data-original-title="Thêm / Bỏ yêu thích"
                          class="icon {{$product->hasWishList()}}" data-id="{{$product->id}}"><i
                            class="fa fa-heart"></i>
                        </a>
                      </li>
                      <li class="compare">
                        <a class="icon" data-toggle="tooltip" title="" onclick="compare.add('50');"
                          data-original-title="Compare this Product"><i class="fa fa-exchange"></i>
                        </a>
                      </li>
                    </ul>
                  </div>

                </div>

              </div>
              <!-- end box info product -->
            </div>
          </div>
        </div>
      </div>
      <div class="bototm-detail">
        <div class="row">
          <div class="col-lg-3 col-md-4  col-xs-12">
            <div class="module releate-horizontal">
              <h3 class="modtitle"><span>Sản phẩm liên quan</span></h3>
              <div class="releate-product ">
                <div class="product-item-container">
                  @foreach ($relatedProducts = $product->getRelatedProducts($product->category_id) as $relatedProduct)
                  <div class="item-element clearfix">
                    <div class="image">
                      <img src="thumbnails/{{$relatedProduct->thumbnail}}" title="Teserunt hlitia"
                        class="img-1 img-responsive" />
                    </div>
                    <div class="caption">

                      <div class="ratings">
                        <div class="rating-box">
                          {!!$relatedProduct->getHtmlRate()!!}
                        </div>
                      </div>
                      <h4><a href="{{route('client.products.show', $relatedProduct->id)}}">{{$relatedProduct->name}}</a></h4>
                      <div class="price">
                        <span class="price-new">{{$relatedProduct->price}}</span>
                      </div>

                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-9 col-md-8  col-xs-12">
            <!-- Product Tabs -->
            <div class="producttab ">
              <div class="tabsslider  col-xs-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#tab-1">Mô Tả</a></li>
                  <li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Chi tiết Sản phẩm</a></li>
                  <li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Đánh giá</a></li>
                  <li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Bình luận</a></li>
                </ul>
                <div class="tab-content col-xs-12">
                  <div id="tab-1" class="tab-pane fade active in">
                    {!!$product->description!!}
                  </div>
                  <div id="tab-5" class="tab-pane fade">
                    <h3>Tên sản phẩm: {{$product->name}}</h3>
                    <h4>Danh mục: {{$product->category->name}}</h4>
                    <h4>Thương hiệu: {{$product->brand->name}}</h4>
                    <hr>
                    <h4>Chi tiết: </h4>
                    <table class="data-table table-striped" style="width: 100%;" border="1">
                      <tbody>
                        @foreach ($product->product_details as $detail)
                        <tr>
                          <td width="25%" style="font-weight: 600">{{$detail->type}}</td>
                          <td width="75%">{{$detail->description}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div id="tab-review" class="tab-pane fade">
                    @foreach ($product->reviews as $key => $review)
                    @if (Auth::check())
                      @if ($review->user_id == Auth::user()->id)
                      <div id="user-review">
                        <table class="table table-striped table-bordered">
                          <tbody>
                            <tr>
                              <td style="width: 50%;"><strong id="user_incognito">{{$review->showIncognito()}}</strong>
                              </td>
                              <td class="text-right" id="user_created_at">{{$review->created_at}}</td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <p id="user_description">{{$review->description}}</p>
                                <div class="ratings">
                                  <div class="rating-box" id="user_rating">
                                    {!!$review->getHtmlRate()!!}
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="text-right"></div>
                      </div>
                      @endif
                      @if ( $key > count($product->reviews)-3 && $review->user_id != Auth::user()->id)
                      <div id="review">
                        <table class="table table-striped table-bordered">
                          <tbody>
                            <tr>
                              <td style="width: 50%;"><strong>{{$review->showIncognito()}}</strong></td>
                              <td class="text-right">{{$review->created_at}}</td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <p>{{$review->description}}</p>
                                <div class="ratings">
                                  <div class="rating-box">
                                    {!!$review->getHtmlRate()!!}
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="text-right"></div>
                      </div>
                      @endif
                    @else
                      @if ( $key > count($product->reviews)-3)
                      <div id="review">
                        <table class="table table-striped table-bordered">
                          <tbody>
                            <tr>
                              <td style="width: 50%;"><strong>{{$review->showIncognito()}}</strong></td>
                              <td class="text-right">{{$review->created_at}}</td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <p>{{$review->description}}</p>
                                <div class="ratings">
                                  <div class="rating-box">
                                    {!!$review->getHtmlRate()!!}
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="text-right"></div>
                      </div>
                      @endif
                    @endif
                    @endforeach
                    <div id="user-review">
                    </div>
                    <form id="form-review">
                      @csrf
                      <h2 id="review-title">Viết đánh giá</h2>
                      <div class="contacts-form">
                        <div class="form-group">
                          <label for="">Ẩn danh: </label>
                          <input id="is_incognitro" type="radio" name="is_incognitro" value="1"> &nbsp;
                          <label for="">Công khai: </label>
                          <input checked id="not_incognitro" type="radio" name="is_incognitro" value="0">
                        </div>
                        <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                          <textarea class="form-control" name="description" placeholder="Đánh giá của bạn"></textarea>
                        </div>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : ""}}">
                        <div class="form-group">
                          <b>Đánh giá: </b> <span>Kém</span>&nbsp;
                          <input type="radio" name="rating" value="1"> &nbsp;
                          <input type="radio" name="rating" value="2"> &nbsp;
                          <input type="radio" name="rating" value="3"> &nbsp;
                          <input type="radio" name="rating" value="4"> &nbsp;
                          <input checked type="radio" name="rating" value="5"> &nbsp;<span>Rất tốt</span>
                        </div>
                        <div class="buttons clearfix">
                          <button type="button" id="button-review" class="btn buttonGray">Xác nhận</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div id="tab-4" class="tab-pane fade">
                    <div id="review">
                      @foreach ($product->comments as $comment)
                      <div class="bg-light">
                        <h4 style="margin-bottom: 2px;">{{$comment->user->name}}</h4>
                        <small style="margin-bottom: 22px;">{{$comment->created_at}}</small>
                        <p>{{$comment->description}}</p>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript" src="clients/js/lightslider/lightslider.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    console.log('i am here');
    var zoomCollection = $('.large-image img');
    $( zoomCollection ).elevateZoom({
      zoomType    : "inner",
      lensSize    :"200",
      easing:true,
      gallery:'thumb-slider-vertical',
      cursor: 'pointer',
      galleryActiveClass: "active"
    });
    $('.large-image').magnificPopup({
      items: [
        {src: 'image/demo/shop/product/1.png' },
        {src: 'image/demo/shop/product/f9.jpg' },
        {src: 'image/demo/shop/product/2.png' },
        {src: 'image/demo/shop/product/3.png' },
        {src: 'image/demo/shop/product/j9.jpg' },
      ],
      gallery: { enabled: true, preload: [0,2] },
      type: 'image',
      mainClass: 'mfp-fade',
      callbacks: {
        open: function() {
          
          var activeIndex = parseInt($('#thumb-slider-vertical .img.active').attr('data-index'));
          var magnificPopup = $.magnificPopup.instance;
          magnificPopup.goTo(activeIndex);
        }
      }
    });
    $("#thumb-slider-vertical .owl2-item").each(function() {
      $(this).find("[data-index='0']").addClass('active');
    });
    
    // $('.thumb-video').magnificPopup({
    //   type: 'iframe',
    //   iframe: {
    //   patterns: {
    //      youtube: {
    //       index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
    //       id: 'v=', // String that splits URL in a two parts, second part should be %id%
    //       src: '../../../../www.youtube.com/embed/_25id_25@autoplay=1' // URL that will be set as a source for iframe. 
    //       },
    //     }
    //   }
    // });
    
    $('.product-options li.radio').click(function(){
      $(this).addClass(function() {
        if($(this).hasClass("active")) return "";
        return "active";
      });
      
      $(this).siblings("li").removeClass("active");
      $(this).parent().find('.selected-option').html('<span class="label label-success">'+ $(this).find('img').data('original-title') +'</span>');
    });
    
    var _isMobile = {
      iOS: function() {
       return navigator.userAgent.match(/iPhone/i);
      },
      any: function() {
       return (_isMobile.iOS());
      }
    };
    
    $(".thumb-vertical-outer .next-thumb").click(function () {
      $( ".thumb-vertical-outer .lSNext" ).trigger( "click" );
    });

    $(".thumb-vertical-outer .prev-thumb").click(function () {
      $( ".thumb-vertical-outer .lSPrev" ).trigger( "click" );
    });

    $(".thumb-vertical-outer .thumb-vertical").lightSlider({
      item: 4,
      autoWidth: false,
      vertical:true,
      slideMargin: 7,
      verticalHeight:425,
            pager: false,
      controls: true,
            prevHtml: '<i class="fa fa-chevron-up"></i>',
            nextHtml: '<i class="fa fa-chevron-down"></i>',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            verticalHeight: 330,
            item: 4,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            verticalHeight: 235,
            item: 2,
            slideMargin: 5,
          }
        },
        {
          breakpoint: 768,
          settings: {
            verticalHeight: 340,
            item: 3,
          }
        }
        ,
        {
          breakpoint: 480,
          settings: {
            verticalHeight: 100,
            item: 1,
          }
        }

      ]
        });

    
    // Product detial reviews button
    $(".reviews_button,.write_review_button").click(function (){
      var tabTop = $(".producttab").offset().top;
      $("html, body").animate({ scrollTop:tabTop }, 1000);
    });
  });
</script>
            <!-- //Product Tabs -->
            <!-- Hot Deal -->
            @include('clients.layout.content_components.hot_deals')
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- //Main Container -->
@endsection
@section('js')
<script>
  $('#button-review').click(function () {
    var formData = new FormData($('#form-review')[0]);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
      }
    });
    request = $.ajax({
      url: "{{ route('client.products.addReview') }}",
      method: 'POST',
      processData: false,  // Phải có để gửi file
      contentType: false, // both of two option : is required to submit the file data
      data: formData
    }).done(function(response) {
      console.log(response);
      $('#user-review').html(response.data);
      $([document.documentElement, document.body]).animate({
        scrollTop: $(".producttab").offset().top - 100,
      }, 200);
    });
    request.fail(function(jqXHR, textStatus) {
      console.log("lỗi tè le");
    });
  });
</script>
@endsection