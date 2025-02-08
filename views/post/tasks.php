<?php
namespace App\Controllers;

$task = new TaskController();

if(isset($_POST['add_task'])){
    $task_text = $_POST['task_text'];
    $user_id = $_SESSION['user_id'];
    $date_begin = $_POST['date_begin'];
    $date_end = $_POST['date_end'];
    if($task->saveTask($user_id, $task_text, $date_begin, $date_end)){
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
    $date_begin = $_POST['date_begin'];
    $date_end = $_POST['date_end'];
    if($task->editTask($task_id, $task_text, $date_begin, $date_end)){
        Header("Location: /");
    }else{
        Header("Location: /task/" . $task_id . "?q=edit");
    }

}
