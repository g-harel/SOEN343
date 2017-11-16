@extends('layouts.app')
@section('page-title')
    Profile
@endsection
@section('profile-css')
    {{asset('css/profile.css')}}
@endsection
@section('content')
    <div class="container bootstrap snippet">
        <div class="row ng-scope">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="pv-lg">
                            <img class="center-block img-responsive img-circle img-thumbnail thumb96"
                                 src="https://api.adorable.io/avatars/285/audreyhunt">
                        </div>
                        <h3 class="m0 text-bold">Audrey Hunt</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="h4 text-center">Personal Information</div>
                        <div class="row pv-lg">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                
                                <form class="form-horizontal ng-pristine ng-valid" action="/deleteAccount" method="post" role="form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact1">Name</label>
                                        <div class="col-sm-10"> <input class="form-control" id="inputContact1" type="text" placeholder="" value="Audrey Hunt" readonly></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact2">Email</label>
                                        <div class="col-sm-10"> <input class="form-control" id="inputContact2" type="email" value="mail@example.com" readonly></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact3">Phone</label>
                                        <div class="col-sm-10"> <input class="form-control" id="inputContact3" type="text" value="(123) 465 789" readonly></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputContact3">Address</label>
                                        <div class="col-sm-10">
                                            <pre>7141 Sherbrooke St W(514) 848-2424</pre>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10"> <button class="btn btn-danger" type="submit">Delete My Account</button></div>
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