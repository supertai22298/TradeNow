<div class="module so-deals">
  <h3 class="modtitle"><span>Hot Deals</span></h3>
  <div class="modcontent">
    <div id="so_deals_14513931681482050581" class="so-deal modcontent products-list grid clearfixbutton-type1 style2">
      <div class="slider so-category-slider not-js product-layout ">
        @if ($hotDealProduct)
        @foreach ($hotDealProduct as $item)
        <div class="item product-layout">
          <div class="item-inner product-thumb transition product-item-container">
            <div class="left-block">
              <div class="product-image-container second_img">
                <div class="image">
                  <span class="label label-sale">Ưu đãi</span>
                  <span class="label label-new">Mới</span>
                  <a class="lt-image" href="{{ route('client.products.show',$item->id) }}" target="_self"
                    title="{{ $item->name }}">
                    <img class="lazyload img-1 img-responsive" data-sizes="auto"
                      src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                      data-src="{{ asset('images/'.$item->image) }}" alt="{{ $item->name }}">
                    <img class="lazyload img-2 img-responsive" data-sizes="auto"
                      src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                      data-src="{{ asset('images/'.$item->getFirstImage()) }}" alt="{{ $item->name }}">
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
                <h4 class="item-title">
                  <a href="{{ route('client.products.show',$item->id) }}" title="{{ $item->name }}"
                    target="_self">{{ str_limit($item->name,20,'...') }}</a>
                </h4>
                <p class="price">
                  <span class="price-new">{{ $item->getFreshPrice() }}</span><br> <span
                    class="price-old">{{ $item->getFreshPrice() }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>

  </div>
  <!--/.modcontent-->
</div>