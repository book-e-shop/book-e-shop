var form = document.getElementById('form');



form.addEventListener("submit", function (event) {



    var isbnRegex = /^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/;

    if (isbnRegex.test(isbn) == false) {

        alert("Введите корректный номер ISBN")
        event.preventDefault();
    }


}, false);