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

    public function setName($name){
        $this->name = $name;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setCategories($category){
        $this->categories = $category;
    }

    public function getAll(){
        $query = "SELECT * FROM ".$this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function addProduct(){
        $query = "INSERT INTO ".$this->table_name."
                  VALUES (NULL, :productname, :price, :description, :category)";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['productname' => $this->name,
                        'price'       => $this->price,
                        'description' => $this->description,
                        'category'  => $this->categories
        ]);

        return $stmt;
    }
}