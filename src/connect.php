<?php
namespace App;
use PDO;
use PDOException;
class Connect extends Config
{
    protected $db;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}
?>