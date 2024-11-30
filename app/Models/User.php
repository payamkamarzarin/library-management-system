<?php

require_once '../../config/connection.php';

class User {
    private $db;
    private $table = "users";

    public $id;
    public $firstname;
    public $lastname;
    public $phonenumber;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct() {
        $this->db = (new DatabaseConnection())->getConnection();
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (firstname, lastname, phonenumber, email, password, created_at) 
                  VALUES (:firstname, :lastname, :phonenumber, :email, :password, :created_at)";

        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":phonenumber", $this->phonenumber);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password",$hashedPassword); ;
        $stmt->bindValue(":created_at", $this->created_at);

        return $stmt->execute();
    }
}
