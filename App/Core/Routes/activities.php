<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/activities', function() {
    (new App\Controllers\ControllerActivity())->action();
});

Router::match(['get', 'post'], '/activities/create', function() {
    (new App\Controllers\ControllerActivity())->actionCreate();
});

Router::match(['get', 'post'], '/activities/edit', function() {
    (new App\Controllers\ControllerActivity())->actionEdit();
});

Router::get('/activities/delete', function() {
    (new App\Controllers\ControllerActivity())->actionDelete();
});