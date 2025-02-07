<?php
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Connect;

$router = new AltoRouter();

$router->setBasePath('');

$router->map("GET", "/auth", function () {
    require __DIR__ . "/../views/get/auth.php";
});

$router->map("GET", "/", function () {
    require __DIR__ . "/../views/get/task.php";
});

$router->map("GET", "/edit/[i:id]", function ($id) {
    require __DIR__ . "/../views/get/task-edit.php";
});

$router->map("GET", "/register", function(){
    require __DIR__ . "/../views/get/register.php";
});

$router->map("POST", "/", function () {
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
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        echo "Route target not callable!";
    }
} else {
    echo "Route not found!";
}



