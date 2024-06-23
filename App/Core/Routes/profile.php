<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/profile', function() {
    (new App\Controllers\ControllerProfile())->action();
});