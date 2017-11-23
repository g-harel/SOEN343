@extends('layouts.app')
@section('page-title')
Registration page
@endsection
@section('login-register-css')
<link rel='stylesheet' href="{{asset('css/login-register.css')}}">
@endsection
<div id="particles-js"></div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if(Session::has('inputErrors'))
                    @foreach(Session::get('inputErrors') as $value)
                        <div class='alert alert-warning'>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>Invalid {{str_replace('-', ' ', $value)}}. Please try again.</p>
                        </div>
                    @endforeach
                @endif
                @if(Session::has('emailExists'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>The email you have entered already exists</p>
                    </div>
                @endif
                <div class="panel panel-register">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="register-form" action="/registerUser" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="first_name">
                                            First name
                                        </label>
                                        <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">
                                            Last name
                                        </label>
                                        <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="door_number">
                                            Home address
                                        </label><br>
                                        <input type="number" name="door_number" id="door_number" tabindex="1" class="form-control number" placeholder="#" value="" required min="1">

                                        <input type="text" name="street" id="street" tabindex="1" class="form-control" placeholder="Street" value="" required>

                                        <input type="number" name="appartment" id="appartment" tabindex="1" class="form-control" placeholder="Appt." value="">

                                        <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="City" value="" required>

                                        <input type="text" name="province" id="province" tabindex="1" class="form-control" placeholder="Province" value="" required>

                                        <input type="text" name="country" id="country" tabindex="1" class="form-control" placeholder="Country" value="" required>

                                        <input type="text" name="postal_code" id="postal_code" tabindex="1" class="form-control" placeholder="Postal Code" value="" style="margin-top:5px;" required>
                                        <small id="postalHelp" class="form-text text-muted"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">
                                            Phone number
                                        </label><br>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control number" placeholder="10 digits only" maxlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            Email
                                        </label>
                                        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="john@example,com" value="" required>
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                            Password
                                        </label>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="" maxlength="16" required>
                                        <small id="passwordHelp" class="form-text text-muted">Maximum 16 characters.</small>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Create your account" required>
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
@section('register-js')
    <script src="{{asset('js/register.js')}}"></script>
@endsection
@section('particle-js')
    <script src="{{asset('js/particle.js')}}"></script>
@endsection
