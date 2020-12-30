async function getBasket() {
    await $.ajax({
        url: "/list_product.php",
        type: "POST",

        success: function (data) {
            console.log(data)
            var res = jQuery.parseJSON(data);
            $('#listProducts').html(res['output']);

        }
    });
    setClickEvent()

}

function setClickEvent() {

    $('.deleteBook').on('click', function () {
        var book_id = $(this).attr('deletedBookId');

        $.ajax({
            url: "/delete_product.php",
            type: "POST",
            data: { book_id: book_id },

            success: function (data) {
                getBasket();

            }
        });
    });

}
$(document).ready(function () {
    $('#inBasket').on('click', function () {
        var query = window.location.href
        var book_id = query.split("?")[1];

        $(this).text('Добавлено');
        $(this).css('background-color', 'green');
        $(this).prop('disabled', true);

        $.ajax({
            url: "/in_basket.php",
            type: "POST",
            data: { book_id: book_id },

            success: function (data) {

            }
        });
    });


    getBasket()

});