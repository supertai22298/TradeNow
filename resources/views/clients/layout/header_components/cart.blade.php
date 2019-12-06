<div class="block-cart">
  <div class="block-cart">
    <!--cart-->
    <div class="shopping_cart pull-right">
      <div class=" btn-group btn-shopping-cart">
        <a data-loading-text="Loading..." class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
          <div class="shopcart">
            <span class="handle pull-left"></span>
            <span class="text-shopping-cart hidden-xs">	Giỏ hàng	</span>
            <span id="totalAmount" class="total-shopping-cart cart-total-full">	 0</span>
          </div>
        </a>
        <ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">							
          <li>
            <table class="table table-striped">
              <tbody id="cartDetail">
                {{-- <tr>
                  <td class="text-center" style="width:70px">
                    <a href="product.html"> 
                      <img class="lazyload preview" 
                        data-sizes="auto" 
                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                        data-src="clients/image/demo/shop/product/35.jpg" style="width:70px" alt="Filet Mign" title="Filet Mign"> </a>
                  </td>
                  <td class="text-left"> 
                    <a class="cart_product_name" 
                      href="product.html">Filet Mign
                    </a>
                  </td>
                  <td class="text-center"> x1 </td>
                  <td class="text-center"> $1,202.00 </td>
                  <td class="text-right">
                    <a href="product.html" class="fa fa-edit"></a>
                  </td>
                  <td class="text-right">
                    <a onclick="cart.remove('2');" class="fa fa-times fa-delete"></a>
                  </td>
                </tr>
                <tr>
                  <td class="text-center" style="width:70px">
                    <a href="product.html"> <img class="lazyload preview" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="clients/image/demo/shop/product/141.jpg" style="width:70px" alt="Canon EOS 5D" title="Canon EOS 5D"> </a>
                  </td>
                  <td class="text-left"> <a class="cart_product_name" href="product.html">Canon EOS 5D</a> </td>
                  <td class="text-center"> x1 </td>
                  <td class="text-center"> $60.00 </td>
                  <td class="text-right">
                    <a href="product.html" class="fa fa-edit"></a>
                  </td>
                  <td class="text-right">
                    <a onclick="cart.remove('1');" class="fa fa-times fa-delete"></a>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </li>
          <li>
            <div>
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="text-left"><strong>Tổng giá</strong>
                    </td>
                    <td id="subTotal" class="text-right">0</td>
                  </tr>
                  <tr>
                    <td class="text-left"><strong>Thuế (0%)</strong>
                    </td>
                    <td class="text-right">0</td>
                  </tr>
                  <tr>
                    <td class="text-left"><strong>Tổng thanh toán</strong>
                    </td>
                    <td id="total" class="text-right">0</td>
                  </tr>
                </tbody>
              </table>
              <p class="text-center"> <a class="btn view-cart" href="{{ route('client.cart.view') }}"><i class="fa fa-shopping-cart"></i>Xem giỏ hàng</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="{{ route('client.cart.checkout') }}"><i class="fa fa-share"></i>Thanh toán</a> </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!--//cart-->
  </div>
</div>