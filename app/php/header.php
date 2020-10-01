<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/books.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


</head>

<body>

    <nav class="navbar fixed-top bg-light  menu" id="menu">


        <div class="col-md-2">
            <a href="/">
                <h2>Книжный магазин</h2>
            </a>
        </div>
        <div class="col-md-2">
            <a type="button" id="sidebarCollapse">
                <h2><i class="fas fa-bars"></i> Каталог</h2>
            </a>
        </div>
        <div class="col-md-6">
            <input class="form-control" type="search" placeholder="Поиск" aria-label="Search">
        </div>

        <div class="col-md-1">
            <a href="cart">
                <h2><i class="fas fa-shopping-cart"></i></h2>
            </a>

        </div>
        <div class="col-md-1">
            <a href="php/lk_main.php">
                <h2><i class="fas fa-sign-in-alt"></i></h2>

            </a>
        </div>
    </nav>

    <nav id="sidebar">

        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <ul class="list-unstyled components">
            <p>Категории книг</p>
            <li class="active"><a href="books.html">Все книги</a></li>
            <li><a href="#">Классическая литература</a></li>
            <li><a href="#">Детективы</a></li>
            <li><a href="#">Для детей</a></li>
            <li><a href="#">Исторические</a></li>
        </ul>

    </nav>