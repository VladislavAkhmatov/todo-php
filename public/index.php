<?php
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Connect;

$router = new AltoRouter();

$router->setBasePath('');

$router->map("GET", "/", function () {
    require "index.php";
});
$router->map("GET", "/auth", function () {
    require __DIR__ . "/../views/get/auth.php";
});

$router->map("GET", "/tasks", function () {
    require __DIR__ . "/../views/get/tasks.php";
});

$router->map("GET", "/register", function(){
    require __DIR__ . "/../views/get/register.php";
});

$router->map("POST", "/tasks", function () {
    require __DIR__ . "/../views/post/tasks.php";
});

$router->map("POST", "/register", function () {
    require __DIR__ . "/../views/post/users.php";
});

$router->map("POST", "/auth", function () {
    require __DIR__ . "/../views/post/users.php";
});

$router->map("POST", "/logout", function () {
    require __DIR__ . "/../views/post/users.php";
});




$match = $router->match();

if ($match) {
    call_user_func($match['target']);
} else {
    echo "Route not found!";
}


