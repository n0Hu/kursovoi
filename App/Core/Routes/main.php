<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', function() {
    (new App\Controllers\ControllerMain())->action();
});

Router::get('stats/getCountVisit', function() {
    (new App\Controllers\ControllerMain())->actionGetStatsCountVisit();
});

Router::get('stats/getWeight', function() {
    (new App\Controllers\ControllerMain())->actionGetStatsWeight();
});

Router::get('stats/getDownCalories', function() {
    (new App\Controllers\ControllerMain())->actionGetStatsDownCalories();
});

Router::get('stats/getUpCalories', function() {
    (new App\Controllers\ControllerMain())->actionGetStatsUpCalories();
});

Router::get('stats/getDifferenceCalories', function() {
    (new App\Controllers\ControllerMain())->actionGetStatsDifferenceCalories();
});

Router::error(function(\Pecee\Http\Request $request, \Exception $exception) {

    if($exception instanceof \Pecee\SimpleRouter\Exceptions\NotFoundHttpException && $exception->getCode() === 404) {
        (new \App\Controllers\ControllerPageNotFound())->action();
        die();
    } else {
        echo $exception->getMessage();
    }
});