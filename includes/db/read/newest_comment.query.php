<?php

class NewestComment extends Connection {
  public function __construct() {
    $this->connect();
    
    $sql = "SELECT `id`, `post_id`, `user_id`, `username`,`comment_content`, `date_created`
            FROM `comments`
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
