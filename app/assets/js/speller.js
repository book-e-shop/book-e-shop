function speller(event) {


    $.ajax({
        type: "POST",
        url: "/speller.php",
        data: { text: $("#reviewDIV").html() },

        success: function (response) {

            var res = jQuery.parseJSON(response);

            for (var k in res) {
                var word = res[k]["word"];
                console.log(word)
                $("#reviewDIV").mark(word);
            }



        },
        error: function (response) {

        },
    });

}




$("#speller").on('click', speller)