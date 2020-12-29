function updateRating(event) {
    var star = $(this).attr('star');
    var query = window.location.href

    var book_id = query.split("?")[1];

    var ch = false;
    var action = "delete"
    if ($(this).prop("checked")) {
        ch = true;
    }
    $(".rating-input").prop("checked", false);
    if (ch) {
        $(this).prop("checked", true);
        action = "update";
    }
    $.ajax({
        type: "POST",
        url: "/rating.php",
        data: { book_id: book_id, rating: star, action: action },

        success: function (response) {  
            console.log(response)
            getRating();
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });


}

function getRating(event) {
    var query = window.location.href

    var book_id = query.split("?")[1];


    $.ajax({
        type: "POST",
        url: "/rating.php",
        data: { book_id: book_id, action: "get" },

        success: function (response) {
            console.log(response)
            var res = jQuery.parseJSON(response);
            if (!res['canEdit']) {
                $(".rating-input").attr("disabled", true);
            }
            else {
                $(".rating-input").removeAttr("disabled");
                $("#ri" + res["rating"]).prop("checked", true);
                
            }

            $("#mean-rating").html("<i class='fas fa-star'>" + res["total"] + "</i>");
            $("#r1").html(res["r1"]);
            $("#r2").html(res["r2"]);
            $("#r3").html(res["r3"]);
            $("#r4").html(res["r4"]);
            $("#r5").html(res["r5"]);


        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}



$(".rating-input").change(updateRating);

$(document).ready(getRating)