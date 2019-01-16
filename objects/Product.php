<?php

class Product
{
    protected $db;
    protected $table_name = "products";
    private $name;
    private $price;
    private $description;
    private $categories;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll(){
        $query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}