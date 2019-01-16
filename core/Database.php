<?php

class Database
{
    private $user     = "root";
    private $password = "vk3897vk";
    private $host     = "localhost";
    private $db       = "shop";
    private $charset  = "utf8mb4";

    public function getConnection(){
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
            PDO:: ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES    => false,
        ];

        try{
            $pdo = new PDO($dsn, $this->user, $this->password, $options);

            return $pdo;
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}