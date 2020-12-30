function getLogs(event) {
    $("#logs").html("")
    var fields = ['user_id', 'action', 'table', 'table_id', 'date1', 'date2']
    var conditions = getConditions(fields, 't1')
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
            updateOptionsT1()
        },
        error: function (response) {
            console.log("error");
            console.log(response);
        },
    });

}

function getConditions(fields, table) {
    var conditions = {};
    for (var i in fields) {
        if (fields[i].includes('date')) {
            var val = $("#" + table + fields[i]).val()
            if (val.length > 1)
                conditions[fields[i]] = val;

        }
        else {
            var val = $("#" + table + fields[i] + "-select option:selected").text();
            if (val != "Все")
                conditions[fields[i]] = val;
        }

    }
    console.log(conditions)
    return conditions
}

function updateOptionsT1() {

    var fields = ['user_id', 'action', 'table', 'table_id', 'date1', 'date2']
    var conditions = getConditions(fields, 't1')
    console.log(conditions)

    for (var i in fields) {

        $.ajax({
            type: "POST",
            url: "/logs.php",
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
                var id = "#t1" + f + "-select";

                $(id).html(html)
            },
            error: function (response) {
                console.log("error");
                console.log(response);
            },
        });
    }
}
$(document).ready(updateOptionsT1)
$("#update-logs").on('click', getLogs)