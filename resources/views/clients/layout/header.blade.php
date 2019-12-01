<header id="header" class=" variantleft type_3">
  <!-- Header Top -->
  <div class="header-top compact-hidden">
    <div class="container">
      <div class="row">
        {{-- messages --}}
        @include('clients.layout.header_components.messages')
        {{-- account and .... --}}
        @include('clients.layout.header_components.account')
      </div>
    </div>
  </div>
  <!-- //Header Top -->
  <!-- Header center -->
  <div class="header-center">
    <div class="container">
      <div class="row">
        <!-- Search -->
        @include('clients.layout.header_components.search')
        <!-- //end Search -->
        <!-- Logo -->
        <div class="navbar-logo col-sm-4 col-xs-12 text-center">
          <a href="home3.html">
            <span 
              style="font-size: 2.5em;
              font-weight: 900;
              color: #07779a;
              text-transform: uppercase;">
              Trade 
            </span>
            <span
              style="font-size: 2.5em;
              font-weight: 900;
              color: #F4A137;
              text-transform: uppercase;">
              Now
            </span>
          </a>
        </div>
        <!-- //End Logo -->
        <!-- Phone -->
        <div class="header-center-right col-sm-4">
          <div class="hidden-xs">
            <div class="phone-contact hidden-xs">
              <div class="inner-info">
                <h2>Hotline:</h2><p>(+84) 123 - 456 - 789</p>
              </div>
            </div>					
          </div>
        </div>
        <!-- //End Phone -->
      </div>
    </div>
  </div>
  <!-- //Header center -->
  <!-- Header Bottom -->
  <div class="header-bottom compact-hidden">
    <div class="container">
    <div class="header-bottom-inner">
      <div class="row">
        {{-- menu --}}
        @include('clients.layout.header_components.menu')
        <!-- Cart Pro-->
        @include('clients.layout.header_components.cart')
        <!-- //End Cart Pro -->
      </div>
    </div>
    </div>
  </div>
</header>