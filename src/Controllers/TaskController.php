<?php

namespace App\Controllers;
use App\Connect;
use PDO;

class TaskController extends Connect
{
    public function taskById($user_id){
        $query = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $query->bindParam(":user_id", $user_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function saveTask($user_id, $task_text){
        $query = $this->db->prepare("INSERT INTO tasks (user_id, task_text) VALUES(:user_id, :task_text)");
        $query->bindParam(":user_id", $user_id);
        $query->bindParam(":task_text", $task_text);
        return $query->execute();
    }

    public function deleteTask($task_id){
        $query = $this->db->prepare("DELETE FROM tasks WHERE task_id = :task_id");
        $query->bindParam(":task_id", $task_id);
        return $query->execute();
    }
}

?>