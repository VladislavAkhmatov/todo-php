<?php

namespace App\Controllers;

use App\Connect;
use App\helper;
use PDO;

class TaskController extends Connect
{

    public function __construct(){
        parent::__construct();
        $this->updateOverdue();
    }

    private function updateOverdue() {
        date_default_timezone_set('Etc/GMT-5');
        $now = date('Y-m-d H:i:s');
        $query = $this->db->prepare("UPDATE tasks SET overdue = 0 WHERE date_end < :now AND overdue != 0");
        $query->bindParam(':now', $now);
        $query->execute();
    }

    public function taskById($task_id)
    {
        $query = $this->db->prepare("SELECT * FROM tasks WHERE task_id = :task_id");
        $query->bindParam(":task_id", $task_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function tasksByUserId($user_id)
    {
        $query = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id AND overdue != 0");
        $query->bindParam(":user_id", $user_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function saveTask($user_id, $task_text, $date_begin, $date_end, $overdue)
    {
        $query = $this->db->prepare("INSERT INTO tasks (user_id, task_text, date_begin, date_end, overdue) VALUES(:user_id, :task_text, :date_begin, :date_end, :overdue)");
        $formatingDateBegin = helper::formatDateForDB($date_begin);
        $formatingDateEnd = helper::formatDateForDB($date_end);
        $query->bindParam(":user_id", $user_id);
        $query->bindParam(":task_text", $task_text);
        $query->bindParam(":date_begin", $formatingDateBegin);
        $query->bindParam(":date_end", $formatingDateEnd);
        $query->bindParam(":overdue", $overdue);
        return $query->execute();
    }

    public function deleteTask($task_id)
    {
        $query = $this->db->prepare("DELETE FROM tasks WHERE task_id = :task_id");
        $query->bindParam(":task_id", $task_id);
        return $query->execute();
    }

    public function editTask($task_id, $task_text, $date_begin, $date_end)
    {
        $query = $this->db->prepare("UPDATE tasks SET task_text = :task_text, date_begin = :date_begin, date_end = :date_end WHERE task_id = :task_id");
        $query->bindParam(":task_id", $task_id);
        $query->bindParam(":task_text", $task_text);
        $query->bindParam(":date_begin", $date_begin);
        $query->bindParam(":date_end", $date_end);
        return $query->execute();
    }
}

?>