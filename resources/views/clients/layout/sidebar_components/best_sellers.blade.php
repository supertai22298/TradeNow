<div class="moduletable module best-seller clearfix">
  <h3 class="modtitle"><span>Sản phẩm bán chạy</span></h3>
  <div id="sp_extra_slider_20796849091482058205" class="so-extraslider">
    <div class="extraslider-inner best-seller-slider">
      <div class="item ">
        <div class="item-wrap style1">
          @for ($i = 0; $i < $bestSales->count() / 2; $i++)
            <div class="item-wrap-inner media">
              <div class="media-left">
                <div class="item-image">
                  <div class="item-img-info">
                  <a href="{{ route('client.products.show', $bestSales[$i]->id) }}" class="lt-image" target="_self" 
                      title="{{ $bestSales[$i]->name}}">
                    <img  class="lazyload img-1 img-responsive" data-sizes="auto" 
                      src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                      data-src="{{ asset('images/'.$bestSales[$i]->image)}}" alt="img" title="{{ $bestSales[$i]->name}}"/>
                    <img  class="lazyload img-2 img-responsive" data-sizes="auto" 
                      src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                  data-src="{{ asset('images/'.$bestSales[$i]->getFirstImage())}}" alt="img" title="{{ $bestSales[$i]->name}}"/>
                  </a>
                  </div>
                </div>
              </div>
              <div class="media-body">
                <div class="item-info">
                  <div class="rating">
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  </div>
                  <div class="item-title">
                    <a href="{{ route('client.products.show', $bestSales[$i]->id) }}" target="_self" 
                      title="{{ $bestSales[$i]->name}}">
                      {{ $bestSales[$i]->name }}												
                    </a>
                  </div>
                  <!-- Begin item-content -->
                  <div class="item-content">
                    <div class="content_price">
                      <span class="price product-price">
                        {{ $bestSales[$i]->getFreshPrice() }}
                      </span>
                    </div>
                  </div>
                  <!-- End item-content -->
                </div>
              </div><!-- End item-info -->
            </div>
          @endfor
          <!-- End item-wrap-inner -->
        </div>
        <!-- End item-wrap -->													
      </div>
      <div class="item ">
        @for ($i = $bestSales->count() / 2; $i < $bestSales->count(); $i++)
        <div class="item-wrap style1">
          <div class="item-wrap-inner media">
            <div class="media-left">
              <div class="item-image">
                <div class="item-img-info">
                <a href="{{ route('client.products.show', $bestSales[$i]->id) }}" class="lt-image" target="_self" title="Bikum masen dumas">
                <img  class="lazyload img-1 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('images/'.$bestSales[$i]->image)}}" alt="img" title="{{ $bestSales[$i]->name}}"/>
                  <img  class="lazyload img-2 img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('images/'.$bestSales[$i]->getFirstImage())}}" alt="img" title="{{ $bestSales[$i]->name}}" />
                </a>
                </div>
              </div>
            </div>
            <div class="media-body">
              <div class="item-info">
                <div class="rating">
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                </div>
                <div class="item-title">
                  <a href="{{ route('client.products.show', $bestSales[$i]->id) }}" target="_self" title="Bikum masen dumas">
                    {{ $bestSales[$i]->name }}						
                  </a>
                </div>
                <!-- Begin item-content -->
                <div class="item-content">
                  <div class="content_price">
                    <span class="price product-price">
                      {{ $bestSales[$i]->getFreshPrice() }}
                    </span>
                  </div>
                </div>
                <!-- End item-content -->
              </div>
            </div><!-- End item-info -->
          </div>
          <!-- End item-wrap-inner -->
        </div>			
        @endfor									
      </div>
    </div>
  </div>
</div>