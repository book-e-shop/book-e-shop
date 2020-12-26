$(document).ready(function () {
    $('#inBasket').on('click', function (query) {
        alert("Click");
        $(this).css('background-color', 'green');

        $.ajax({
            url: "../../basket.php",
            method: "POST",
            data: { query: query },

            success: function (data) {
                
            }
        });
    });
});