function signup(event) {
    console.log($("#signup-form").serialize())
    $.ajax({
        type: "POST",
        url: "/signup.php",
        data: $("#signup-form").serialize(),

        success: function (response) {

            $("#modalLoginForm").modal('toggle');
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function signin(event) {
    console.log($("#signin-form").serialize())
    $.ajax({
        type: "POST",
        url: "/signin.php",
        data: $("#signin-form").serialize(),

        success: function (response) {
            $("#user").html(response)
            $("#modalLoginForm").modal('toggle');
        },
        error: function (response) {
            $("#user").html(response)
        },
    });

}

var signinButton = document.getElementById("signin-button");

$("#signin-button").on("click", signin);

var signupButton = document.getElementById("signup-button");

signupButton.addEventListener("click", signup);