<?php

namespace App\Controllers;
use App\Connect;
use PDO;

class TaskController extends Connect
{
    public function AllTasks()
    {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}

?>