<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">{{config('app.name', 'soen343')}}</a>
    </div>
    <ul class="nav navbar-nav">
      {{--@if(!empty($session))--}}
        {{--{{ gettype($session) }}--}}
      {{--@endif--}}
      @if(!empty($session))
        {{ '<pre>' }}
      {{ $session['isAdmin'] }}

      @endif
      @if(!empty($isAdmin))

        {{ $isAdmin  }}
      @endif
      {{--{{ die }}--}}
      {{--@foreach($session as $s)--}}
        {{----}}

      {{--@endforeach--}}
      <li><a href="/">Home</a></li>
      <li><a href="/about">About </a></li>
      @if(!empty($session))
        @if($session['isAdmin'] == 1)
          <li><a href="/items">Items</a></li>
        @endif
      @endif

      @if(!empty($session))
        @if($session['isAdmin'] != 1)
          <li><a href="/view">Products</a></li>
        @endif
      @endif

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/register">Sign Up</a></li>
      <li><a href="/login">Login</a></li>


      @if(!empty($session))
        @if($session['isAdmin'] != 1)
          <li><a href="/shoppingCart">
              <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
          </li>
        @endif
      @endif

    </ul>
  </div>
</nav>