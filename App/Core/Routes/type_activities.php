<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/type-activities', function() {
    (new App\Controllers\ControllerTypeActivities())->action();
});

Router::match(['get', 'post'], '/type-activities/create', function() {
    (new App\Controllers\ControllerTypeActivities())->actionCreate();
});

Router::match(['get', 'post'], '/type-activities/edit', function() {
    (new App\Controllers\ControllerTypeActivities())->actionEdit();
});

Router::get('/type-activities/delete', function() {
    (new App\Controllers\ControllerTypeActivities())->actionDelete();
});