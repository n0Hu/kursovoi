<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/visits', function() {
    (new App\Controllers\ControllerVisit())->action();
});

Router::get('/visits/create', function() {
    (new App\Controllers\ControllerVisit())->actionCreate();
});

Router::get('/visits/delete', function() {
    (new App\Controllers\ControllerVisit())->actionDelete();
});