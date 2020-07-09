$(document).ready(function () {

    // function to display error encountered at change Password function
    function error_alert(value) {
        $('#error').html(
            `<div class="alert alert-danger" role="alert"><strong><i class="la la-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    function error_alert2(value) {
        $('#error2').html(
            `<div class="alert alert-danger" role="alert"><strong><i class="la la-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    $('#updateSettings').click(function () {
        // alert("yeah");
        saveProfile();

        function saveProfile() {
            var tokenStored = localStorage.getItem('token');
            var data = $('#profileDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/updateProfile.php',
                data: data,
                headers: {
                    Authorization: tokenStored,
                },
                beforeSend: function () {
                    $('#updateSettings').serialize()
                    $('#updateSettings').html('Validating...');
                    $('#updateSettings').attr('disabled', true);
                },
                success: function (response) {
                    updateProfile(response.value);
                },
            });
        }

        function updateProfile(data) {
            var codeNo = '';
            var msgs = '';
            var tokenId = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                tokenId = item.token;
            });
            if (codeNo == "200") {
                $('#updateSettings').html('Save Update');
                $('#updateSettings').attr('disabled', false);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Profile Updated',
                    showConfirmButton: false,
                    timer: 2500,
                });
                window.location.href = "?pg=home";

            } else if (codeNo == "400") {
                $('#updateSettings').html('Save Update');
                $('#updateSettings').attr('disabled', false);
                error_alert2(msgs);
            } else if (codeNo == "404") {
                $('#updateSettings').html('Save Update');
                $('#updateSettings').attr('disabled', false);
                error_alert2(msgs);
            }
        }
    });

    $('#changePassword').click(function () {
        // alert("yeah");
        saveChanges();

        function saveChanges() {
            var tokenStored = localStorage.getItem('token');
            var data = $('#passwordDetails').serialize();
            $.ajax({
                type: 'POST',
                url: '../services/controllers/changePassword.php',
                data: data,
                headers: {
                    Authorization: tokenStored,
                },
                beforeSend: function () {
                    $('#changePassword').serialize()
                    $('#changePassword').html('Validating...');
                    $('#changePassword').attr('disabled', true);
                },
                success: function (response) {
                    updateChanges(response.value);
                },
            });
        }

        function updateChanges(data) {
            var codeNo = '';
            var msgs = '';
            var tokenId = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                tokenId = item.token;
            });
            if (codeNo == "200") {
                $('#changePassword').html('Change Password');
                $('#changePassword').attr('disabled', false);
                localStorage.clear();
                window.location.href = "../../";

            } else if (codeNo == "400") {
                $('#changePassword').html('Change Password');
                $('#changePassword').attr('disabled', false);
                error_alert(msgs);
            } else if (codeNo == "404") {
                $('#changePassword').html('Change Password');
                $('#changePassword').attr('disabled', false);
                error_alert(msgs);
            }
        }
    });

    $('.deactiveAccount').on('click', function () {
        var tokenStored = localStorage.getItem('token');
        $.ajax({
            type: 'POST',
            url: '../services/controllers/deactiveAccount.php',
            cache: false,
            headers: {
                Authorization: tokenStored,
            },
            success: function (response) {

                deactiveAccount(response.value);
            }
        });

        function deactiveAccount(data) {
            var codeNo = '';
            var msgs = '';
            var tokenId = '';
            $.each(data, function (key, item) {
                codeNo = item.code;
                msgs = item.msgs;
                tokenId = item.token;
            });
            if (codeNo == "200") {
                localStorage.clear();
                window.location.href = "../";

            }
        }
    });


});