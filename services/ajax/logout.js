$(document).ready(function () {
    $('.logout').on('click', function () {
        // alert("logout");
        $.ajax({
            type: 'POST',
            url: '../services/controllers/logout.php',
            dataType: 'json',
            success: function (response) {
                if (response.success == 'true') {
                    localStorage.clear();
                    window.location.href = `../`;
                }
            }
        });
    });
});