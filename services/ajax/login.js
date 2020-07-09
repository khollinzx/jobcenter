$(document).ready(function () {

    function error_alert1(value) {
        $('.errorMessage').html(
            `<div class="alert alert-danger" role="alert"><strong><i class="anticon anticon-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    function error_alert2(value) {
        $('#error2').html(
            `<div class="alert alert-danger" role="alert"><strong><i class="la la-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    $('#loginUserjs').click(function (e) {
        $('#userLoginDetail').validate({
            rules: {
                username: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                username: {
                    required: '<div class="errorCode">Username is Required</div>',
                    email: '<div class="errorCode">valid Email is Required</div>'
                },
                password: '<div class="errorCode">Password is Required</div>',
            },
            submitHandler: loginUser,
        });

        function loginUser() {
            var loginData = $('#userLoginDetail').serialize();
            $.ajax({
                type: 'POST',
                url: 'services/controllers/loginController.php',
                data: loginData,
                dataType: 'json',
                beforeSend: function () {
                    $('#loginUserjs').html('Validating...');
                    $('#loginUserjs').attr('disabled', true);
                },
                success: function (response) {
                    signInProcess(response.value);
                },
            }); // ends create ajax
        }

        function signInProcess(data) {
            var codeNo = '';
            var msgs = '';
            var tokenId = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                tokenId = item.token;
            });
            if (codeNo == "200") {
                $('#loginUserjs').html('Connecting...');
                $('#loginUserjs').attr('disabled', false);
                localStorage.setItem('token', tokenId);
                window.location.href = "users/?pg=home";

            } else if (codeNo == "400") {
                $('#loginUserjs').html('Sign in');
                $('#loginUserjs').attr('disabled', false);
                error_alert1(msgs);
            } else if (codeNo == "404") {
                $('#loginUserjs').html('Sign in');
                $('#loginUserjs').attr('disabled', false);
                error_alert1(msgs);
            }
        }
    });



    $('#signUpUserJs').click(function (e) {
        $('#userSignUpDetail').validate({
            rules: {
                firstName: {
                    required: true,
                },
                lastName: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                country: {
                    required: true,
                },
                phoneNumber: {
                    required: true,
                },
                newpassword: {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                firstName: '<div class="errorCode">First Name is Required</div>',
                lastName: '<div class="errorCode">Last Name is Required</div>',
                email: {
                    required: '<div class="errorCode">Email Required</div>',
                    email: '<div class="errorCode">Valid Email Required</div>',
                },
                country: '<div class="errorCode">Country is Required</div>',
                phoneNumber: '<div class="errorCode">Mobile Number is Required</div>',
                newpassword: {
                    required: '<div class="errorCode">Password is Required</div>',
                    minlength: jQuery.validator.format('<div class="errorCode ">At least {0} characters required!</div>')
                },
            },
            submitHandler: signUpUser,
        });

        function signUpUser() {
            var data = $('#userSignUpDetail').serialize();

            $.ajax({
                type: 'POST',
                url: 'services/controllers/signUpController.php',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $('#signUpUserJs').html('validating....');
                    $('#signUpUserJs').attr('disabled', true);
                },
                success: function (response) {
                    signUpProcess(response.value);
                },
            }); // signUp Ajax Ends
        } // ends signup function

        function signUpProcess(data) {
            var codeNo = '';
            var msgs = '';
            var tokenId = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                tokenId = item.token;
            });
            if (codeNo == "200") {
                $('#signUpUserJs').html('Get Started');
                $('#signUpUserJs').attr('disabled', false);
                localStorage.setItem('token', tokenId);
                window.location.href = "users/?pg=home";

            } else if (codeNo == "400") {
                $('#signUpUserJs').html('Get Started');
                $('#signUpUserJs').attr('disabled', false);
                error_alert2(msgs);
            } else if (codeNo == "404") {
                $('#signUpUserJs').html('Get Started');
                $('#signUpUserJs').attr('disabled', false);
                error_alert2(msgs);
            }
        }
    }); //onClick function ends


});