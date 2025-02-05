<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Connect;

$router = new AltoRouter();

$router->setBasePath('');

$router->map("GET", "/", function () {
    require __DIR__ . "/../views/get/home.php";
});

$router->map("GET", "/tasks", function () {
    require __DIR__ . "/../views/get/tasks.php";
});

$router->map("POST", "/tasks", function () {
    require __DIR__ . "/../views/post/tasks.php";
});

$match = $router->match();

if ($match) {
    call_user_func($match['target']);
} else {
    echo "Route not found!";
}


