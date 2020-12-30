function getComments(event) {
    $("#comments").html("")
    var fields = ['user_id', 'book_id']
    var conditions = getConditions(fields, 't2')
    $.ajax({
        type: "POST",
        url: "/get_comments.php",
        data: { get: 'comments', conditions: conditions },
        success: function (response) {
            console.log(response)
            var res = jQuery.parseJSON(response);
            html = ""
            for (var k in res) {
                var r = res[k]
                html += `<tr><th scope='row'>${r.id}</th><td>${r.author_id}</td><td>${r.author}</td><td>${r.book_id}</td><td>${r.book}</td><td>${r.comment}</td><td>${r.date}</td><td></td></tr>`

            }
            $("#comments").html(html);
            updateOptionsT2()
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function updateOptionsT2() {

    var fields = ['user_id', 'book_id']
    var conditions = getConditions(fields, 't2')


    for (var i in fields) {

        $.ajax({
            type: "POST",
            url: "/get_comments.php",
            data: { get: 'options', field: fields[i], conditions: conditions },
            success: function (response) {
                console.log(response)
                var res = jQuery.parseJSON(response);
                html = "<option value='0'>Все</option>"
                var f = res['field'];
                delete res['field'];
                for (var k in res) {
                    html += "<option>" + res[k] + "</option>"
                }
                var id = "#t2" + f + "-select";

                $(id).html(html)
            },
            error: function (response) {
                console.log("error");
                console.log(response);
            },
        });
    }
}

$(document).ready(updateOptionsT2)
$("#update-comments").on('click', getComments)