function getLogs(event) {
    $("#logs").html("")
    var fields = ['user_id', 'action', 'table', 'table_id']
    var conditions = getConditions(fields)
    $.ajax({
        type: "POST",
        url: "/logs.php",
        data: { get: 'logs', conditions: conditions },
        success: function (response) {
            console.log(response)
            var res = jQuery.parseJSON(response);
            html = ""
            for (var k in res) {
                var r = res[k]
                html += `<tr><th scope='row'>${r.id}</th><td>${r.user_id}</td><td>${r['action']}</td><td>${r.table}</td><td>${r.table_id}</td><td>${r.publish_date}</td><td></td></tr>`

            }
            $("#logs").html(html);
            updateOptions()
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function getConditions(fields) {
    var conditions = {};
    for (var i in fields) {
        var val = $("#" + fields[i] + "-select option:selected").text();
        if (val != "Все")
            conditions[fields[i]] = val;
    }

    return conditions
}

function updateOptions() {

    var fields = ['user_id', 'action', 'table', 'table_id']
    var conditions = getConditions(fields)


    for (var i in fields) {

        $.ajax({
            type: "POST",
            url: "/logs.php",
            data: { get: 'options', field: fields[i], conditions: conditions  },
            success: function (response) {
                console.log(response)
                var res = jQuery.parseJSON(response);
                html = "<option value='0' selected>Все</option>"
                var f = res['field'];
                delete res['field'];
                for (var k in res) {
                    html += "<option>" + res[k] + "</option>"
                }
                var id = "#" + f + "-select";

                $(id).html(html)
            },
            error: function (response) {
                console.log("error");
                console.log(response);
            },
        });
    }
}
$(document).ready(updateOptions)
$("#update-logs").on('click', getLogs)