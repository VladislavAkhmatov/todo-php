<?php

use App\Controllers\UserController;


if(isset($_POST['reg'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $user = new UserController();

    $userId = $user->saveUser($name, $age, $email, $pass);
    if($userId){
        $_SESSION['user_id'] = $userId;
        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;
        $_SESSION['email'] = $email;
        Header('location:' . '/');
        exit();
    }
}

if(isset($_POST['auth'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $user = new UserController();
    if($user->userVerify($email, $pass)){
        Header('location:' . '/');
        exit();
    }else{
        Header('location:' . '/auth?q=err');
        exit();
    }
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:' . '/auth');
    exit();
}


