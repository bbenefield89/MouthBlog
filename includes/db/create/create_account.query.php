<?php

class CreateAccount extends Connection {
  public function __construct() {
    $this->connect();
  }
  
  public function create_account($username, $password) {
    $sql = "INSERT INTO `users` (id, username, password) VALUES (NULL, :username, :password)";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':username' => $username,
        ':password' => $password
      ]
    );
    
    if ($result) {
      echo 'Woohoo';
    } else {
      echo 'Boooooo';
    }
  }
}
