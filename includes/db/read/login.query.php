<?php

class Login extends Connection {
  public function __construct() {
    $this->connect();
  }
  
  public function Login($email, $password) {
    $sql = "SELECT `email`, `password` FROM `users` WHERE `email`=:email";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':email' => $email
      ]
    );
    
    if ($result) {
      $row = $query->fetch(PDO::FETCH_OBJ);
      $email           = htmlentities($row->email, ENT_QUOTES, 'ISO-8859-15');
      $hashed_password = htmlentities($row->password, ENT_QUOTES, 'ISO-8859-15');
      
      if (password_verify($password, $hashed_password)) {
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
