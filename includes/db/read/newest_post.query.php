<?php

class NewestPost extends Connection {
  public function __construct() {
    $this->connect();
    
    $sql = "SELECT `id`, `user_name`, `content`, `date_created`
            FROM `posts`
            ORDER BY `id` DESC
            LIMIT 1";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute();
    
    if ($result) {
      $row = $query->fetch(PDO::FETCH_OBJ);
      
      header('Content-Type: application/json;charset=UTF-8');
      
      exit(json_encode($row));
    } else {
      exit('SOMETHING WENT WRONG!');
    }
  }
}
