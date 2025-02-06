<?php

namespace App\Controllers;
use App\Connect;
use PDO;

class UserController extends Connect
{
    private function checkEmail($email){
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function allUsers()
    {
        $query = $this->db->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function saveUser($name, $age, $email, $pass){
        if(!$this->checkEmail($email)){
            $query = $this->db->prepare("INSERT INTO `users`(`name`, `age`, `email`, `pass`) 
        VALUES (:name, :age, :email, :pass)");
            $query->bindParam(':name', $name);
            $query->bindParam(':age', $age);
            $query->bindParam(':email', $email);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $query->bindParam(':pass', $passHash);
            return $query->execute();
        }else{
            echo "Такой email уже существует";
        }
    }

    public function userVerify($email, $pass){
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_OBJ);
        if($user){
            if(password_verify($pass, $user->pass)){
                $_SESSION['name'] = $user->name;
                $_SESSION['age'] = $user->age;
                $_SESSION['email'] = $user->email;
                return true;
            }
            return false;
        }else{
            echo 'Пользователь не найден';
        }
    }
}
?>