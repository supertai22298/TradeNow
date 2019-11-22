<header id="header" class=" variantleft type_10">
  <!-- Header Top -->
  <div class="header-top compact-hidden">
    <div class="container">
      <!-- Language -->
      @include('clients.layout.header_components.language')
      <!-- End Language -->

      <!-- Cart -->
      @include('clients.layout.header_components.cart')
      <!-- End cart -->
      
      <!-- Account -->
      @include('clients.layout.header_components.account')
      <!-- End Account -->
    </div>
  </div>
  <!-- //Header Top --> 
  <!-- Header center -->
  <div class="header-center">
    <div class="container">
      <div class="row">
        <!-- Logo -->
        <div class="navbar-logo col-md-3 col-sm-4 col-xs-12">
          <a href="home10.html"><img src="clients/image/demo/logos/theme_logo_orange.png" title="Your Store" alt="Your Store" /></a>
        </div>
        <!-- //End Logo -->

        <!-- search -->
        @include('clients.layout.header_components.search')
        <!-- End search -->
      </div>
    </div>
  </div>
  <!-- //Header center -->
  <!-- Header Bottom -->
  <div class="header-bottom compact-hidden">
    <div class="container">
    <div class="rows">
      <div class="header-bottom-inner">
        <!-- Account -->
        @include('clients.layout.header_components.category')
        <!-- End Account -->

        <!-- Account -->
        @include('clients.layout.header_components.menu')
        <!-- End Account -->
      </div>
    </div>
    </div>
  </div>
</header>