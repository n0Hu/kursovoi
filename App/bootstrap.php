<?php
/** Иницилизирует загрузку приложения подключая все необходимые файлы */
require_once __DIR__.'/../vendor/autoload.php';

// Подключаем конфигурационный файл и файлы БД =>
require_once __DIR__."/../config.php";

// Подключаем роуты =>
require_once "Core/Routes/main.php";
require_once "Core/Routes/auth.php";
require_once "Core/Routes/profile.php";
require_once "Core/Routes/weight.php";
require_once "Core/Routes/visit.php";
require_once "Core/Routes/type_activities.php";
require_once "Core/Routes/trainers.php";
require_once "Core/Routes/food.php";
require_once "Core/Routes/activities.php";

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::start();