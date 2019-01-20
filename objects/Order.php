<?php

class Order
{
    protected $table_name = "orders";
    protected $db;
    private $userId;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addOrder(){
        $query = "INSERT INTO ".$this->table_name."
                  VALUES (0, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->userId]);
        $orderId = $this->db->lastInsertId();
        if($stmt){
            return $orderId;
        }
        return false;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

}