<?//session start
session_start();?>
{{--<head>--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
  {{--</head>--}}
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">{{config('app.name', 'soen343')}}</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/items">Items</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/register">Sign Up</a></li>
      <li><a href="/login">Login</a></li>
      <li><a href="/shoppingCart">
          <span class="glyphicon glyphicon-shopping-cart"></span>
        </a></li>
    </ul>
  </div>
</nav>