<div class="header-bottom-menu col-md-10 col-sm-9 col-xs-4">
  <div class="responsive so-megamenu  megamenu-style-dev">
    <nav class="navbar-default">
      <div class=" container-megamenu  horizontal">
        <div class="navbar-header">
          <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>	
        </div>
        <div class="megamenu-wrapper ">
          <span id="remove-megamenu" class="fa fa-times"></span>
          <div class="megamenu-pattern">
            <div class="container">
              <ul class="megamenu " data-transition="slide" data-animationtime="250">
                {{-- home --}}
                <li class="home hover">
                <a href="{{ route('client.index') }}">Trang chủ</a>
                </li>
                {{-- categories --}}
                <li class="with-sub-menu hover">
                  <p class="close-menu"></p>
                  <a href="#" class="clearfix">
                    <strong><img src="clients/image/demo/menu/new-icon.png" alt="">Danh mục</strong>
                    <span class="label"></span>
                    <b class="caret"></b>
                  </a>
                  <div class="sub-menu" style="width: 100%; display: none;">
                    <div class="content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-md-3 img img1">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img1.jpg" alt="banner1"></a>
                            </div>
                            <div class="col-md-3 img img2">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img2.jpg" alt="banner2"></a>
                            </div>
                            <div class="col-md-3 img img3">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img3.jpg" alt="banner3"></a>
                            </div>
                            <div class="col-md-3 img img4">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img4.jpg" alt="banner4"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <a href="#" class="title-submenu">Danh mục hot</a>
                          <div class="row">
                            <div class="col-md-12 hover-menu">
                              <div class="menu">
                                <ul>
                                  @foreach ($categories as $cate)
                                <li><a href="{{ route('client.categories.show', $cate->id) }}"  class="main-menu">{{ $cate->name }}</a></li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                {{-- brands --}}
                <li class="with-sub-menu hover">
                  <p class="close-menu"></p>
                  <a href="#" class="clearfix">
                    <strong><img src="clients/image/demo/menu/new-icon.png" alt="">Thương hiệu</strong>
                    <span class="label"></span>
                    <b class="caret"></b>
                  </a>
                  <div class="sub-menu" style="width: 100%; display: none;">
                    <div class="content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-md-3 img img1">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img1.jpg" alt="banner1"></a>
                            </div>
                            <div class="col-md-3 img img2">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img2.jpg" alt="banner2"></a>
                            </div>
                            <div class="col-md-3 img img3">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img3.jpg" alt="banner3"></a>
                            </div>
                            <div class="col-md-3 img img4">
                              <a href="#"><img class="lazyload img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/cms/img4.jpg" alt="banner4"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <a href="#" class="title-submenu">Automotive</a>
                        </div>
                        <div class="col-md-3">
                          <a href="#" class="title-submenu">Electronics</a>
                        </div>
                        <div class="col-md-3">
                          <a href="#" class="title-submenu">Jewelry &amp; Watches</a>
                        </div>
                        <div class="col-md-3">
                          <a href="#" class="title-submenu">Bags, Holiday Supplies</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="">
                  <p class="close-menu"></p>
                  <a href="blog-page.html" class="clearfix">
                    <strong>Blog</strong>
                    <span class="label"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>