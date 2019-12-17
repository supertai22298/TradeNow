<div class="module so-deals">
  <h3 class="modtitle"><span>Hot Deals</span></h3>
  <div class="modcontent">
    <div id="so_deals_14513931681482050581" class="so-deal modcontent products-list grid clearfixbutton-type1 style2">
      <div class="extraslider-inner product-layout deal-slider">

        @if ($hotDealProduct)
          @foreach ($hotDealProduct as $item)
          {{-- item --}}
            <div class="product-thumb transition product-item-container">
              <div class="left-block">
                <div class="product-image-container">
                  <div class="image">
                    <span class="label label-sale">Ưu đãi</span>
                    <a class="lt-image" href="{{ route('client.products.show',$item->id) }}" target="_self">
                      <img  class="lazyload img-1 img-responsive" 
                        data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                    data-src="{{ asset('images/'.$item->image) }}" alt="img" title="{{ $item->name }}"/>
                      <img  class="lazyload img-2 img-responsive" 
                        data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                        data-src="{{ asset('images/'.$item->getFirstImage()) }}" alt="img" title="{{ $item->name }}"/>
                    </a>
                    <div class="item-time">
                      <div class="item-timer">
                        <div class="defaultCountdown-30"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="right-block">
                <div class="caption">
                  <div class="rating">
                    {!!$item->getHtmlRate()!!}
                  </div>
                  <h4><a href="{{ route('client.products.show',$item->id) }}" target="_self" title="{{ $item->name }}"> {!! $item->limitDescription(10) !!}</a></h4>
                  <p class="price">
                  <span class="price-new"> {{ $item->getFreshPrice() }}</span><br><span class="price-old"> {{ $item->getFreshPrice() }}</span>
                  </p>							
                </div>	
              </div>
              <!-- End right block -->
            </div>
          @endforeach

        @endif

      </div>
    </div>
      
  </div><!--/.modcontent-->
</div>	
