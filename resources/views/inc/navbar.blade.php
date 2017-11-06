<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">{{config('app.name', 'soen343')}}</a>
    </div>
    <ul class="nav navbar-nav">

      <li><a href="/">Home</a></li>
      <li><a href="/about">About </a></li>
      
      @if(isset($_SESSION))
        @if($_SESSION['isAdmin'] == 1)
          <li><a href="/items">Items</a></li>
        @endif
      @endif
      @if(isset($_SESSION))
        @if($_SESSION['isAdmin'] != 1)
          <li><a href="/view">Products</a></li>
        @endif
      @endif

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/register">Sign Up</a></li>
      <li><a href="/login">Login</a></li>


      @if(isset($_SESSION))
        @if($_SESSION['isAdmin'] != 1)
          <li><a href="/shoppingCart">
              <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
          </li>
        @endif
      @endif
      <li><a href="">asdsd</a></li>

    </ul>
  </div>
</nav>