<?php
namespace App\Controllers;

if(isset($_POST['add_task'])){
    $task_text = $_POST['task_text'];
    $user_id = $_SESSION['user_id'];
    $task = new TaskController();
    if($task->saveTask($user_id, $task_text)){
        Header("Location: /");
        exit();
    }else{
        Header("Location: /?q=err");
        exit();
    }
}