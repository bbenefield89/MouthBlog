<?php

class ReturnAllComments extends Connection {
  public function __construct($postID) {
    $this->connect();
    
    $sql = "SELECT
              id,
              post_id,
              user_id,
              username,
              comment_content,
              date_created
            FROM
              comments
            WHERE
              post_id = $postID
            ORDER BY
              id
            DESC";
            
    $query = $this->connect()->prepare($sql);
    $result = $query->execute();
    
    if ($result) {
      $returnArr = [];
      
      while ($row = $query->fetch(PDO::FETCH_OBJ)) {
        array_push($returnArr, $row);
      }
      
      header('Content-Type: application/json;charset=UTF-8');
      exit(json_encode($returnArr));
    } else {
        exit('SOMETHING WENT WRONG!');
    }
  }
}
