<nav class="navbar navbar-inverse" style="border-radius: 0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">iShop Electronics</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            @if(isset($_SESSION) && !empty($_SESSION))
                @if($_SESSION['isAdmin'] == 1)
                    <li><a href="/items">Items</a></li>
                @endif
            @endif
            @if(isset($_SESSION) && !empty($_SESSION))
                @if($_SESSION['isAdmin'] == 1)
                    <li><a href="/admin">Admin</a></li>
                @endif
            @endif
        @if(isset($_SESSION)  && !empty($_SESSION))
            @if($_SESSION['isAdmin'] != 1)
                <li><a href="/view">Products</a></li>
                <li><a href="/showPurchase">Purchase History</a></li>
            @endif
        @endif
        @if(empty($_SESSION))
            <li><a href="/view">Products</a></li>
        @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if(!(isset($_SESSION))  || empty($_SESSION))
            <li><a href="/register">Sign Up</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/shoppingCart">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </a>
            </li>
        @endif
        @if(isset($_SESSION) && !empty($_SESSION))
            @if($_SESSION['isAdmin'] != 1)
                <li><a href="/shoppingCart">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </li>
                <li><a href="/view/profile">View Profile</a></li>
            @endif
            <li><a href="/logout">Logout</a></li>
        @endif
    </ul>
</div>
</nav>