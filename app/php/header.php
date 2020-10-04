<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/books.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>


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
            <a href="" data-toggle="modal" data-target="#modalLoginForm">
                <h2><i class="fas fa-sign-in-alt"></i></h2>

            </a>
        </div>
    </nav>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Авторизация/Регистрация</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Login" role='tab'>Авторизация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Registration" role='tab'>Регистрация</a>
                        </li>
                    </ul>

                    <div class='tab-content'>
                        <div class="tab-pane fade show active" id="Login">
                            <input type="email" id="defaultForm-email" class="form-control validate"
                                placeholder="Почта">
                            <p></p>
                            <input type="password" id="defaultForm-pass" class="form-control validate"
                                placeholder="Пароль">
                            <p></p>
                            <button type="button" class="btn btn-primary" data-toggle="button">Войти</button>
                            <p></p>
                        </div>

                        <div class="tab-pane fade" id="Registration">
                            <input type="text" id="fullName" placeholder="ФИО" class="form-control"> 
                            <p></p>
                            <input type="email" id="defaultForm-email" class="form-control validate"
                                placeholder="Почта">
                            <p></p>
                            <input type="password" id="defaultForm-pass" class="form-control validate"
                                placeholder="Пароль">
                            <p></p>
                            <button type="button" class="btn btn-primary"
                                data-toggle="button">Зарегистрироваться</button>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <nav id="sidebar">

        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <ul class="list-unstyled components">
            <p>Категории книг</p>
            <li class="active"><a href="#">Все книги</a></li>
            <li><a href="#">Классическая литература</a></li>
            <li><a href="#">Детективы</a></li>
            <li><a href="#">Для детей</a></li>
            <li><a href="#">Исторические</a></li>
        </ul>

    </nav>