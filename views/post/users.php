<?php

use App\Controllers\UserController;


if(isset($_POST['reg'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $user = new UserController();

    if($user->saveUser($name, $age, $email, $pass)){

        Header('location:' . '/tasks');
    }
}

if(isset($_POST['auth'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $user = new UserController();
    if($user->userVerify($email, $pass)){
        Header('location:' . '/tasks');
    }else{
        Header('location:' . '/auth?q=err');
    }
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:' . '/auth');
}


