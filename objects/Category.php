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

    public function getAll()
    {
        $query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();


        return $stmt;
    }
}