@extends('layouts.app')
@section('page-title')
    Welcome to iShop Electronics
@endsection
@section('content')
    <div class='jumbotron text-center'>
        <h1>Welcome to iShop Electronics</h1>
        <p>Please Log in to use the Shopping cart. Otherwise, feel free to browse out products! </p>
        <p><a class='btn btn-primary btn-lg' href='/login' role='button'>Login</a> <a class='btn btn-success btn-lg' href='/register' role='button'>Register</a>
    </div>
@endsection