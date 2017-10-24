@extends('layouts.app')

@section('content')
   <style>
.panel-register {
    border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}

.panel-register input[type="text"],.panel-register input[type="email"],.panel-register input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-register input:hover,
.panel-register input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-register {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
       
#door_number{
    width: 80px;
    display: inline;
}    
       
#street{
   display: inline;
   width: 340px;

}       
#appartment{
    display: inline;
   width: 90px;
}
       
#city, #province, #country{
   width: 170;
   display: inline;
   margin-top: 5px;
}
#phone1,#phone2,#phone3{
   width: 100px;
   display: inline;
}
#postalCode{
    margin-top: 5px;
    width: auto;
}
       
</style>
@section('content')
<div class="container">
<h1 class="text-center">{{$title}}</h1>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-register">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="register-form" action="registerVerification" method="post" role="form" style="display: block;">
                            
                            <div class="form-group">
                                <label for="firstName">
                                    First name
                                </label>
                                <input type="text" name="firstName" id="firstName" tabindex="1" class="form-control" placeholder="" value="" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="lastName">
                                    Last name
                                </label>
                                <input type="text" name="lastName" id="lastName" tabindex="1" class="form-control" placeholder="" value="" required>
                            </div>

                            <div class="form-group">
                                 <label for="door_number">
                                    Home address
                                </label><br>
                                <input type="text" name="door_number" id="door_number" tabindex="1" class="form-control" placeholder="#" value="" required>
                                
                                <input type="text" name="street" id="street" tabindex="1" class="form-control" placeholder="Street" value="" required>
                                
                                <input type="text" name="appartment" id="appartment" tabindex="1" class="form-control" placeholder="Appt." value="">
                                
                                <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="City" value="" required>
                                
                                <input type="text" name="province" id="province" tabindex="1" class="form-control" placeholder="Province" value="" required>
                                
                                <input type="text" name="country" id="country" tabindex="1" class="form-control" placeholder="Country" value="" required>
                                
                                <input type="text" name="postalCode" id="postalCode" tabindex="1" class="form-control" placeholder="Postal Code" value="" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">
                                    Phone number
                                </label><br>
                                <input type="text" name="phone1" id="phone1" tabindex="1" class="form-control" placeholder="" value="" maxlength="3" required>-
                                <input type="text" name="phone2" id="phone2" tabindex="1" class="form-control" placeholder="" value="" maxlength="3" required>-
                                <input type="text" name="phone3" id="phone3" tabindex="1" class="form-control" placeholder="" value="" maxlength="4" required>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="" value="" required>
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