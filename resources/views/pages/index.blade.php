@extends('layouts.app')
@section('page-title')
    Welcome to iShop Electronics
@endsection
<div id="particles-js"></div>
@section('content')
    <!-- particles.js container -->
    <div class='custom-jumbo text-center'>
        <h1>Welcome to iShop Electronics</h1>
        <h4>Please Log in to use the Shopping cart. Otherwise, feel free to browse our products! </h4>
        <p><a class="btn login-btn" href="/login">Login</a>
            <a class="btn register-btn" href="/register">Register</a>
    </div>
@endsection