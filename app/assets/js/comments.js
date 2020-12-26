function addComment(event) {
    var query = window.location.href

    var book_id = query.split("?")[1];

    $.ajax({
        type: "POST",
        url: "/add_comments.php",
        data: { book_id: book_id, comment: $("#comment").val() },

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
    var query = window.location.href

    var book_id = query.split("?")[1];
    $.ajax({
        type: "POST",
        url: "/get_comments.php",
        data: { book_id: book_id },

        success: function (response) {
            console.log(response)
            var res = jQuery.parseJSON(response);
            html = ""
            for (var k in res) {

                html += "<div class='row comment'>"

                html += "<div class='col'>"

                html += "<div class='row'>"
                html += "<div class='col-10'>"
                html += res[k]["author"]
                html += "</div>"
                html += "<div class='col-2'>"
                html += res[k]["date"]
                html += "</div>"
                html += "</div>"
                html += "<div class='row'>"
                html += "<div class='col'>"
                html += "<textarea id='comment_" + res[k]["comment_id"] + "' class='form-control' disabled>"
                html += res[k]["comment"]
                html += "</textarea>"
                html += "</div>"
                html += "</div>"
                if (res[k]['canEdit']) {
                    html += "<div class='row'>"
                    html += "<div id='btn_group_" + res[k]["comment_id"] + "' class='col justify-content-end'>"
                    html += "<button id='' type='button' comment_id='" + res[k]["comment_id"] + "' class='btn btn-outline-danger btn-sm delete-comment-btn'>Удалить</button>"
                    html += "<button id='' type='button' comment_id='" + res[k]["comment_id"] + "' class='btn btn-outline-primary btn-sm update-comment-btn'>Редактировать</button>"
                    html += "</div>"
                    html += "</div>"
                }
                html += "</div>"

                html += "</div>"


            }
            $("#comments").html(html)
            $(".delete-comment-btn").on("click", deleteComment);
            $(".update-comment-btn").on("click", enableUpdateComment);
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function deleteComment(event) {
    var comment_id = $(this).attr('comment_id');

    $.ajax({
        type: "POST",
        url: "/delete_comments.php",
        data: { comment_id: comment_id },

        success: function (response) {
            getComments();
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function updateComment(event) {
    var comment_id = $(this).attr('comment_id');

    $.ajax({
        type: "POST",
        url: "/update_comments.php",
        data: { comment_id: comment_id, comment: $("#comment_" + comment_id).val() },

        success: function (response) {
            console.log(response)
            getComments();
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

    $("#update-comment").remove()

}

function enableUpdateComment(event) {
    var comment_id = $(this).attr('comment_id');
    try {
        $("#update-comment").remove()
    }
    catch {

    }

    $("#comment_" + comment_id).prop("disabled", false);
    $("#btn_group_" + comment_id).append("<button id='update-comment' type='button' comment_id='" + comment_id + "' class='btn btn-outline-success btn-sm'>Обновить</button>")
    $("#update-comment").on("click", updateComment)
}

$("#add-comment-btn").on("click", addComment);

$(document).ready(getComments)