@extends('layouts.app')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="dist/jquery.masked-input.js"></script>

<script>
    $(document).ready(() => {
        $('.number').keydown((e) => {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $(document).ready(() => {
        $('form').on('submit', (e) => {
        // validation code
            $('#result').text('');
            const email = $('#email').val();
            if (!validateEmail(email)) {
                $('#emailHelp').text(`${email} is not a valid email.`);
                $('#emailHelp').css('color', 'red');
                e.preventDefault();
            }
        });
    });
</script>

<style>
.panel-register {
    border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}

.panel-register input[type="text"],
.panel-register input[type="email"],
.panel-register input[type="password"] {
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

#door_number {
    width: 80px;
    display: inline;
}

#street {
    display: inline;
    width: 340px;
}

#appartment {
    display: inline;
    width: 90px;
}

#city,
#province,
#country {
   width: 170;
   display: inline;
   margin-top: 5px;
}

#phone1,
#phone2,
#phone3 {
   width: 100px;
   display: inline;
}

#postalCode {
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
                                <input type="text" name="door_number" id="door_number" tabindex="1" class="form-control number" placeholder="#" value="" required>

                                <input type="text" name="street" id="street" tabindex="1" class="form-control" placeholder="Street" value="" required>

                                <input type="text" name="appartment" id="appartment" tabindex="1" class="form-control" placeholder="Appt." value="">

                                <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="City" value="" required>

                                <input type="text" name="province" id="province" tabindex="1" class="form-control" placeholder="Province" value="" required>

                                <input type="text" name="country" id="country" tabindex="1" class="form-control" placeholder="Country" value="" required>

                                <input type="text" name="postal_code" id="postal_code" tabindex="1" class="form-control" placeholder="Postal Code" value="" style="margin-top:5px;" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">
                                    Phone number
                                </label><br>
                                <input type="text" name="phone_number" id="phone_number" class="form-control number" data-masked-input="999-999-9999" placeholder="XXX-XXX-XXXX" maxlength="12">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="" value="" required>
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