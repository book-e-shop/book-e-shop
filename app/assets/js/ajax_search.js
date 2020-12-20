$(document).ready(function () {

    load_data();

    function load_data(query) {
        $.ajax({
            url: "../../ajax_search.php",
            method: "POST",
            data: { query: query },

            success: function (data) {
                $('#searchResult').html(data);
            }
        });
    }

    $('#search').on('keyup change click', function () {
        var search = $(this).val();
        
        if (search.length > 3) {
            load_data(search);
        } else {
            load_data();
        }
    });
});