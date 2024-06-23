<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/food', function() {
    (new App\Controllers\ControllerFood())->action();
});

Router::match(['get', 'post'], '/food/create', function() {
    (new App\Controllers\ControllerFood())->actionCreate();
});

Router::match(['get', 'post'], '/food/edit', function() {
    (new App\Controllers\ControllerFood())->actionEdit();
});

Router::get('/food/delete', function() {
    (new App\Controllers\ControllerFood())->actionDelete();
});