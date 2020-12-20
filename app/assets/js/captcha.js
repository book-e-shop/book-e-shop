function getCaptcha(event) {
    $("#captcha_input").val('');
    $.ajax({
        type: "POST",
        url: "/getCaptcha.php",
        data: { width: $("#captcha_input").width() },
        success: function (response) {

            var image = new Image();
            image.src = response;
            $("#captcha").html(image);
        },
        error: function (response) {

        },
    });

}

function verifyCaptcha(event) {


    $.ajax({
        type: "POST",
        url: "/verifyCaptcha.php",
        data: $("#captcha-form").serialize(),

        success: function (response) {

            var res = jQuery.parseJSON(response);

            if (res.state) {
                $('#captchaModal').modal('toggle')
                $("#modalLoginForm").modal('show');
            }
            else {

                getCaptcha();
            }
        },
        error: function (response) {
            $("#user").html(response)
        },
    });

}


$('#captchaModal').on('show.bs.modal', getCaptcha)

$("#captcha-refresh-button").on('click', getCaptcha)

$("#captcha-submit-button").on('click', verifyCaptcha)