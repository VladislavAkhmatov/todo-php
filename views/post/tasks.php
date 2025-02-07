<?php
namespace App\Controllers;

$task = new TaskController();

if(isset($_POST['add_task'])){
    $task_text = $_POST['task_text'];
    $user_id = $_SESSION['user_id'];
    if($task->saveTask($user_id, $task_text)){
        Header("Location: /");
        exit();
    }else{
        Header("Location: /?q=add");
        exit();
    }
}

if(isset($_POST['delete_task'])){
    $task_id = $_POST['task_id'];
    if($task->deleteTask($task_id)){
        Header("Location: /");
        exit();
    }else{
        Header("Location: /?q=del");
        exit();
    }
}

if(isset($_POST['edit_task'])) {
    $task_id = $_POST['task_id'];
    $task_text = $_POST['task_text'];
    if($task->editTask($task_id, $task_text)){
        Header("Location: /");
    }else{
        Header("Location: /task/" . $task_id . "?q=edit");
    }

}
