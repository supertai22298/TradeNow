@extends('clients.layout.master')
@section('title')
  TradeNow
@endsection
@section('content')
  @include('clients.layout.sidebar')
  <div class="col-md-9 col-sm-8 col-xs-12">
    <!-- Mod Slider Home -->
    @include('clients.layout.content_components.slider')
    <!-- //End Mod -->
    <!-- Content -->
    {{-- hot deals --}}
    @include('clients.layout.content_components.hot_deals')
    {{-- content --}}
    @csrf
    <div id="so_category_slider_home2" class="container-slider module  item-1">
      <div class="page-top">
        <h3 class="modtitle">
          <span>	Mobile &amp; Tablet </span>
        </h3>
      </div> <!-- /.page-top -->
      <!-- /.item-cat-image -->
      <div class="item-cat-image">
        <a href="#" title="Banner">
          <img class="lazyload" data-sizes="auto" 
            src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
            data-src="clients/image/demo/banner/img-cat-3.png" alt="Banner">
        </a>      			
      </div> 
      <!-- /.item-cat-image -->
      <div class="modcontent">
        <div class="categoryslider-content products-list s grid show preset01-4 preset02-3 preset03-2 preset04-2 preset05-1">
          <div class="slider so-category-slider not-js product-layout">
            @if ($randomProducts)
              @foreach ($randomProducts as $item)
                <div class="item product-layout">
                  <div class="item-inner product-thumb transition product-item-container">
                    <div class="left-block">
                      <div class="product-image-container second_img">
                        <div class="image">
                          <span class="label label-sale">Ưu đãi</span>
                          <span class="label label-new">Mới</span>
                          <a class="lt-image" href="{{ route('client.products.show',$item->id) }}" target="_self" title="{{ $item->name }}">
                            <img class="lazyload img-1 img-responsive" 
                              data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                              data-src="{{ asset('images/'.$item->image) }}" alt="{{ $item->name }}">
                            <img class="lazyload img-2 img-responsive" 
                            data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                            data-src="{{ asset('images/'.$item->getFirstImage()) }}" alt="{{ $item->name }}">
                          </a>
                        </div> 
                      </div>
                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <div class="rating">
                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                        </div> 
                        <h4 class="item-title">
                          <a href="{{ route('client.products.show',$item->id) }}" title="{{ $item->name }}" target="_self">{{ $item->name }}</a>
                        </h4>
                        <p class="price">
                          <span class="price-new">{{ $item->getFreshPrice() }}</span> <span class="price-old">{{ $item->getFreshPrice() }}</span>
                        </p>
                      </div>
                    </div>
                    <div class="button-group">
                    @if (Auth::check())
                      <button class="wishlist btn-button {{$item->hasWishList()}}" data-id="{{$item->id}}" type="button" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart"></i></button>
                    @endif

                    <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" data-id="{{ $item->id }}"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                      <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                    </div>
                  </div> 
                </div>
              @endforeach
            @endif
          </div> 
        </div>
      </div>
    </div>
    <!-- end Content -->
  </div>
@endsection
@section('js')
    <script>
      $(document).ready(function () {
        @if(session('success'))
          alert("{{ session('success') }}")
        @endif
        @if(session('script'))
          {{ session('script')}}
        @endif
      });
    </script>
@endsection
@section('id-active')home @endsection