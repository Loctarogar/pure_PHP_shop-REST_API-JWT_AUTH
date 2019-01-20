<?php

class Category
{
    protected $db;
    protected $table_name = "categories";
    private $name;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addCategory(){
        $query = "INSERT INTO ".$this->table_name."
                  VALUES (0, :categoryName) 
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "categoryName" => $this->name
        ]);

        return $stmt;
    }

    public function getAll()
    {
        $query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();


        return $stmt;
    }

    public function setName($name){
        $this->name = $name;
    }
}