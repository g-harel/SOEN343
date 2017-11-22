@extends('layouts.app')
@section('page-title')
    Welcome to iShop Electronics
@endsection
<div id="particles-js"></div>
@section('content')
    <!-- particles.js container -->
    <div class='custom-jumbo text-center'>
        @if(!empty($accountDeleted))
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            <h5>{{$accountDeleted}}</h5>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        @endif
        <h1>Welcome to iShop Electronics</h1>
            @if(!(isset($_SESSION['currentLoggedInId'])))
        <h4>Please Log in to use the Shopping cart. Otherwise, feel free to browse our products! </h4>
        <p><a class="btn login-btn" href="/login">Login</a>
            <a class="btn register-btn" href="/register">Register</a><br />
            @else
                <h4>Enjoy browsing through our catalog and saving on some great deals! </h4>
            @endif
    </div>
@endsection
@section('particle-js')
    <script src="{{asset('js/particle.js')}}"></script>
@endsection