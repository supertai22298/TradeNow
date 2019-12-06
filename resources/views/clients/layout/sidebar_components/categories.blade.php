<div class="responsive so-megamenu megamenu-style-dev">
  <div class="so-vertical-menu no-gutter compact-hidden">
    <nav class="navbar-default">	
      <div class="container-megamenu vertical open">
        <div id="menuHeading">
          <div class="megamenuToogle-wrapper">
            <div class="megamenuToogle-pattern">
              <div class="container">
                <div>
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
                Danh mục							
                <i class="fa pull-right arrow-circle fa-chevron-circle-up"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar-header">
          <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
            <span class="icon-bar" style="width: 12px"></span>
            <span class="icon-bar" style="width: 16px"></span>
            <span class="icon-bar"></span>
          </button>	
        </div>
        <div class="vertical-wrapper" >
          <span id="remove-verticalmenu" class="fa fa-times"></span>
          <div class="megamenu-pattern">
            <div class="container">
              <ul class="megamenu">
                @if ($categories)
                  @foreach ($categories as $cate)
                    <li class="item-vertical">
                      <p class="close-menu"></p>
                      <a href="#" class="clearfix">
                        <strong>
                        <span>{{ $cate->name }}</span>
                        </strong>
                      </a>
                    </li>
                  @endforeach
                @endif
                </ul>
              </div>
            </div>
          </div>
      </div>
    </nav>
  </div>
</div>