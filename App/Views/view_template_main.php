<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Качалка</title>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/main.js"></script>
    <script type="module" src="/js/chart.umd.js"></script>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/bulma-helpers.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php IF(isset($arrData['user'])): ?>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <img src="/img/logo.png" alt="Сила">
                    <span style="margin-left: 10px">Качалка</span>
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/weight">Вес</a>
                    <a class="navbar-item" href="/visits">Посещения</a>
                    <a class="navbar-item" href="/activities">Активности</a>
                    <a class="navbar-item" href="/food">Еда</a>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Справочники</a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="/type-activities">Тип активности</a>
                            <a class="navbar-item" href="/trainers">Тренажеры</a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <a class="navbar-item" href="/profile">Мой аккаунт</a>
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="/logout">
                                <strong>Выйти</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    <?php ENDIF; ?>
    <?php
        if(isset($content_view)) include 'App/Views/'.$content_view;
    ?>
</body>
</html>