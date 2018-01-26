<?php

class CreateAccount extends Connection {
  public function __construct($name, $password, $email) {
    $this->connect();
    
    $sql    = "INSERT INTO `users` (id, name, password, email, created_on)
               VALUES (NULL, :name, :password, :email, CURRENT_TIMESTAMP)";
    $query  = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':name'     => htmlentities($name, ENT_QUOTES, 'ISO-8859-15'),
        ':password' => htmlentities($password, ENT_QUOTES, 'ISO-8859-15'),
        ':email'    => htmlentities($email, ENT_QUOTES, 'ISO-8859-15'),
      ]
    );
    
    // if the values entered are correct we then make a SELECT query to the database
    if ($result) {
      $sql    = "SELECT `id`, `name`, `email`
                 FROM `users`
                 WHERE `email`=:email";
      $query  = $this->connect()->prepare($sql);
      $result = $query->execute(
        [
          ':email' => htmlentities($email, ENT_QUOTES, 'ISO-8859-15'),
        ]
      );
      
      // if the EMAIL exists we grab some data and create some SESSION variables
      if ($result) {
        $row                         = $query->fetch(PDO::FETCH_OBJ);
        $_SESSION['id']              = htmlentities($row->id, ENT_QUOTES, 'ISO-8859-15');
        $_SESSION['name']            = htmlentities($row->name, ENT_QUOTES, 'ISO-8859-15');
        $_SESSION['email']           = htmlentities($row->email, ENT_QUOTES, 'ISO-8859-15');
        
        header('Location: blog_roll.php');
      } else {
        echo 'ERROR 2';
      }
      
    } else {
      echo 'ERROR 1';
    }
  }
}
