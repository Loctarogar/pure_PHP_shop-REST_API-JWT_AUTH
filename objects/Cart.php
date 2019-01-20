<?php

class Cart
{
    protected $table_name = "cart";
    protected $db;
    private $user_id;
    private $product_id;
    private $quantity;
    private $orderId;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProductsForUser(){
        $query = "SELECT product_id, quantity FROM ".$this->table_name."
                  WHERE user_id = :userId
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "userId" => $this->user_id
        ]);

        return $stmt;
    }

    public function deleteUsersCart(){
        $date = date("Y-m-d H:i:s");
        $query = "UPDATE ".$this->table_name."
                  SET order_id = :orderId, deleted_at = :deletingTime
                  WHERE user_id = :userId
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "orderId" => $this->orderId,
            "userId"  => $this->user_id,
            "deletingTime" => $date
        ]);

        return $stmt;
    }

    public function addCart(){
        $isProductInCart = $this->isProductInCart();
        if(false === $isProductInCart){
            $this->insertProduct();

            return ["message" => "Product was added"];
        }
        $this->updateProduct();

        return ["message" => "Quantity was updated"];
    }

    private function updateProduct(){            // todo
        $query = "UPDATE ".$this->table_name."
                  SET quantity = quantity + :quantity
                  WHERE user_id = :userId AND product_id = :productId
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "quantity" => $this->quantity,
            "userId"   => $this->user_id,
            "productId" => $this->product_id
        ]);

        return $stmt;
    }

    private function insertProduct(){
        $query = "INSERT INTO ".$this->table_name."
                  VALUES (0, :userId, :productId, :quantity)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "userId" => $this->user_id,
            "productId" => $this->product_id,
            "quantity"  => $this->quantity
        ]);

        return $stmt;
    }

    public function isProductInCart(){
        $query = "SELECT product_id, quantity
                  FROM ".$this->table_name."
                  WHERE user_id = :userId AND product_id = :productId
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "userId" => $this->user_id,
            "productId" => $this->product_id
        ]);
        if($stmt->rowCount() > 0){

            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }
}
