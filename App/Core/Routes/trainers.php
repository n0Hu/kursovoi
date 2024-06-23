<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/trainers', function() {
    (new App\Controllers\ControllerTrainers())->action();
});

Router::get('/trainers/getForTypeActivities', function() {
    (new App\Controllers\ControllerTrainers())->actionGetByTypeActive();
});

Router::match(['get', 'post'], '/trainers/create', function() {
    (new App\Controllers\ControllerTrainers())->actionCreate();
});

Router::match(['get', 'post'], '/trainers/edit', function() {
    (new App\Controllers\ControllerTrainers())->actionEdit();
});

Router::get('/trainers/delete', function() {
    (new App\Controllers\ControllerTrainers())->actionDelete();
});