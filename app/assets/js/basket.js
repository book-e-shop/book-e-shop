$(document).ready(function () {
    $('#inBasket').on('click', function (query) {
        
        $(this).text('Добавлено');
        $(this).css('background-color', 'green');
        $(this).prop('disabled', true);

        $.ajax({
            url: "../../basket.php",
            method: "POST",
            data: { query: query },

            success: function (data) {
                
            }
        });
    });
});