@extends('layouts.app')
@section('page-title')
    Login page
@endsection
@section('login-register-css')
    <link rel='stylesheet' href="{{asset('css/login-register.css')}}">
@endsection
<div id="particles-js"></div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if(Session::has('loginError'))
                    <div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>Password or email is incorrect. Please try again or <a href="/register">register</a> a
                            new account.</p>
                    </div>
                @endif
                @if(isset($registrationSuccess) && $registrationSuccess==true)
                    <div class="row">
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>Registration successful! You can now login.</p>
                        </div>
                    </div>
                @endif
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="active" id="login-form-link">Please log in here!</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="admin-form" action="/login/verify" method="post" role="form"
                                      style="display: block;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1"
                                               class="form-control" placeholder="Email" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2"
                                               class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                       class="form-control btn btn-login" value="Log In" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('particle-js')
    <script src="{{asset('js/particle.js')}}"></script>
@endsection

