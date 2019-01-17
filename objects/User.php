<?php

Class User
{
    protected $db;
    protected $table_name = "users";
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addUser()
    {
        $query = "INSERT INTO 
                       ".$this->table_name."
                  VALUES
                       (0, :firstname, :lastname, :email, :password)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $result = $stmt->execute([
            "firstname" => $this->firstname,
            "lastname"  => $this->lastname,
            "email"     => $this->email,
            "password"  => $hashedPassword
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function isEmailExists($dataEmail){
        $query = "SELECT * FROM ".$this->table_name."
                  WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute(["email" => $dataEmail]);
        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $this->id = $data["id"];
            $this->firstname = $data["firstname"];
            $this->lastname = $data["lastname"];
            $this->email = $data["email"];
            $this->password = $data["password"];

            return true;
        }

        return false;
    }
}