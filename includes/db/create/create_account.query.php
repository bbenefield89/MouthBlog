<?php

class CreateAccount extends Connection {
  public function __construct() {
    $this->connect();
  }
  
  public function create_account($name, $password, $email) {
    $sql = "INSERT INTO `users` (id, name, password, email) VALUES (NULL, :name, :password, :email)";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':name'     => $name,
        ':password' => $password,
        ':email'    => $email
      ]
    );
  }
}
