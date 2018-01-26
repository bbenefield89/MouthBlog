<?php

class Login extends Connection {
  public function __construct($email, $password) {
    $this->connect();

    $sql = "SELECT `id`, `name`, `email`, `password` FROM `users` WHERE `email`=:email";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':email' => htmlentities($email, ENT_QUOTES, 'ISO-8859-15'),
      ]
    );
    
    // check if EMAIL exists
    if ($result) {
      $row             = $query->fetch(PDO::FETCH_OBJ);
      $id              = htmlentities($row->id, ENT_QUOTES, 'ISO-8859-15');
      $name            = htmlentities($row->name, ENT_QUOTES, 'ISO-8859-15');
      $email           = htmlentities($row->email, ENT_QUOTES, 'ISO-8859-15');
      $hashed_password = htmlentities($row->password, ENT_QUOTES, 'ISO-8859-15');
      
      // check if user input PASSWORD matches the unhashed PASSWORD in the database
      if (password_verify($password, $hashed_password)) {
        $_SESSION['id']    = htmlentities($id, ENT_QUOTES, 'ISO-8859-15');
        $_SESSION['name']  = htmlentities($name, ENT_QUOTES, 'ISO-8859-15');
        $_SESSION['email'] = htmlentities($email, ENT_QUOTES, 'ISO-8859-15');
        
        header('Location: blog_roll.php');
      } else {
        header('Location: index.php');
      }
    } else {
      echo 'THAT EMAIL ADDRESS DOES NOT EXIST';
    }
  }
}
