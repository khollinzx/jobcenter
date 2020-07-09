$(document).ready(function () {
    image_loaded();

    function error_alert(value, type) {
        $('#msg').html(
            `<div class="alert alert-${type}" role="alert"><strong><i class="la la-warning"></i></strong>&ensp;${value}</div>`
        );
    }

    function image_loaded() {
        $(document).on('change', '#img_file', function () {
            var property = document.getElementById('img_file').files[0];
            var image_name = property.name;
            var image_extension = image_name.split('.').pop().toLowerCase();
            if ($.inArray(image_extension, ['png', 'jpg', 'jpeg']) === -1) {
                error_alert("Invalid Image Format Selected", "danger");
            }
            var form_data = new FormData();
            var tokenStored = localStorage.getItem('token');
            form_data.append('img_file', property);

            $.ajax({
                url: '../services/controllers/imageloader.php',
                method: 'POST',
                data: form_data,
                headers: {
                    Authorization: tokenStored,
                },
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    error_alert("Uploading Image...", "warning");
                },
                success: function (response) {
                    uploadImage(response.value);
                },
            });

            function uploadImage(data) {
                var codeNo = '';
                var msgs = '';
                var tokenId = '';
                $.each(data, function (key, item) {
                    codeNo = item.code;
                    msgs = item.msgs;
                    tokenId = item.token;
                });
                if (codeNo == "200") {
                    error_alert("", "");
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Image Updated',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    window.location.href = "?pg=home";

                } else if (codeNo == "400") {
                    $('#updateSettings').html('Save Update');
                    $('#updateSettings').attr('disabled', false);
                    error_alert(msgs, "danger");
                } else if (codeNo == "404") {
                    $('#updateSettings').html('Save Update');
                    $('#updateSettings').attr('disabled', false);
                    error_alert(msgs, "danger");
                }
            }
        });
    }
});