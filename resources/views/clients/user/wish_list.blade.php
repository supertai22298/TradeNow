@extends('clients.layout.master')
@section('title')
  Danh sách yêu thích
@endsection
@section('content')
  @include('clients.user.profile_sidebar')
  @csrf
  <div class="col-sm-9" style="margin-bottom: 25px;">
    <h1>Danh sách các sản phẩm yêu thích</h1>
    <hr>
    <div id="wish-container">
        @foreach ($wish_lists as $wish_list)
        <div class="products-list row" style="border-bottom: 1px solid gray; padding-bottom: 10px; margin-bottom: 10px;">
          <div class="col-md-12">
            <div class="product-layout col-md-3 col-sm-3 col-xs-12">
              <div class="product-item-container">
                <div class="left-block">
                  <div class="product-image-container lazy second_img  lazy-loaded">
                    <img src="thumbnails/{{$wish_list->product->thumbnail}}" class="img-1 img-responsive">
                    <img src="thumbnails/{{$wish_list->product->getFirstThumbnail()}}" class="img-2 img-responsive">
                  </div>
                </div>
                <div class="button-group row">
                  <button class="col-md-4 btn btn-default removeToWishList" data-id="{{$wish_list->product_id}}" type="button"  title="Bỏ yêu thích"><i class="fa fa-heart"></i></button>
                  <button class="col-md-4 btn btn-default" type="button"  title="Thêm vào giỏ hàng" ><i class="fa fa-shopping-cart"></i></button>
                  <button class="col-md-4 btn btn-default" type="button"  title="So sánh với.." ><i class="fa fa-exchange"></i></button>
                </div>
              </div>
            </div>
            <div class="product-layout col-md-9 col-sm-9 col-xs-12" style="padding-top: 20px;">
              <div class="product-item-container">
                <div class="right-block">
                  <div class="caption">
                    <h2><a href="{{route('client.products.show',$wish_list->product_id)}}">{{ $wish_list->product->name }}</a></h2>		
                    <div class="ratings">
                      <div class="rating-box">
                        @for ($i = 0; $i < 5; $i++)
                          <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                        @endfor
                      </div>
                    </div>
                              
                    <div class="price">
                      <span class="price-new">{{ $wish_list->product->formatMoney($wish_list->product->price) }}</span> 
                      <span class="price-old">{{$wish_list->product->getFreshPrice()}}</span>		 
                    </div>
                    <div class="description item-desc">
                      {!! str_limit($wish_list->product->description, 300, '<span>...</span>') !!}
                    </div>
                  </div>
                </div><!-- right block -->
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    
  </div>
@endsection
@section('id-active')home @endsection
@section('js')
<script>
  $(document).ready(function(){
    $('.side-option').removeClass('active');
    $('#wish-list').addClass('active');
  });
</script>
@endsection