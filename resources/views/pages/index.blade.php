@extends('layouts.app')
@section('page-title')
    Welcome to Soen 343
@endsection
@section('content')
    <div class='jumbotron text-center'>
        <h1></h1>
        <p>This is our new home page</p>
        <p><a class='btn btn-primary btn-lg' href='/login' role='button'>Login</a> <a class='btn btn-success btn-lg' href='/register' role='button'>Register</a>
    </div>
@endsection