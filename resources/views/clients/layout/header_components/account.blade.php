<div class="header-top-right collapsed-block col-lg-8 col-sm-12 col-md-7 col-xs-12 ">
    <h5 class="tabBlockTitle visible-xs">More<a class="expander " href="#TabBlock-1"><i class="fa fa-angle-down"></i></a></h5>
    <div class="tabBlock" id="TabBlock-1">
      <ul class="top-link list-inline">
        <li class="account" id="my_account">
          @if (Auth::check())
            <a href="{{route('client.users.profile')}}" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >{{Auth::user()->name}}</span> <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu ">
              <li><a href="{{route('client.users.profile')}}"><i class="fa fa-user"></i> Quản lý tài khoản</a></li>
              <li><a href="{{route('client.users.order')}}"><i class="fa fa-pencil-square-o"></i> Đơn hàng</a></li>
              <li>
                <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Đăng xuất</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>  
              </li>
            </ul>
          @else
            <a href="" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >Tài khoản</span> <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu ">
              <li><a href="{{route('register')}}"><i class="fa fa-user"></i> Đăng ký</a></li>
              <li><a href="{{route('login')}}"><i class="fa fa-pencil-square-o"></i> Đăng nhập</a></li>
            </ul>
          @endif
        </li>
        <li class="wishlist "><a href="wishlist.html" id="wishlist-total" class="top-link-wishlist" title="Wish List (2)"><span>Wish List (2)</span></a></li>
        <li class="checkout hidden"><a href="checkout.html" class="top-link-checkout" title="Checkout"><span >Checkout</span></a></li>
        <li class="login hidden"><a href="cart.html" title="Shopping Cart"><span >Shopping Cart</span></a></li>
        
        <li class="form-group languages-block ">
          <form action="index.html" method="post" enctype="multipart/form-data" id="bt-language">
            <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
              <img src="clients/image/demo/flags/gb.png" alt="English" title="English">
              <span class="">English</span>
              <span class="fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="index.html"><img class="image_flag" src="clients/image/demo/flags/gb.png" alt="English" title="English" /> English </a></li>
              <li> <a href="index.html"> <img class="image_flag" src="clients/image/demo/flags/lb.png" alt="Arabic" title="Arabic" /> Arabic </a> </li>
            </ul>
          </form>
        </li>
        <li class="form-group currency currencies-block">
          <form action="index.html" method="post" enctype="multipart/form-data" id="currency">
            <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
              <span class="icon icon-credit "></span> US Dollar <span class="fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu btn-xs">
              <li> <a href="#">(€)&nbsp;Euro</a></li>
              <li> <a href="#">(£)&nbsp;Pounds	</a></li>
              <li> <a href="#">($)&nbsp;US Dollar	</a></li>
            </ul>
          </form>
        </li>
      </ul>
    </div>
  </div>