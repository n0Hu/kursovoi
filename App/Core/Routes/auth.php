<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/login', function() {
   (new App\Controllers\ControllerLogin())->action();
});

Router::match(['get', 'post'], '/register', function() {
    (new App\Controllers\ControllerRegister())->action();
});

Router::get('/confirmAccount', function () {
    (new App\Controllers\ControllerConfirmAccount())->action();
});

Router::get('/confirmAccount/{uniqueId}', function () {
    (new App\Controllers\ControllerConfirmAccount())->action();
});

Router::get('/haveEmail', function () {
    (new App\Controllers\ControllerRegister())->haveEmail();
});

Router::get('/haveNickname', function () {
    (new App\Controllers\ControllerRegister())->haveNickname();
});

Router::get('/logout', function () {
   session_destroy();
   setcookie('PHPSESSID', null);
   header('Location: /');
});