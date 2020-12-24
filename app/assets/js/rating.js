function addComment(event) {
    $.ajax({
        type: "POST",
        url: "/add_comments.php",
        data: $("#comments-form").serialize(),

        success: function (response) {

            $("#comments-form").find("textarea").val("");
            getComments();
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function getComments(event) {
    console.log("afa")
    $.ajax({
        type: "POST",
        url: "/get_comments.php",
        data: $("#comments-form").serialize(),

        success: function (response) {
            var res = jQuery.parseJSON(response);
            html = ""
            for (var k in res) {

                html += "<div class='be-comment'>"
                html += "<div class='be-comment-content'>"
                html += "<span class='be-comment-name'>"
                html += res[k]["author"]
                html += "</span>"
                html += "<span class='be-comment-time'>"
                html += res[k]["date"]
                html += "</span>"

                html += "<p class='be-comment-text'>"
                html += res[k]["comment"]
                html += "</p>"
                html += "</div>"
                html += "</div>"



            }
            $("#comments").html(html)

        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}



$("#add-comment-btn").on("click", addComment);

