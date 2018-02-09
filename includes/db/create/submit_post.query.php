<?php

class SubmitPost extends Connection {
  public function __construct($user_id, $user_name, $content) {
    $this->connect();
    
    $sql    = "INSERT INTO `posts` (id, user_id, user_name, content, comment_count, heart_count, date_created)
               VALUES (NULL, :user_id, :user_name, :content, 0, 0, CURRENT_TIMESTAMP)";
    $query  = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        'user_id'   => $user_id,
        'user_name' => $user_name,
        'content'   => $content,
      ]
    );
    
    if (!$result) {
      echo 'WOOOOOOOOOOOOOOOOOOPS';
    }
  }
}
