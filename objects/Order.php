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

        $stmt = $this->db->prelare($query);
        $stmt->execute([$this->userId]);

        return $stmt;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

}