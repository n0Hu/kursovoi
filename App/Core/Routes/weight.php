<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/weight', function() {
    (new App\Controllers\ControllerWeight())->action();
});

Router::match(['get', 'post'], '/weight/create', function() {
    (new App\Controllers\ControllerWeight())->actionCreate();
});

Router::get('/weight/delete', function() {
    (new App\Controllers\ControllerWeight())->actionDelete();
});