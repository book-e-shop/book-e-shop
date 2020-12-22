function signup(event) {
    $.ajax({
        type: "POST",
        url: "/signup.php",
        data: $("#signup-form").serialize(),

        success: function (response) {

            var res = jQuery.parseJSON(response);

            if (res.result) {

                alert(res.message)
                $("#modalLoginForm").modal('toggle');
            }
            else {
                alert(res.message)
            }
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function signin(event) {

    $.ajax({
        type: "POST",
        url: "/signin.php",
        data: $("#signin-form").serialize(),

        success: function (response) {
            var res = jQuery.parseJSON(response);

            if (res.result) {

                $("#user").html(res.message)
                $("#modalLoginForm").modal('toggle');
            }
            else {
                alert(res.message)
            }

        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}



$("#signin-button").on("click", signin);


$("#signup-button").on("click", signup);
