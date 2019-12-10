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
    <div id="so_category_slider_home2" class="container-slider module  item-1">
      <div class="page-top">
        <h3 class="modtitle">
          <span>	Mobile &amp; Tablet </span>
        </h3>
        <div class="item-sub-cat">
          <ul>
            <li>
              <a href="category.html" title="Tange manue" target="_self">	Tange manue	</a>
            </li>
            <li>
              <a href="category-v2.html" title="Punge nenune" target="_self">	Punge nenune </a>
            </li>
            <li>
              <a href="category-v3.html" title="Hanet magente" target="_self"> Hanet magente </a>
            </li>
          </ul>
        </div>
      </div> <!-- /.page-top -->
      <!-- /.item-cat-image -->
      <div class="item-cat-image">
        <a href="#" title="Banner"><img class="lazyload" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/banner/img-cat-3.png" alt="Banner"></a>      			
      </div> 
      <!-- /.item-cat-image -->
      <div class="modcontent">
        <div class="categoryslider-content products-list s grid show preset01-4 preset02-3 preset03-2 preset04-2 preset05-1">
          <div class="slider so-category-slider not-js product-layout">
            <div class="item product-layout">
              <div class="item-inner product-thumb transition product-item-container">
                <div class="left-block">
                  <div class="product-image-container second_img">
                    <div class="image">
                      <span class="label label-sale">Sale</span>
                      <span class="label label-new">New</span>
                      <a class="lt-image" href="product.html" target="_self" title="Juren tima chukam">
                        <img class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e11.jpg" alt="Juren tima chukam">
                        <img class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e12.jpg" alt="Juren tima chukam">
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
                      <a href="product.html" title="Juren tima chukam" target="_self">Tilam Makar Loring</a>
                    </h4>
                    <p class="price">
                      <span class="price-new">$367.00</span> <span class="price-old">$400.00</span>
                    </p>
                  </div>
                </div>
                <div class="button-group">
                  <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                  <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                  <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                  <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                </div>
              </div> 
            </div>
            <div class="item product-layout">
              <div class="item-inner product-thumb transition product-item-container">
                <div class="left-block">
                  <div class="product-image-container second_img">
                    <div class="image">
                      <span class="label label-sale">Sale</span>
                      <a class="lt-image" href="product.html" target="_self" title="Juren tima chukam">
                          <img class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/h1.jpg" alt="Juren tima chukam">
                          <img class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/h2.jpg" alt="Juren tima chukam">
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
                      <a href="product.html" title="Juren tima chukam" target="_self">Furen Olam Mascha</a>
                    </h4>
                    <p class="price">
                      <span class="price-new">$267.00</span> <span class="price-old">$300.00</span>
                    </p>
                  </div>
                </div>
                <div class="button-group">
                  <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                  <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                  <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                  <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                </div>
              </div> 
            </div>
            <div class="item product-layout">
              <div class="item-inner product-thumb transition product-item-container">
                <div class="left-block">
                  <div class="product-image-container second_img">
                    <div class="image">
                      <span class="label label-sale">Sale</span>
                      <span class="label label-new">New</span>
                      <a class="lt-image" href="product.html" target="_self" title="Juren tima chukam">
                          <img class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/f13.jpg" alt="Juren tima chukam">
                          <img class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/f14.jpg" alt="Juren tima chukam">
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
                      <a href="product.html" title="Juren tima chukam" target="_self">Lorem Anna Oziea</a>
                    </h4>
                    <p class="price">
                      <span class="price-new">$150.00</span> <span class="price-old">$182.00</span>
                    </p>
                  </div>
                </div>
                <div class="button-group">
                  <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                  <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                  <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                  <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                </div>
              </div> 
            </div>
            <div class="item product-layout">
              <div class="item-inner product-thumb transition product-item-container">
                <div class="left-block">
                  <div class="product-image-container second_img">
                    <div class="image">
                      <span class="label label-sale">Sale</span>
                      <a class="lt-image" href="product.html" target="_self" title="Juren tima chukam">
                          <img class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e3.jpg" alt="Juren tima chukam">
                          <img class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e4.jpg" alt="Juren tima chukam">
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
                      <a href="product.html" title="Juren tima chukam" target="_self">Juren tima chukam</a>
                    </h4>
                    <p class="price">
                      <span class="price-new">170.00</span> <span class="price-old">220.00</span>
                    </p>
                  </div>
                </div>
                <div class="button-group">
                  <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                  <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                  <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                  <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                </div>
              </div> 
            </div>
            <div class="item product-layout">
              <div class="item-inner product-thumb transition product-item-container">
                <div class="left-block">
                  <div class="product-image-container second_img">
                    <div class="image">
                      <span class="label label-sale">Sale</span>
                      <a class="lt-image" href="product.html" target="_self" title="Juren tima chukam">
                          <img class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e1.jpg" alt="Juren tima chukam">
                          <img class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/e2.jpg" alt="Juren tima chukam">
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
                      <a href="product.html" title="Juren tima chukam" target="_self">Chukam kuren tima </a>
                    </h4>
                    <p class="price">
                      <span class="price-new">$167.00</span> <span class="price-old">$200.00</span>
                    </p>
                  </div>
                </div>
                <div class="button-group">
                  <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                  <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                  <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                  <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                </div>
              </div> 
            </div>
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